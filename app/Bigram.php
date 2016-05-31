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

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'verified' => 'boolean',
    ];
}
