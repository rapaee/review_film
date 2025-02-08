<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $table = 'genre';
    protected $primaryKey = 'id_genre';

    protected $fillable = ['title', 'slug'];

    public function films()
    {
        return $this->belongsToMany(Film::class, 'genre_relations', 'id_genre', 'id_film');
    }
}
