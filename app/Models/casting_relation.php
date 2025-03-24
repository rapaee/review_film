<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class casting_relation extends Model
{
    use HasFactory;
    protected $table = "casting_relation";
    protected $primaryKey = "id";

    protected $fillable = [
       
        'id_film',
        'id_casting',
    ];

    public function film()
    {
        return $this->belongsTo(Film::class, 'id_film', 'id_film');
    }

    // Relasi ke model Casting
    public function casting()
    {
        return $this->belongsTo(Casting::class, 'id_casting', 'id_castings');
    }
    

    
}
