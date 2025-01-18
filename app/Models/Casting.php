<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Casting extends Model
{
    use HasFactory;
    protected $table = 'castings';
    protected $primaryKey = 'id_castings';

    protected $fillable = ['nama_panggung', 'nama_alsi', 'id_film'];

    public function film()
    {
        return $this->belongsTo(Film::class, 'id_film');
    }
}
