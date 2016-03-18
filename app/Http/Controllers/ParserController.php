<?php

namespace App\Http\Controllers;

use App\RawData;
use App\Task;
use App\Word;
use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use DB;
use Log;


class ParserController extends Controller
{
    
    public $stopWords = ['a', 'aby', 'aj', 'ak', 'ako', 'ale', 'alebo', 'ani', 'áno', 'asi', 'až', 'bez', 'bude', 'budem',
'budeš', 'budeme', 'budete', 'budú', 'by', 'bol', 'bola', 'boli', 'bolo', 'byť', 'cez', 'čo', 'či', 'ďalší',
'ďalšia', 'ďalšie', 'dnes', 'do', 'ho', 'ešte', 'i', 'ja', 'je', 'jeho', 'jej', 'ich', 'iba', 'iné', 'iný',
'som', 'si', 'sme', 'sú', 'k', 'kam', 'každý', ' každá', 'každé', 'každí', 'kde', 'keï', 'kto', 'ktorá',
'ktoré', 'ktorou', 'ktorý', 'ktorí', 'ku', 'lebo', 'len', 'ma', 'má', 'máte', 'medzi', 'mi',
'mne', 'mnou', 'musieť', 'môcť', 'môj', 'môže', 'my', 'na', 'nad', 'nám', 'náš', 'naši', 'nie', 'nech', 'než',
'nič','niektorý', 'nové', 'nový', 'nová', 'noví', 'o', 'od', 'on', 'ona', 'ono', 'oni', 'ony', 'po',
'pod', 'podľa', 'pokiaľ', 'potom', 'práve', 'pre', 'prečo', 'preto', 'pretože', 'prvý', 'prvá', 'prvé', 'prví',
'pred', 'predo', 'pri', 'pýta', 's', 'sa', 'so', 'si', 'svoje', 'svoj', 'svojich', 'svojím', 'svojími', 'a',
'tak', 'takže', 'táto', 'teda', 'ten', 'tento', 'tieto', 'tým', 'týmto', 'tiež', 'to', 'toto', 'toho', 'tohoto',
'tom', 'tomto', 'tomuto', 'toto', 'tu', 'tú', 'túto', 'tvoj', 'ty', 'tvojími', 'už', 'v', 'vám', 'váš', 'vaše',
'vo', 'viac', 'však', 'všetok', 'vy', 'z', 'za', 'zo', 'že'];

    public function parse(Request $request)
    {

        $rawData = RawData::where('id', '>=', 24)->get();
        //$rawData = RawData::find(22);

        //dd($rawData);



        foreach ($rawData as $row) {

            DB::beginTransaction();

            //dd($row);
            $unserializeData = unserialize($row->data);

            $task = $unserializeData;

            //dd($task);

            //Wed Mar 16 2016 14:44:12 GMT+0100 (Central Europe Standard Time)
            $task['started_at'] = str_replace(" (Central Europe Standard Time)", "", $task['started_at']);
            $task['ended_at'] = str_replace(" (Central Europe Standard Time)", "", $task['ended_at']);
            $started_at = Carbon::createFromFormat('D M d Y H:i:s O', $task['started_at'])->toDateTimeString();
            $ended_at = Carbon::createFromFormat('D M d Y H:i:s O', $task['ended_at'])->toDateTimeString();

            //dd($task);
            $taskModel = null;
            $taskModel = Task::create([
                'task' => $this->selectTask($task['kData']['url']),
                'url' => $task['kData']['url'],
                'participant' => $task['participantName'],
                'title' => $this->selectTitle($this->selectTask($task['kData']['url'])),
                'started_at' => $started_at,
                'ended_at' => $ended_at,
            ]);

            $word = null;
            
            if (!isset($task['kData']['keyWords'])) {
                Log::error('empty keywords: ' . $taskModel->participant . " " . $taskModel->task);
                DB::rollBack();
                continue;
            }

            foreach ($task['kData']['keyWords'] as $keyWord) {

                //var_dump((int)$keyWord['rps']);
//                dd($keyWord['lps']);
                $word = $taskModel->words()->create([
                    'word' =>  $keyWord['word'],
                    'fixation_duration' => (double)$keyWord['fixationDuration'],
                    'fixation_count' => (int)$keyWord['fixationCount'],
                    'left_pupil_size' => $keyWord['lps'],
                    'right_pupil_size' => $keyWord['rps'],
                    'parent_element' => (isset($keyWord['parent'])) ? $keyWord['parent'] : 'null',
                    'weight' => 0
                ]);
            }

            if ( $taskModel && $word) {
                Log::info('succes write task and words ' . $taskModel->id);
                DB::commit();
            } else {
                Log::error('task fail: ' . $taskModel->id);
                DB::rollBack();
            }
        }
    }

    protected function selectTask($url) {

        if (substr($url, -3) == "vhs") {
            return 2;
        }

        return 1;
    }

    private function selectTitle($task)
    {
        if ($task == 1) {
            return "Hurikán";
        }

        return "VHS | Video Home System";
    }
}
