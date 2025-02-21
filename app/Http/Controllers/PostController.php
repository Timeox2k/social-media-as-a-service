<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => ['required', 'string', 'max:255'],
            'feelings' => ['nullable', 'in:happy,sad,angry,surprised,disgusted,fearful'],
        ]);

        auth()->user()->posts()->create($request->only('content', 'feelings'));

        return redirect()->route('dashboard');
    }
}
