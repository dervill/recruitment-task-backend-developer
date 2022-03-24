<?php

namespace App\NYTimesApi\Response;

use App\NYTimesApi\Response\node\Article;

class Articles extends AbstractResponse
{
    public array $articles = [];

    public function __construct(string $apiData)
    {
        parent::__construct($apiData);

        if(!empty($this->arrayData['response']['docs'])) {
            foreach ($this->arrayData['response']['docs'] as $item) {
                $this->articles[] = new Article($item);
            }
        }
    }

    public function getArticles(int $limit, int $offset = 0): ?array
    {
        return array_slice($this->articles, $offset, $limit);
    }
}
