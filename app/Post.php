<?php

namespace App;

use App\Tag;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['text', 'author'];

    public function loadTags() {
        // tricky for load tags to model
        foreach ($this->tags as $tag) {
            $tag->id;
        }
    }

    public function tags(){
        return $this->belongsToMany(
            Tag::class,
            'posts_tags',
            'post_id',
            'tag_id');
    }
}
