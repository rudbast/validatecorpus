<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bigram extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'word', 'frequency' ];
}
