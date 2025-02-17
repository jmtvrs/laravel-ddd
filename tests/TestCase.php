<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use PHPUnit\Framework\Exception;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (config('database.default') !== 'sqlite') {
            throw new Exception(sprintf(
                'Cannot run tests using the %s database driver. It should be sqlite.',
                config('database.default'),
            ));
        }
    }
}
