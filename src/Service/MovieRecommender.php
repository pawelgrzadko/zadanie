<?php
namespace App\Service;

class MovieRecommender
{
    private array $movies;

    public function __construct()
    {
        
        $moviesFile = __DIR__ . '/../../movies.php';
        
        $movies = null;
        (function () use ($moviesFile, &$movies) {
            include $moviesFile;
            if (isset($movies) && is_array($movies)) {
                $movies = $movies;
            } else {
                throw new \RuntimeException("Plik movies.php nie zawiera poprawnej tablicy \$movies.");
            }
        })();

        $this->movies = $movies;
    }

    public function getRandomMovies(): array
    {
        if (empty($this->movies)) return [];
        shuffle($this->movies);
        return array_slice($this->movies, 0, 3);
    }

    public function getMoviesStartingWithW(): array
    {
        return array_values(array_filter($this->movies, function ($movie) {
            return stripos($movie, 'W') === 0 && mb_strlen($movie) % 2 === 0;
        }));
    }

    public function getMultiWordMovies(): array
    {
        return array_values(array_filter($this->movies, function ($movie) {
            return str_word_count($movie) > 1;
        }));
    }
}