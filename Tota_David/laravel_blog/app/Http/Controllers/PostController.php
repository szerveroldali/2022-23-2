<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('posts.index', [
            // 'posts' => Post::all(),
            'posts' => Post::with('author')->get(),
            'user_count' => User::count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'title' => ['required', 'min:2'],
                'description' => ['nullable'],
                'text' => ['required', 'min:3'],
                'categories' => ['nullable', 'array'],
                'categories.*' => ['numeric', 'integer', 'exists:categories,id'],
                'cover_image' => ['nullable', 'file', 'image', 'max:4096'],
            ],
        );

        $cover_image = null;

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');

            $cover_image = 'cover_images/' . $file->hashName();

            // El kell tárolni a disk-en
            $file->store($cover_image);
        }

        // Post létrehozása + alapadatok
        $post = new Post;
        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->text = $data['text'];
        $post->cover_image = $cover_image;
        $post->save();

        // Kategóriák hozzárendelése az előzőleg kreált posthoz
        $post->categories()->sync($data['categories']);

        Session::flash('post_created', $post);

        return Redirect::route('posts.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('posts.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('posts.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
