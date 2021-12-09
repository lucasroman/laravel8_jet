<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // Current user logged
        $user = auth()->user();

        return view('posts.index', ['user' => $user]);
    }
}
