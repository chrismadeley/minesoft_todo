<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TodoList;


class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todoLists = TodoList::all();

        return response()->json($todoLists, 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cleanData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $todoList = TodoList::create([
            'name' => $cleanData['name'],
        ]);

        return response()->json($todoList, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
