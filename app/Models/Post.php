<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;
    public function chapter()
    {
        return $this->hasMany(Chapter::class);
    }
    public function postCategory()
    {
        // belongsTo(RelatedModel, foreignKey = _id, keyOnRelatedModel = id)
        return $this->belongsToMany(Category::class,'post_categories','post_id','category_id');
    }
    public function postGenre()
    {
        // belongsTo(RelatedModel, foreignKey = _id, keyOnRelatedModel = id)
        return $this->belongsToMany(Genre::class,'post_genres','post_id','genre_id');
    }
}
