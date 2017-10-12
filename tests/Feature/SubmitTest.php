<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubmitTest extends TestCase
{
    use RefreshDatabase;

    public function testSubmitTheWrongId()
    {
        $response = $this->put('/submit/9001', [
            'andProcess' => false,
        ]);
        $response->assertStatus(404);
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
        $response->assertJsonFragment([
            'assessment.assessment_date' => ['This is not a valid date.']
        ]);
    }

    public function testSubmitSomeAssessmentData()
    {
        $this->seedData();
        $this->assertDatabaseHas('assessments', [
            'id' => 1,
            'assessor_name' => 'Tony T. Assessor',
            'assessment_date' => '2012-09-09'
        ]);

        $response = $this->put('/submit/1', [
            'andProcess' => false,
            'assessment' => [
                'assessment_date' => '2018-01-01',
                'assessor_name' => 'A New Name Added',
                'homeowner_name' => 'Tony B. Bssessor',
                'homeowner_email' => 'someone@example.com',
                'homeowner_phone' => '0998 555 555',
                'homeowner_address' => 'some text',
            ],
            'improvements' => [
                [
                    'improvement_id' => 22,
                    'value' => 'need',
                    'comment' => 'Ba la fa',
                ]
            ],
        ]);
        $response->assertStatus(200);
        $response->assertJsonFragment(['status' => 'OK']);
        $this->assertDatabaseHas('assessments', [
            'id' => 1,
            'assessor_name' => 'A New Name Added',
            'homeowner_name' => 'Tony B. Bssessor',
            'assessment_date' => '2018-01-01',
        ]);
        $this->assertDatabaseHas('assessment_improvements', [
            'assessment_id' => 1,
            'improvement_id' => 22,
            'value' => 'need',
            'comment' => 'Ba la fa',
        ]);
    }

    public function testBadImprovementSubmission()
    {
        $this->seedData();
        $response = $this->json('PUT', '/submit/1', [
            'andProcess' => false,
            'assessment' => [
                'assessment_date' => '2018-01-01',
            ],
            'improvements' => [
                [
                    'improvement_id' => 'hello',
                    'value' => 'need',
                ]
            ],
        ]);
        $response->assertStatus(422);
        $this->assertDatabaseMissing('assessment_improvements', [
            'assessment_id' => 1,
            'improvement_id' => 'hello',
            'value' => 'need',
            'comment' => null,
        ]);
    }

}
