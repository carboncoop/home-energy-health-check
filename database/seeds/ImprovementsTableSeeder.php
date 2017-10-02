<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;
use League\Csv\Statement;
use Carbon\Carbon;

class ImprovementsTableSeeder extends Seeder
{

    public function run()
    {
        $this->seed_improvements();
        $this->seed_parts();

        \DB::table('assessments')->insert([
            'homeowner_email' => 'test-user@example.com',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }

    protected function seed_improvements()
    {
        $file = base_path() . '/database/seeds/improvements.csv';
        $csv = Reader::createFromPath($file);
        $stmt = (new Statement())->limit(100);
        foreach ($stmt->process($csv) as $row) {
            \DB::table('improvements')->insert([
                'title' => $row[0],
                'assessor_comment' => $row[1],
                'part_id' => (int)$row[2],
                'description' => $row[3],
                'estimated_cost' => $row[4],
                'benefits' => $row[5],
                'who_can_do' => $row[6],
                'assessor_guidance' => $row[8],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }

    protected function seed_parts()
    {
        $file = base_path() . '/database/seeds/sections.csv';
        $csv = Reader::createFromPath($file);
        $stmt = (new Statement())->limit(100);
        foreach ($stmt->process($csv) as $row) {
            \DB::table('parts')->insert([
                'title' => $row[0],
                'description' => $row[1],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }

}
