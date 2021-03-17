<?php

namespace Indexcoder\ChuckNorrisJokes\Tests;

use Illuminate\Support\Facades\Artisan;
use Indexcoder\ChuckNorrisJokes\ChuckNorrisJokesServiceProvider;
use Indexcoder\ChuckNorrisJokes\Console\ChuckNorrisJoke;
use Indexcoder\ChuckNorrisJokes\Facades\ChuckNorris;
use Indexcoder\ChuckNorrisJokes\Models\Joke;
use Orchestra\Testbench\TestCase;

class LaravelTest extends TestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            ChuckNorrisJokesServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'ChuckNorris' => ChuckNorrisJoke::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        include_once __DIR__.'/../database/migrations/create_jokes_table.php.stub';

        (new \CreateJokesTable)->up();
    }

    /** @test */
    public function the_console_command_returns_a_joke()
    {
        $this->artisan('chuck-norris');

        ChuckNorris::shouldReceive('getRandomJoke')
            ->once()
            ->andReturn('some joke');

        $output = Artisan::output();

        $this->assertSame('some joke'.PHP_EOL, $output);
    }

    /** @test */
    public function the_route_can_be_accessed()
    {
        ChuckNorris::shouldReceive('getRandomJoke')
            ->once()
            ->andReturn('some joke');

        $this->get('/chuck-norris')
            ->assertViewIs('chuck-norris::joke')
            ->assertViewHas('joke', 'some joke')
            ->assertStatus(200);
    }

    /** @test */
    public function it_can_access_the_database()
    {
        $joke = new Joke();
        $joke->joke = 'this is fanny';
        $joke->save();

        $newJoke = Joke::find($joke->id);

        $this->assertSame($newJoke->joke, 'this is fanny');
    }
}
