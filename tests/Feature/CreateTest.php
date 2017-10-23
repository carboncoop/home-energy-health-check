<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CreateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    protected $someGoodAssessmentData = [
        'assessment_date' => '2017-10-31',
        'assessor_name' => 'Spooky Halloween Man',
        'homeowner_name' => 'Trevor Testing',
        'homeowner_email' => 'Trevor@example.com',
        'homeowner_phone' => '(+44)7624 123123',
        'homeowner_address' => 'House name\nstreet name\nvillage\nPOST CODE',
    ];

    public function testGetCreateForm()
    {
        $response = $this->get('/submit/create');
        $response->assertStatus(200);
        $response->assertViewIs('submission.create');
    }

    public function testSubmitGoodData()
    {
        $this->assertDatabaseMissing('assessments', $this->someGoodAssessmentData);
        $response = $this->json('put', '/submit', [
            'andProcess' => false,
            'assessment' => $this->someGoodAssessmentData,
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('assessments', $this->someGoodAssessmentData);
    }

    public function testSubmitBogusData()
    {
        $response = $this->json('put', '/submit', [
            'andProcess' => 42,
            'assessment' => ['not' => 'correct']
        ]);
        $response->assertStatus(422);
        $response2 = $this->json('put', '/submit', [
            'andProcess' => false,
            'assessment' => array_splice($this->someGoodAssessmentData, 1, 1)
        ]);
        $response2->assertStatus(422);
    }
}
