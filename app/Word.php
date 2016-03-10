<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{

    protected $frequenceConstant = 10;
    protected $maxFrequence = 0;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'word', 'weight', 'fixation_duration, fixation_count, left_pupil_size, right_pupil_size',
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function finalWeight($word)
    {
//        return $this->wordNormaizeFrequence($word) *
    }

    public function pupilDiameter($lps, $rps)
    {
        $words = $this->all();
        $sum = 0;
        for ( $i = 1; $i <= $words->count(); $i++) {
            $sum += ($words[$i]->left_pupil_size + $words[$i]->right_pupil_size);
        }

        return 0.5 * ($lps + $rps) - 1 / $words->count() * $sum;
    }

    /**
     * @param $word
     * @return float score of word w
     */
    public function wordNormaizeFrequence($word)
    {
        //return frekvencia slova / (maximalna frekvencia + const)

        return $this->wordFrequence($word) / ($this->maxFrequence() + $this->frequenceConstant);
    }

    public function maxFrequence()
    {
        $words = $this->all();
        $simpleWord = [];
        foreach ($words as $w) {
            $simpleWord[] = $w->word;
        }

        $array = array_count_values ( $simpleWord );
        $this->maxFrequence = max($array);

        return $this->maxFrequence;
    }

    public function wordFrequence($word = '')
    {
        // TODO remove this konstant
        $word = "Ahoj";
        $words = $this->all();
        $simpleWord = [];
        foreach ($words as $w) {
            $simpleWord[] = $w->word;
        }

        $array = array_count_values ( $simpleWord );

        return $array[$word];
    }

    //

    /**
     * @return int
     */
    public function getMaxFrequence()
    {
        return $this->maxFrequence;
    }

    /**
     * @param int $maxFrequence
     */
    public function setMaxFrequence($maxFrequence)
    {
        $this->maxFrequence = $maxFrequence;
    }
}
