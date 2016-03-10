<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'name', 'age', 'gender',
    ];

    public function words()
    {
        return $this->hasMany(Word::class);
    }

    public function testSession()
    {
        return $this->belongsTo(TestSession::class);
    }
}
