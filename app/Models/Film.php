<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $table = "film";
    protected $primaryKey = 'id_film';

    // Kolom-kolom yang dapat diisi secara mass assignment
    protected $fillable = [
        'judul', 'poster', 'deskripsi', 'tahun_rilis', 'durasi',
        'rating', 'pencipta', 'trailer'
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genres_relations', 'id_film', 'id_genre');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'id_film');
    }

    public function castings()
    {
        return $this->hasMany(Casting::class, 'id_film');
    }
}
