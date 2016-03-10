<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RawData extends Model
{

    public $table = "raw_data";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'data'
    ];
}
