<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('author') -> where('published', '=', true) -> orderByDesc('date') -> paginate(9);
        $categories = Category::all();
        return view('posts.index', ['posts' => $posts, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', ['categories' => $categories ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request -> validate(
            ['title' => 'required|string|min:3',
            'content' => 'required',
            'date' => 'required|date',
            'cats' => 'nullable|array',
            'cats.*' => 'integer|distinct|exists:categories,id'
        ], [
            'title.required' => 'Kéne cím tesó!'
        ]);

        $validated['published'] = $request -> has('published');
        $validated['author_id'] = 4; // TODO!

        $post = Post::create($validated);

        $post -> categories() -> sync($validated['cats'] ?? []);

        return to_route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $categories = Category::all();
        return view('posts.show', ['post' => $post, 'categories' => $categories ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', ['post' => $post, 'categories' => $categories ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request -> validate(
            ['title' => 'required|string|min:3',
            'content' => 'required',
            'date' => 'required|date',
            'cats' => 'nullable|array',
            'cats.*' => 'integer|distinct|exists:categories,id'
        ], [
            'title.required' => 'Kéne cím tesó!'
        ]);

        $validated['published'] = $request -> has('published');
        $validated['author_id'] = 4; // TODO!

        $post -> update($validated);

        $post -> categories() -> sync($validated['cats'] ?? []);

        return to_route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post -> delete();
        return to_route('posts.index');
    }
}
