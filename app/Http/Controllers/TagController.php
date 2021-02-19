<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{
    /**
     * @SWG\Get(
     *     path="/tags",
     *     summary="Get list of blog tags",
     *     tags={"Tags"},
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *              @SWG\Property(
     *                 property="tags",
     *                 type="array",
     *                 @SWG\Items(ref="#/definitions/Tag")
     *              ),
     *         ),
     *     ),
     * )
     */

    /**
     * Display a listing of the resource.
     *
     * @return Tag[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $tags = Tag::all();

        return $tags;
    }
}
