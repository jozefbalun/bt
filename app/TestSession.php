<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestSession extends Model
{

    public $dates = ['started_at', 'ended_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'started_at', 'ended_at',
    ];

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
}
