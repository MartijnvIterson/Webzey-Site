<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CreateBlogComment;
use App\Http\Requests\CreateBlogPost;
use App\Http\Requests\CreatePerm;
use App\Http\Requests\DeleteGroup;
use App\Http\Requests\DeleteOwnPost;
use App\Http\Requests\EditGroup;
use App\Http\Requests\EditUserGroup;
use App\Http\Requests\Search;
use App\Permission;
use App\Post;
use App\Role;
use App\User;
use App\Http\Requests\CreateGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PermController extends Controller
{
    public function createRole(CreateGroup $request)
    {
            Role::create([
                'name' => $request->name,
                'display_name' => $request->display_name,
                'description' => $request->description,
                'color' => $request->color,
            ]);
            return Redirect::back();
    }
    public function createPerm(CreatePerm $request) {
        Permission::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description,
        ]);
        return Redirect::back();
    }
    public function editRole(EditGroup $request)
    {
        $role = Role::where('id', '=', $request->id)->first();
        $roleperm = Permission::whereHas('roles', function ($query) use ($request) {
            $query->where('id', '=', $request->id);
        })->pluck('id')->toArray();
        $allperm = Permission::all()->pluck('id');
        foreach ($allperm as $item) {
            if (!in_array($item, $roleperm) && $request['permission_' . $item] == 'on') {
                $role->attachPermission($item);
            } elseif (!isset($request['permission_' . $item]) && in_array($item, $roleperm)) {
                $role->detachPermission($item);
            }
        }
        return Redirect::back();
    }
    public function editUserGroup(EditUserGroup $request) {
        $role_id = Role::whereHas('users', function ($query) use ($request) {
            $query->where('user_id', '=', $request->user);
        })->pluck('id')->toArray();
        $roles = Role::pluck('id')->all();
        $user = User::findOrFail($request->user);
        foreach ($roles as $role) {
            if(!in_array($role, $role_id) && $request[$role] == 'on') {
                $user->attachRole($role);
            } elseif(!isset($request[$role]) && in_array($role, $role_id)) {
                $user->detachRoles([$role]);
            }
        }
        return Redirect::back();
    }
    public function CreateBlogComment(CreateBlogComment $request)
    {

        if (strpos($request->message, 'script')) {
            return abort(403, 'Er zijn tekens gebruikt die niet toegestaan zijn!');
        } elseif (strpos($request->message, 'function')) {
            return abort(403, 'Er zijn tekens gebruikt die niet toegestaan zijn!');
        } else {
            Comment::create([
                'message' => $request->message,
                'user_id' => Auth::user()->id,
                'post_id' => $request->thread,
            ]);
        }

        return Redirect::back();
    }
    public function CreateBlogPost(CreateBlogPost $request)
    {

        if (strpos($request->message, 'script')) {
            return abort(403, 'Er zijn tekens gebruikt die niet toegestaan zijn!');
        } elseif (strpos($request->message, 'function')) {
            return abort(403, 'Er zijn tekens gebruikt die niet toegestaan zijn!');
        } else {
            $slug = str_replace(' ', '-', $request->title);
            Post::create([
                'message' => $request->message,
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'slug' => $slug,
            ]);
        }
        return redirect('/post/overzicht', 302);
    }
    public function deleteGroup(DeleteGroup $request) {

        Role::where('id', '=', $request['rank-id'])->delete();
        return redirect('/user/settings', 302);
    }
    public static function date_month($db) {
        $timestamp = strtotime($db);
        $month = date("m", $timestamp);
        switch ($month) {
            case 1:
                $month = 'JAN';
                break;
            case 2:
                $month = 'FEB';
                break;
            case 3:
                $month = 'MAR';
                break;
            case 4:
                $month = 'APR';
                break;
            case 5:
                $month = 'MEI';
                break;
            case 6:
                $month = 'JUN';
                break;
            case 7:
                $month = 'JUL';
                break;
            case 8:
                $month = 'AUG';
                break;
            case 9:
                $month = 'SEP';
                break;
            case 10:
                $month = 'OKT';
                break;
            case 11:
                $month = 'NOV';
                break;
            case 12:
                $month = 'DEC';
                break;
            default:
                $month = "ERR";
                break;
        }
        return $month;
    }
    public static function date_day($db) {
        $timestamp = strtotime($db);
        Return date("d", $timestamp);
    }
    public function deleteComment(Comment $comment) {
        if(Auth::user()->id == $comment->user->id || Auth::user()->can('berichten-verwijderen')) {
            Comment::where('id', '=', $comment->id)->delete();
            return Redirect::back();
        } else {
            abort(403, 'Je hebt hier geen toestemming voor.');
        }

    }
    public function deletePost(Post $post) {
        if(Auth::user()->id == $post->user->id || Auth::user()->can('berichten-verwijderen')) {
            Comment::where('post_id', '=', $post->id)->delete();
            Post::where('id', '=', $post->id)->delete();
            return redirect('/');
        } else {
            abort(403, 'Je hebt hier geen toestemming voor.');
        }
    }
}
