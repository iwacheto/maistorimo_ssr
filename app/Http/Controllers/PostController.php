<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request, Recaptcha $recaptcha)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'recaptcha' => ['required', $recaptcha],
        ]);
 
        $post = Post::create([
        'title' => request('title'),
        'body' => request('body')
        ]);
 
        return response(['post' => $post], 200);
    }
}
