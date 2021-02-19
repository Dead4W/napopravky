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
     * @SWG\Get(
     *     path="/posts",
     *     summary="Get list of blog posts",
     *     tags={"Posts"},
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="object",
     *              @SWG\Property(
     *                 property="posts",
     *                 type="array",
     *                 @SWG\Items(ref="#/definitions/Post")
     *              ),
     *              @SWG\Property(
     *                 property="pages_count",
     *                 type="integer"
     *              ),
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="422",
     *         description="Unprocessable Entity",
     *     ),
     * )
     */

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Post[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(PostRequest $request)
    {
        $data = $request->all();

        $page = $data['page'] ?? 1;

		$rows_per_page = 10;
		
        $posts = Post::
			orderBy('id', 'DESC')
			->skip(($page-1)*$rows_per_page)
			->take($rows_per_page)
			->get();

        foreach( $posts as $post ) {
            // Trick for load tags relationship to model
            $post->loadTags();

			$post->date = $post->getUTC();
        }

        return [
            "posts" => $posts,
            "pages_count" => ceil(Post::count() / $rows_per_page),
        ];
    }

    /**
     * @SWG\Post(
     *     path="/posts",
     *     summary="Post list in blog",
     *     tags={"Posts"},
     *     consumes={"application/x-www-form-urlencoded"},
     *      @SWG\Parameter(
     *          name="text",
     *          in="formData",
     *          required=true,
     *          type="string"
     *      ),
     *      @SWG\Parameter(
     *          name="author",
     *          in="formData",
     *          required=true,
     *          type="string"
     *      ),
     *      @SWG\Parameter(
     *          name="tags",
     *          in="formData",
     *          required=true,
     *          type="array",
     *          @SWG\Items(type="integer")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(ref="#/definitions/Post"),
     *     ),
     *     @SWG\Response(
     *         response="422",
     *         description="Unprocessable Entity",
     *     ),
     * )
     */

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
            "text" => preg_replace("/\r*\n+/ui", "\r\n", $data['text']),
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
}
