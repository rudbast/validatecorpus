<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unigram extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'word', 'frequency' ];
}
