<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostGenre extends Model
{
    use HasFactory;
    protected $fillable =[
        'genre_id','post_id'
    ];
    protected $table = 'post_genres';
    protected $primaryKey = 'id';
}
