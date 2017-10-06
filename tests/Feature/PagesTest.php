<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PagesTest extends TestCase
{
    use RefreshDatabase;

    public function testWeCanSeeHomepage()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('welcome');
    }

    public function testWeCantSeeNonExistentPages()
    {
        $response = $this->get('/foobarbaz');
        $response->assertStatus(404);
    }

    public function testMethodIsNotAllowedOnEndpoint()
    {
        $response = $this->get('/submit/1');
        $response->assertStatus(405);
    }

    public function testWeCanSeeSubmissionForm()
    {
        $this->seedData();
        $this->assertDatabaseHas('assessments', [
            'id' => 1,
            'assessor_name' => 'Tony T. Assessor',
            'assessment_date' => '2012-09-09'
        ]);
        $response = $this->get('/submit/1/edit');
        $response->assertStatus(200);
        $response->assertViewIs('submission.edit');
        $response->assertViewHas('json_parts');
        $response->assertViewHas('json_improvements');
    }
}
