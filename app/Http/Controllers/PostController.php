<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\PostRequest;
use App\Tag;
use Closure;
use Illuminate\Foundation\Validation\ValidatesRequests;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Post[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $posts = Post::all();

        foreach( $posts as $post ) {
            $post->loadTags();
        }

        return $posts;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Post
     */
    public function store(PostRequest $request)
    {
        $data = $request->all();

        $new_post = Post::create([
            "text" => $data['text'],
            "author" => $data['author'],
        ]);

        foreach( $data['tags'] as $tag_id ) {
            if( Tag::find($tag_id) ) {
                $new_post->tags()->attach($tag_id);
            }
        }

        $new_post->save();

        $new_post->loadTags();

        return $new_post;
    }

    public function handle($request, Closure $next)
    {
        $request->headers->set('Accept', 'application/json');
        return $next($request);
    }
}
