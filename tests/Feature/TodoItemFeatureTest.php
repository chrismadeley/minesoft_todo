<?php 

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\TodoItem;

class TodoItemFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function testRetrieveItemList()
    {
        TodoItem::factory()->count(3)->create();
        $response = $this->get('/api/items');
        $response->assertStatus(200);
    }

    public function testAddNewItem()
    {
        $response = $this->post('/api/item/store', [
            'item' => [
                'name' => 'New Todo Item',
            ],
        ]);

        $response->assertStatus(201);
    }

    public function testUpdateItemCompletionStatus()
    {
        $item = TodoItem::factory()->create();
        $response = $this->put("/api/item/{$item->id}", [
            'item' => [
                'completed' => true,
            ],
        ]);

        $response->assertStatus(200);
    }

    public function testDeleteItem()
    {
        $item = TodoItem::factory()->create();
        $response = $this->delete("/api/item/{$item->id}");
        $response->assertStatus(200);
    }
}
