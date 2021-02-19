<?php

namespace App;

use App\Tag;
use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *  definition="Post",
 *  @SWG\Property(
 *      property="id",
 *      type="integer"
 *  ),
 *  @SWG\Property(
 *      property="text",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="author",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="tags",
 *      type="array",
 *      @SWG\Items(ref="#/definitions/Tag")
 *  ),
 * )
 */

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['text', 'author'];

    /**
     * hide columns for response
     *
     * @var string[]
     */
    protected $hidden = ['created_at', 'updated_at', 'hidden', 'pivot'];

    /**
     * Trick for load tags relationship to model
     */
    public function loadTags() {
        foreach ($this->tags as $tag) {
            $tag->id;
        }
    }

    /**
     * return UTC time format
     *
     * @return string
     */
    public function getUTC() : string {
        return date("Y-m-d G:i:s\Z",$this->created_at->timestamp);
    }

    /**
     * Relationshim many to many
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags(){
        return $this->belongsToMany(
            Tag::class,
            'posts_tags',
            'post_id',
            'tag_id');
    }
}
