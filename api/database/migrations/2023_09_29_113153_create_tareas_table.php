<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareasTable extends Migration
{
    public function up() {
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string("titulo");
            $table->string("contenido");
            $table->string("estado");
            $table->string("autor");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    
    public function down() {
        Schema::dropIfExists('tareas');
    }
}
