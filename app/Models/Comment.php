<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $primaryKey = 'id_comments';

    protected $fillable = ['comment', 'rating', 'id_user', 'id_film'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function film()
    {
        return $this->belongsTo(Film::class, 'id_film');
    }
}
