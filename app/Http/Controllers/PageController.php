<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Permission;
use App\Role;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;


class PageController extends Controller
{
    public function home() {
       return view('home_webzey', ['threads' => Post::orderby('id', 'desc')->paginate(10)]);
    }
    public function view(Post $post) {
        return view('post', ['post' => $post]);
    }

    public function createPost() {
        return view('create_post');
    }
    public function postsOverview() {
        return view('posts_overzicht', [ 'threads' => Post::where('user_id', Auth::user()->id)->orderby('id', 'desc')->get()]);
    }
    public function permissions() {
        return view('permissions', ['ranks' => Role::with('users')->get()]);
    }
    public function ranks(Role $rank) {
        $permissions = Permission::whereHas('roles', function ($query) use ($rank) {
            $query->where('id', '=', $rank->id);
        })->pluck('id')->toArray();
        return view('permissions_edit_group', ['rank' => $rank, 'permission' => $permissions]);
    }
    public function userProfile(User $user) {
        return view('userProfile', ['role' => $user->roles()->getResults()->pluck('id')->toArray(), 'roles' => Role::with('users')->select('roles.name as Rolename', 'roles.description', 'roles.id')->get(), 'user' => User::where('id', '=', $user->id)->first()]);
    }
    public function search(SearchRequest $request) {
        return view('search', ['users' => User::where('name', '=', $request->search)->get(), 'posts' => Post::where('title', '=', $request->search)->get()]);
    }
}

