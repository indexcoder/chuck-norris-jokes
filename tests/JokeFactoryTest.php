<?php

namespace Indexcoder\ChuckNorrisJokes\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
<<<<<<< HEAD
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Handler\MockHandler;
=======
>>>>>>> 9328e0b9206f6f0923c30e3153544b7ad6e3edc8
use Indexcoder\ChuckNorrisJokes\JokeFactory;
use PHPUnit\Framework\TestCase;

class JokeFactoryTest extends TestCase
{
    /** @test */
    public function it_returns_a_random_joke()
    {

        // Create a mock and queue two responses.
        $mock = new MockHandler([
            new Response(200, [], '{ "type": "success", "value": { "id": 183, "joke": "Chuck Norris drinks napalm to quell his heartburn.", "categories": [] } }'),
        ]);

        $handlerStack = HandlerStack::create($mock);

        $client = new Client(['handler' => $handlerStack]);

        $jokes = new JokeFactory($client);

        $joke = $jokes->getRandomJoke();

        $this->assertSame('Chuck Norris drinks napalm to quell his heartburn.', $joke);
    }
}
