<?php

namespace App\Controller;

use App\Services\CheckHeaders;
use App\Services\NYTimesArticles;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/nytimes/{query}", name="app_nytime_articles_search")
     */
    public function search(Request $request, NYTimesArticles $NYTimesArticles, string $query = ''): Response
    {
        if($query !== '' && !CheckHeaders::isApiKeyValid($request->headers->get('API-KEY'))) {
            return new JsonResponse('Unauthorized', 401);
        }

        $NYTimesArticles->setFindPhrase($query);
        $articles = $NYTimesArticles->getArticles();

        return new JsonResponse($articles);
    }
}