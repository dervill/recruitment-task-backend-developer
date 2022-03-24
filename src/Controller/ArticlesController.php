<?php

namespace App\Controller;

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
    public function search(NYTimesArticles $NYTimesArticles, ?string $query = null): Response
    {
        $NYTimesArticles->setQueryToFind($query ?? '');
        $articles  = $NYTimesArticles->getArticles();

        echo '<pre>';
        print_r($articles);exit;
        return new JsonResponse($articles);
    }
}