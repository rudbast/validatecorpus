<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trigram extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'word', 'frequency' ];
}
