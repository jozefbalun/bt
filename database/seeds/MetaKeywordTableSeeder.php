<?php

use Illuminate\Database\Seeder;

class MetaKeywordTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('meta_keywords')->delete();

        $keyWords = [
            ['word' => 'Hurikán', 'task_num' => 1],
            ['word' => 'Oko', 'task_num' => 1],
            ['word' => 'Oko hurikánu', 'task_num' => 1],
            ['word' => 'Stena', 'task_num' => 1],
            ['word' => 'Vietor', 'task_num' => 1],
            ['word' => 'Vlny', 'task_num' => 1],
            ['word' => 'Cyklon', 'task_num' => 1],
            ['word' => 'Safir – Simpsonova stupnica', 'task_num' => 1],

            ['word' => 'VHS', 'task_num' => 2],
            ['word' => 'kazeta', 'task_num' => 2],
            ['word' => 'nahravanie', 'task_num' => 2],
            ['word' => 'video home system', 'task_num' => 2],
            ['word' => 'video', 'task_num' => 2],
            ['word' => 'videorekorder', 'task_num' => 2],
            ['word' => 'paska', 'task_num' => 2],

        ];

        DB::table('meta_keywords')->insert($keyWords);
    }
}
