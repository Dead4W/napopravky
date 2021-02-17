<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $hidden = ['pivot', 'hidden'];

    public function getId() {
        return $this->id;
    }
}
