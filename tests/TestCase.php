<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp()
    {
        parent::setUp();
        //\Artisan::call('migrate');
        //\Artisan::call('db:seed', ['--class' => 'DatabaseSeeder', '--database' => 'mysql']);
    }

    public function tearDown()
    {
        parent::tearDown();
        //\Artisan::call('migrate:reset');
    }


}
