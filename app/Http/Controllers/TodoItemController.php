<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TodoItem;
use Illuminate\Support\Carbon;

class TodoItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TodoItem::orderBy('created_at', 'DESC')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $todoItem = new TodoItem;
        $todoItem->name = $request->item['name'];
        $todoItem->save();

        return $todoItem;
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
        $findItem = TodoItem::find( $id );

        if( $findItem ){
            $findItem->completed = $request->item['completed'] ? true : false;
            $findItem->completed_at = $request->item['completed'] ? Carbon::now() : null;
            $findItem->save();

            return $findItem;
        }

        return "Todo item not found.";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $findItem = TodoItem::find( $id );

        if( $findItem ){
            $findItem->delete();

            return "Todo item successfully deleted.";
        }

        return "Todo item not found.";
    }
}
