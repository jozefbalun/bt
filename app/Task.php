<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    public $dates = ['started_at', 'ended_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'task', 'url', 'participant', 'title', 'started_at', 'ended_at',
    ];

    public function words()
    {
        return $this->hasMany(Word::class);
    }

}
