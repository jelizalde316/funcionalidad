<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'precio',
        'descripcion',
        'stock',
        'sku',
        'imagen',
        'estado',
        'categoria_id'
    ];

    protected $casts = [
        'estado' => 'boolean',
        'precio' => 'integer',
    ];

    // Relación: un producto pertenece a una categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}