<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', function () {
    // $posts = Post::all();
    return view('posts.index', [
        // 'teszt' => 1,
        // 'posts' => Post::all(),
        'posts' => Post::with('author')->get(),
    ]);
});

Route::get('/posts/create', function () {
    return view('posts.create');
});

Route::get('/posts/x', function () {
    return view('posts.show');
});

Route::get('/posts/x/edit', function () {
    return view('posts.edit');
});

// -----------------------------------------

Route::get('/categories/create', function () {
    return view('categories.create');
});

Route::get('/categories/x', function () {
    return view('categories.show');
});

// -----------------------------------------

Auth::routes();
