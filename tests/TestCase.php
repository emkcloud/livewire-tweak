<?php

namespace Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    protected function getEnvironmentSetUp($app) {}

    protected function getPackageProviders($app) {}

    protected function setUp(): void
    {
        parent::setUp();
    }
}
