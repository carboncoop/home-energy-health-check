<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubmitTest extends TestCase
{
    use RefreshDatabase;

    protected $minimalData = [
        'andProcess' => false,
        'assessment' => [
            'assessment_date' => '2018-01-01',
        ],
    ];

    public function testSubmitTheWrongId()
    {
        $response = $this->put('/submit/9001', $this->minimalData);
        $response->assertStatus(404);
    }

    public function testSubmitSomeAssessmentData()
    {
        $this->seedData();
        $this->assertDatabaseHas('assessments', [
            'id' => 1,
            'assessor_name' => 'Tony T. Assessor',
            'assessment_date' => '2012-09-09'
        ]);
        $response = $this->put('/submit/1', $this->minimalData);
        $response->assertStatus(200);
        $response->assertJsonFragment(['status' => 'OK']);
        $this->assertDatabaseHas('assessments', [
            'id' => 1,
            'assessor_name' => 'Tony T. Assessor',
            'assessment_date' => '2018-01-01'
        ]);
    }

    public function testSubmitBogusData()
    {
        $response = $this->put('/submit/1', ['fish' => 'dish']);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['andProcess']);
    }

    public function testSubmitBogusDataJson()
    {
        $response = $this->json('PUT', '/submit/1', ['fish' => 'dish']);
        $response->assertStatus(422);
        $response->assertJsonFragment(['message' => 'The given data was invalid.']);
        $response->assertJsonFragment(['errors' => [
            'andProcess' => ['This field is required.']
        ]]);
    }

    public function testSubmitBogusData2()
    {
        $response = $this->put('/submit/1', [
            'andProcess' => false,
            'assessment' => [
                'assessment_date' => 'FOOD',
            ],
        ]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'assessment.assessment_date'
        ]);
    }

    public function testSubmitBogusData2Json()
    {
        $response = $this->json('PUT', '/submit/1', [
            'andProcess' => false,
            'assessment' => [
                'assessment_date' => 'FOOD',
            ],
        ]);
        $response->assertStatus(422);
        $response->assertJsonFragment(['message' => 'The given data was invalid.']);
        $response->assertJsonFragment(['errors' => [
            'assessment.assessment_date' => ['This is not a valid date.']
        ]]);
    }

}
