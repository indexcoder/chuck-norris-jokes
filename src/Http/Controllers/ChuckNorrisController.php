<?php

namespace  Indexcoder\ChuckNorrisJokes\Http\Controller;

use Indexcoder\ChuckNorrisJokes\Facades\ChuckNorris;

class ChuckNorrisController
{
    public function __invoke()
    {
        return view('chuck-norris::joke', [
            'joke' => ChuckNorris::getRandomJoke(),
        ]);
    }
}
