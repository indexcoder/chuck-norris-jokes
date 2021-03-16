<?php

namespace Indexcoder\ChuckNorrisJokes\Tests;

use Indexcoder\ChuckNorrisJokes\JokeFactory;
use PHPUnit\Framework\TestCase;

class JokeFactoryTest extends TestCase
{
    /** @test */
    public function it_returns_a_random_joke()
    {
        $jokes = new JokeFactory([
            'This is a joke',
        ]);

        $joke = $jokes->getRandomJoke();

        $this->assertSame('This is a joke', $joke);
    }

    /** @test */
    public function it_returns_a_predefined_joke()
    {
        $ChuckJokes = [
            'Chuck Norris\' tears cure cancer. Too bad he has never cried',
            'Chuck Norris counted to infinity... Twice.',
            'Chuck Norris does not wear a condom. Because there is no such thing as protection from Chuck Norris.',
        ];

        $jokes = new JokeFactory();

        $joke = $jokes->getRandomJoke();

        $this->assertContains($joke, $ChuckJokes);
    }
}
