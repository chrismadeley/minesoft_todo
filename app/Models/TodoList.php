<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Define the relationship between TodoList and TodoItem
    public function todoItems()
    {
        return $this->hasMany(TodoItem::class);
    }
}