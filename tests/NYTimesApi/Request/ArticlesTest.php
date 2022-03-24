<?php

namespace App\tests\NYTimesApi\Request;

use App\NYTimesApi\Request\Articles;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ArticlesTest extends KernelTestCase
{
    protected $NYTimesArticles;

    public function setUp(): void
    {
        self::bootKernel();
        $this->dir = static::getContainer()->getParameter('kernel.project_dir');
    }

    public function testArticlesRequest(): void
    {
        $request = new Articles();
        $request->setSort('newest');
        $request->setFilter('news_desk', '"Automobiles" "Cars"');
        $request->setFilter('body', '"test"');

        $this->assertNotEmpty($request->getQuery());
        $this->assertEquals('articlesearch.json?sort=newest&fq=news_desk%3A%28%22Automobiles%22+%22Cars%22%29+AND+body%3A%28%22test%22%29', $request->getQuery());
    }

}