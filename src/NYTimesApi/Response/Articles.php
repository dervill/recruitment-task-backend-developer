<?php

namespace App\NYTimesApi\Response;

use App\NYTimesApi\Response\node\Article;

class Articles extends AbstractResponse
{
    private array $articles = [];

    /**
     * @return array|null
     */
    public function getArticles(): ?array
    {
        if(empty($this->articles)) {
            if(!empty($this->arrayData['response']['docs'])) {
                foreach ($this->arrayData['response']['docs'] as $item) {
                    $this->articles[] = new Article($item);
                }
            }
        }
        return $this->articles;
    }
}
