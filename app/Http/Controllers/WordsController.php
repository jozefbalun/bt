<?php

namespace App\Http\Controllers;

use App\Participant;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\TestSession;
use App\Word;

class WordsController extends Controller
{
    //
    //
    public function postWords(Request $request)
    {
        $session = TestSession::findOrCreate([$request->get('session')]);
        $participant = Participant::findOrCreate([$request->get('participant')]);

        // zoberiem vsetku slova
        // zistim aka je max frekvencia
        // poslem do metody a vypocitam pre kazde slovo frekvenciu

        foreach ($request->get('words') as $word) {
            // Word::create($word);

            $w = new Word($word);

            $frequence = $w->wordNormaizeFrequence($word);
            $session->participant()->words()->save($w);
        }

//        $post->comments()->saveMany([
//            new App\Comment(['message' => 'A new comment.']),
//            new App\Comment(['message' => 'Another comment.']),
//        ]);
    }

    public function maxFrequence()
    {
        $word = new Word();
        return $word->maxFrequence();
    }

    public function wordFrequence()
    {
        $word = new Word();
        return $word->wordFrequence();
    }
}
