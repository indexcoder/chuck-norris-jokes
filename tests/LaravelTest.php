<?php

namespace Indexcoder\ChuckNorrisJokes\Tests;

use Illuminate\Support\Facades\Artisan;
use Indexcoder\ChuckNorrisJokes\ChuckNorrisJokesServiceProvider;
use Indexcoder\ChuckNorrisJokes\Console\ChuckNorrisJoke;
use Indexcoder\ChuckNorrisJokes\Facades\ChuckNorris;
use Orchestra\Testbench\TestCase;

class LaravelTest extends TestCase {

    /**
     * Setup the test environment.
    */
    public function setUp() {
        parent::setUp();
    }


    protected function getPackageProviders($app) {
        return [
            ChuckNorrisJokesServiceProvider::class
        ];
    }

    protected function getPackageAliases($app) {
        return [
            'ChuckNorris' => ChuckNorrisJoke::class
        ];
    }

    /** @test */
    public function the_console_command_returns_a_joke() {
        $this->artisan('chuck-norris');

        ChuckNorris::shouldReceive('getRandomJoke')
            ->once()
            ->andReturn('some joke');


        $output = Artisan::output();

        $this->assertSame('some joke' . PHP_EOL, $output);
    }

}