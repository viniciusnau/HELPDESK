<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_ticket()
    {
        $category = Category::create([
            'name' => 'Teste Categoria',
            'created_by' => 'tester'
        ]);

        $response = $this->postJson('/api/tickets', [
            'title' => 'Erro no sistema',
            'description' => 'Página quebrando',
            'category_id' => $category->id,
            'created_by' => 'tester'
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('tickets', [
            'title' => 'Erro no sistema'
        ]);
    }
}

