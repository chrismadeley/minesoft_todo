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
        $cleanData = $request->validate([
            'item.name' => 'required|string|max:255',
            'item.todo_list_name' => 'required|string|max:255',
        ]);

        // Find or create the TodoList based on the name
        $todoList = TodoList::firstOrCreate(['name' => $cleanData['item']['todo_list_name']]);

        $todoItem = new TodoItem;
        $todoItem->name = $cleanData['item']['name'];
        $todoItem->todo_list_id = $todoList->id;
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
        $cleanID = \Validator::validate(['id' => $id], [
            'id' => 'required|integer'
        ]);

        $findItem = TodoItem::find($cleanID['id']);

        if ($findItem) {
            $findItem->delete();

            return "Todo item successfully deleted.";
        }

        return "Todo item not found.";
    }

}
