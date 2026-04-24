<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'vendidos',
        'imagen',
        'categoria_id',
        'subcategoria_id'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class);
    }

    public function lineasPedido()
    {
        return $this->hasMany(LineaPedido::class, 'producto_id');
    }

    public function valoraciones()
    {
        return $this->hasMany(Valoracion::class, 'producto_id');
    }

    public function getVendidosAttribute()
    {
        return $this->lineasPedido()->sum('cantidad');
    }
}
