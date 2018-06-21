<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    //
    protected $fillable = ['name','horizontal','vertical','use','default'];
    protected $casts = [ 'use' => 'boolean','default' => 'boolean' ];
}
