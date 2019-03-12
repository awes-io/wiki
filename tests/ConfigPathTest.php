<?php

namespace Awes\Wiki\Tests;

use Orchestra\Testbench\TestCase;
use Awes\Wiki\WikiServiceProvider;

class ConfigPathTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [WikiServiceProvider::class];
    }

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        parent::setUp();
    }

    public function testConfigIsCorrect()
    {
        $this->assertEquals(realpath(__DIR__ . '/../docs'), realpath(config('docs.path')));
    }
}
