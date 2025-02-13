<?php

namespace App\Tests;

use App\Service\MovieRecommender;
use PHPUnit\Framework\TestCase;

class MovieRecommendationServiceTest extends TestCase
{
    private MovieRecommender $movieService;

    protected function setUp(): void
    {
        $this->movieService = new MovieRecommender();
    }

    public function testGetRandomMovies()
    {
        $movies = $this->movieService->getRandomMovies();
        $this->assertCount(3, $movies);
    }

    public function testGetMoviesStartingWithW()
    {
        $movies = $this->movieService->getMoviesStartingWithW();
        foreach ($movies as $movie) {
            $this->assertStringStartsWith('W', $movie);
            $this->assertEquals(0, mb_strlen($movie) % 2);
        }
    }

    public function testGetMultiWordMovies()
    {
        $movies = $this->movieService->getMultiWordMovies();
        foreach ($movies as $movie) {
            $this->assertGreaterThan(1, str_word_count($movie));
        }
    }
}
