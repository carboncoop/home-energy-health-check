<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function seedData()
    {
        \Artisan::call('db:seed', [
            '--env' => 'testing',
            '--database' => 'sqlite_testing',
        ]);
    }

}
