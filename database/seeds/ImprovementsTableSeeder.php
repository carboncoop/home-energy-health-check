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
        $this->seed_sections();

        \DB::table('assessments')->insert([
            'homeowner_email' => 'test-user@example.com',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }

    protected function seed_from_csv($path, $table, $data)
    {
        $file = base_path() . $path;
        $csv = Reader::createFromPath($file);
        $stmt = (new Statement())->limit(100);
        foreach ($stmt->process($csv) as $row) {
            \DB::table($table)->insert($data($row));
        }
    }

    protected function seed_improvements()
    {
        $this->seed_from_csv('/database/seeds/improvements.csv',
            'improvements', function($row) {
            return [
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
            ];
        });
    }

    protected function seed_parts()
    {
        $this->seed_from_csv('/database/seeds/parts.csv',
            'parts', function($row) {
            return [
                'title' => $row[0],
                'description' => $row[1],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ];
        });
    }

    protected function seed_sections()
    {
        $this->seed_from_csv('/database/seeds/sections.csv',
            'sections', function($row) {
            return [
                'title' => $row[0],
                'body' => $row[1],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ];
        });
    }

}
