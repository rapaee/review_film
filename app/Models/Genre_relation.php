<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre_relation extends Model
{
    use HasFactory;
    
    protected $table = 'genre_relations';

    protected $fillable = ['id_film', 'id_genre'];

    public function film()
    {
        return $this->belongsTo(Film::class, 'id_film','id_film');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'id_genre','id_genre');
    }
}
