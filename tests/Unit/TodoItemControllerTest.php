<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\TodoItem;

class TodoItemControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        TodoItem::factory()->count(3)->create();
        $response = $this->get('/items');
        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function testStore()
    {
        $response = $this->post('/item/store', ['item' => ['name' => 'Test Item']]);
        $response->assertStatus(200);
        $response->assertJson(['name' => 'Test Item']);
    }

    public function testUpdate()
    {
        $item = TodoItem::factory()->create();
        $response = $this->put('/item/'.$item->id, ['item' => ['completed' => true]]);
        $response->assertStatus(200);
        $item->refresh();
        $this->assertTrue($item->completed);
        $this->assertNotNull($item->completed_at);
    }

    public function testDestroy()
    {
        $item = TodoItem::factory()->create();
        $response = $this->delete('/item/'.$item->id);
        $response->assertStatus(200);
        $this->assertDeleted($item);
    }
}
