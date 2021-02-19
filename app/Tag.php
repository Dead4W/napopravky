<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *  definition="Tag",
 *  @SWG\Property(
 *      property="id",
 *      type="integer"
 *  ),
 *  @SWG\Property(
 *      property="title",
 *      type="string"
 *  ),
 * )
 */

class Tag extends Model
{
    /**
     * hide columns for response
     *
     * @var string[]
     */
    protected $hidden = ['pivot', 'hidden'];
}
