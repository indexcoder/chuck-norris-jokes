<?php

namespace Indexcoder\ChuckNorrisJokes\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Indexcoder\ChuckNorrisJokes\JokeFactory;
use PHPUnit\Framework\TestCase;

class JokeFactoryTest extends TestCase
{
    /** @test */
    public function it_returns_a_random_joke()
    {
        // Create test
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
