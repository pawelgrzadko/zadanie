<?php

namespace App\Controller;

use App\Service\MovieRecommender;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MovieController extends AbstractController
{
    private MovieRecommender $recommender;

    public function __construct(MovieRecommender $recommender)
    {
        $this->recommender = $recommender;
    }

    #[Route('/movies/{method}', name: 'movie_recommendation', methods: ['GET'])]
    public function getMovies(string $method): JsonResponse
    {
        $response = match ($method) {
            'random' => $this->recommender->getRandomMovies(),
            'letter_w' => $this->recommender->getMoviesStartingWithW(),
            'multi_word' => $this->recommender->getMultiWordMovies(),
            default => throw new \InvalidArgumentException()
        };

        return $this->json($response);
    }
}