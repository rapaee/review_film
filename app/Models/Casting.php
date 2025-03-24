<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Casting extends Model
{
    use HasFactory;
    protected $table = 'castings';
    protected $primaryKey = 'id_castings';

    protected $fillable = ['nama_panggung', 'nama_asli'];

    public function castings()
    {
        return $this->hasMany(Casting::class, 'id_film', 'id_film');
    }
    public function castingRelation()
    {
        return $this->belongsTo(casting_relation::class, 'id_casting', 'id_castings');
    }
}
