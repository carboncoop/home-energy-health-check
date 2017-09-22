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
        $this->seed_sections();

        \DB::table('assessments')->insert([
            'email_address' => 'test-user@example.com',
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
                'section_id' => 1 + (int)$row[1],
                'description' => $row[2],
                'estimated_cost' => $row[3],
                'benefits' => $row[4],
                'who_can_do' => $row[5],
                'assessor_guidance' => $row[7],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }

    protected function seed_sections()
    {
        $file = base_path() . '/database/seeds/sections.csv';
        $csv = Reader::createFromPath($file);
        $stmt = (new Statement())->limit(100);
        foreach ($stmt->process($csv) as $row) {
            \DB::table('sections')->insert([
                'title' => $row[0],
                'description' => $row[1],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }

}
