<?php

namespace App\tests\NYTimesApi\Response;

use App\NYTimesApi\Response\Articles;
use App\NYTimesApi\Response\node\Article;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ArticlesTest extends KernelTestCase
{
    protected $NYTimesArticles;

    public function setUp(): void
    {
        self::bootKernel();
        $this->dir = static::getContainer()->getParameter('kernel.project_dir');
    }

    public function testArticlesResponse(): void
    {
        $articlesResponse = new Articles(file_get_contents(
            $this->dir.'/tests/Resources/articles_response.json'
        ));
        $articles = $articlesResponse->getArticles();

        $this->assertNotEmpty($articles);
        $this->assertCount(10, $articles);
        $this->assertInstanceOf(Article::class, $articles[0]);
        $this->assertEquals('2018-06-01T20:06:14+0000', $articles[0]->getPublicationDate());
        $this->assertEquals('Movies', $articles[1]->getSection());
    }

}