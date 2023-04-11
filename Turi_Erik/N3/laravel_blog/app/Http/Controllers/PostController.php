<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('author') -> where('public', '=', true) -> orderByDesc('date') -> paginate(15);
        $categories = Category::all();
        return view('posts.index', ['bejegyzesek' => $posts, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this -> authorize('create', Post::class);
        $categories = Category::all();
        return view('posts.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this -> authorize('create', Post::class);
        $validated = $request->validate(
            [
                'title' => 'required|string|min:3',
                'content' => 'required',
                'date' => 'required|date',
                'cats' => 'nullable|array',
                'cats.*' => 'integer|distinct|exists:categories,id',
                'file' => 'nullable|image'
            ],
            [
                'title.required' => 'Kéne egy cím, Marika néni!'
            ]
        );

        $validated['public'] = $request -> has('public');

        $validated['author_id'] = Auth::id();

        if ($request -> hasFile('file')){
            $file = $request -> file('file');
            $fname = $file -> hashName();
            Storage::disk('public') -> put('images/' . $fname, $file -> get());
            $validated['filename'] = $fname;
        }

        $post = Post::create($validated);
        $post -> categories() -> sync($validated['cats'] ?? []);

        Session::flash('post-created');
        return to_route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $categories = Category::all();
        return view('posts.show', ['post' => $post, 'categories' => $categories]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', ['post' => $post, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate(
            [
                'title' => 'required|string|min:3',
                'content' => 'required',
                'date' => 'required|date',
                'cats' => 'nullable|array',
                'cats.*' => 'integer|distinct|exists:categories,id'
            ],
            [
                'title.required' => 'Kéne egy cím, Marika néni!'
            ]
        );

        $validated['public'] = $request -> has('public');

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
        $this -> authorize('delete', $post);
        //if (!Gate::allows('delete-post-ability', $post))
        //    return abort(403);
        $post -> delete();
        return to_route('posts.index');
    }
}
