<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentReply;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    //
    public function index()
    {
        $usersCount = User::count();
        $postsCount = Post::count();
        $rolesCount = Role::count();
        $commentsCount = Comment::count();
        $repliesCount = CommentReply::count();


        return view('admin.index', ['users' => $usersCount, 'posts' => $postsCount, 'roles' => $rolesCount,
            'comments' => $commentsCount, 'replies' => $repliesCount]);
    }
}
