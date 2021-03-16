<?php

namespace  Indexcoder\ChuckNorrisJokes;

// 1.0.1
class JokeFactory
{
    protected $jokes = [
        'Chuck Norris\' tears cure cancer. Too bad he has never cried.',
        'Chuck Norris counted to infinity... Twice.',
        'Chuck Norris does not wear a condom. Because there is no such thing as protection from Chuck Norris.',
    ];

    public function __construct(array $jokes = null)
    {
        if ($jokes) {
            $this->jokes = $jokes;
        }
    }

    public function getRandomJoke()
    {
        return $this->jokes[array_rand($this->jokes)];
    }
}
