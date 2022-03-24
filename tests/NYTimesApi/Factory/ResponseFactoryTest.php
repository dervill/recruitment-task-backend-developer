<?php

namespace App\tests\NYTimesApi\Factory;

use App\NYTimesApi\Factory\ResponseFactory;
use App\NYTimesApi\Request\Articles;
use App\NYTimesApi\Response\node\Article;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ResponseFactoryTest extends KernelTestCase
{
    protected $NYTimesArticles;

    public function setUp(): void
    {
        self::bootKernel();
        $this->dir = static::getContainer()->getParameter('kernel.project_dir');
    }

    public function testPrepareResponse(): void
    {
        $response = file_get_contents(
            $this->dir.'/tests/Resources/articles_response.json'
        );

        $responseArticles = ResponseFactory::prepareResponse($response, new Articles());
        $this->assertInstanceOf(\App\NYTimesApi\Response\Articles::class, $responseArticles);
    }

}