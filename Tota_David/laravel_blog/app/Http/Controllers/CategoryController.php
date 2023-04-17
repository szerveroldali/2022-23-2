<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                // mező neve (name attr) => validációs szabályok, amelyeknek az adott mezőre teljesülni kell
                // 'name' => 'required|min:2',
                'name' => ['required', 'min:2'], // ugyanaz
                'style' => [
                    'required',
                    // 'in:x,y',...
                    Rule::in(['primary', 'secondary','danger', 'warning', 'info', 'dark']),
                ]
            ],
            // egyéni hibaüzenetek:
            [
                // validációs szabály neve => hibaüzenet
                // VAGY
                // mező neve.validációs szabály neve => ...
                'required' => 'A(z) ":attribute" nevű mező kitöltése kitelező',
            ]
        );

        // TODO: entitás létrehozása
        error_log(
            json_encode(
                $data,
            )
        );

        // Category::create()
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
