<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\tareas;

class TareasSeeder extends Seeder
{
    private function CreateTasks() {
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            DB::table('tareas')->insert([
                'titulo' => $faker->word,
                'contenido' => $faker->sentence,
                'estado' => $faker->word,
                'autor' => $faker->name,
            ]);
        }
    }

    public function run()
    {
        $this -> CreateTasks();
        DB::table('tareas')->insert([
            'titulo' => 'title',
            'contenido' => 'content',
            'estado' => 'status',
            'autor' => 'author'
        ]);
    }
}
