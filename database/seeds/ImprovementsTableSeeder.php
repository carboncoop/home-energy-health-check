<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;
use League\Csv\Statement;
use Carbon\Carbon;

class ImprovementsTableSeeder extends Seeder
{
    public function run()
    {
        $file = base_path() . '/database/seeds/improvements.csv';
        $csv = Reader::createFromPath($file);
        $stmt = (new Statement())->limit(100);
        foreach ($stmt->process($csv) as $row) {
            \DB::table('improvements')->insert(array(
        'title' => $row[0],
        'description' => $row[1],
        'estimated_cost' => $row[2],
        'benefits' => $row[3],
        'who_can_do' => $row[4],
        'assessor_guidance' => $row[6],
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ));
        }
    }
}
