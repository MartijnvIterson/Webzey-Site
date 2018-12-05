<?php

namespace App\Http\Controllers;

use App\Http\Requests\Search;
use App\Permission;
use App\Role;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;


class pageController extends Controller
{
    public function home() {
        return view('contact')->with(['tasks' => ['Martijn', 'van', 'Iterson']]);
    }
    public function algemeen() {
       return view('algemeen', ['threads' => Post::orderby('id', 'desc')->paginate(10)]);
    }
    public function view(Post $id) {
        return view('post', ['post' => $id]);
    }

    public function createpost() {
        return view('create_post');
    }
    public function postsoverview() {
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
    public function userProfile($user) {
        $role = Role::whereHas('users', function ($query) use ($user) {
            $query->where('id', '=', $user);
        })->pluck('id')->toArray();
        $roles = Role::with('users')->select('roles.name as Rolename', 'roles.description', 'roles.id')->get();
        return view('userProfile', ['role' => $role, 'roles' => $roles, 'user' => User::where('id', '=', $user)->first()]);
    }
    public function search(Search $request) {
        return view('search', ['users' => User::where('name', '=', $request->search)->get(), 'posts' => Post::where('title', '=', $request->search)->get()]);
    }



}

