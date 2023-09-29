<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tareas extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = "tareas";
    protected $primaryKey = 'id';

    protected $fillable = [
        'titulo',
        'contenido',
        'estado',
        'autor'
    ];
}
