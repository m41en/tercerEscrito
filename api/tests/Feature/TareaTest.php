<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TareaTest extends TestCase
{
    public function test_ListUserPostGoodRequest() {
        $response = $this->get('/api/tarea/1');
        $response->assertJsonStructure([
            '*' => [
                "titulo",
                "contenido",
                "estado",
                "autor",
                "created_at",
                "updated_at",
                "deleted_at"
            ]
        ]);
        $response -> assertJsonFragment([
            "id"=> 1,
            "deleted_at"=> null
        ]);
    }
    
    public function test_ListUserPostOneThatDoesntExist(){
        $response = $this->get('/api/tarea/10000');
        $response -> assertStatus(404);
    }
}
