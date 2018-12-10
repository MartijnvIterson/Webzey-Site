<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CreateBlogCommentRequest;
use App\Http\Requests\CreateBlogPostRequest;
use App\Http\Requests\CreatePermRequest;
use App\Http\Requests\DeleteGroupRequest;
use App\Http\Requests\EditGroupRequest;
use App\Http\Requests\EditUserGroupRequest;
use App\Http\Requests\EditUserInfoRequest;
use App\Http\Requests\EditUserPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Permission;
use App\Post;
use App\Role;
use App\User;
use App\Http\Requests\CreateGroupRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class PermController extends Controller
{
    public function createRole(CreateGroupRequest $request)
    {
            Role::create([
                'name' => $request->name,
                'display_name' => $request->display_name,
                'description' => $request->description,
                'color' => $request->color,
            ]);
            return Redirect::back();
    }
    public function createPerm(CreatePermRequest $request) {
        Permission::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description,
        ]);
        return Redirect::back();
    }
    public function editRole(EditGroupRequest $request)
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
    public function editUserGroup(EditUserGroupRequest $request) {
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
    public function CreateBlogComment(CreateBlogCommentRequest $request)
    {
        asset('\vendor\ezyang\htmlpurifier\library');

        $config = \HTMLPurifier_Config::createDefault();
        $purifier = new \HTMLPurifier($config);
        $message = $purifier->purify($request->message);

            Comment::create([
                'message' => $message,
                'user_id' => Auth::user()->id,
                'post_id' => $request->thread,
            ]);

        return Redirect::back();
    }
    public function CreateBlogPost(CreateBlogPostRequest $request)
    {

        asset('\vendor\ezyang\htmlpurifier\library');

        $config = \HTMLPurifier_Config::createDefault();
        $purifier = new \HTMLPurifier($config);
        $message = $purifier->purify($request->message);
            $slug = str_replace(' ', '-', $request->title);

            Post::create([
                'message' => $message,
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'slug' => $slug,
            ]);

        return redirect('/post/overzicht', 302);
    }
    public function deleteGroup(DeleteGroupRequest $request) {

        Role::where('id', '=', $request['rank-id'])->delete();
        return redirect('/user/settings', 302);
    }
    public static function dateMonth($db) {
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
    public static function dateDay($db) {
        $timestamp = strtotime($db);
        Return date("d", $timestamp);
    }
    public function deleteComment(Comment $comment) {
        if (Auth::user()->can('berichten-verwijderen') || $this->authorize('delete', $comment)) {
            Comment::where('id', '=', $comment->id)->delete();
            return Redirect::back();
        } else {
            abort(403, 'Je hebt hier geen toestemming voor.');
        }
    }
    public function deletePost(Post $post) {
        if (Auth::user()->can('berichten-verwijderen') || $this->authorize('delete', $post)) {
            Comment::where('post_id', '=', $post->id)->delete();
            Post::where('id', '=', $post->id)->delete();
            return redirect('/');
        } else {
            abort(403, 'Je hebt hier geen toestemming voor.');
        }
    }
    public function resetPassword(ResetPasswordRequest $request) {
        $password = User::where('id', '=', Auth::user()->id)->pluck('password');
        if (Hash::check($request['old-password-0'], $password[0]))
        {
            User::where('id', '=', Auth::user()->id)->update(['password' => Hash::make($request['new-password-0'])]);
        } else {
            abort(403, 'Password error.');
        }
    }
    public function editPassword(EditUserPasswordRequest $request) {
        User::where('id', '=', $request['user-id'])->update(['password' => Hash::make($request['user-password'])]);
        return Redirect::back();
    }
    public function editUserInfo(EditUserInfoRequest $request) {
        User::where('id', '=', $request['user-id'])->update(['name' => $request['user-name'], 'email' => $request['user-email']]);
        return Redirect::back();
    }
}
