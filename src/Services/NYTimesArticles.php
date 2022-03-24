<?php

namespace App\Services;

use App\NYTimesApi\Request\Articles;
use App\NYTimesApi\Response\node\Article;
use App\NYTimesApi\Service\NYTimesAPI;

class NYTimesArticles
{
    protected string $searchQuery = '';

    public function __construct(
        protected NYTimesAPI $NYTimesAPI
    ) {}

    /**
     * @return array
     */
    public function getArticles(): array
    {
        $request = new Articles();
        $request->setSort('newest');
        $request->setFilter('news_desk', '"Automobiles" "Cars"');
        if($this->searchQuery) {
            $request->setFilter('body', '"'.$this->searchQuery.'"');
        }

        /** @var \App\NYTimesApi\Response\Articles $response */
        $response = $this->NYTimesAPI->execute($request);

        if($response->isCorrect()) {
            return $this->toArray($response->getArticles());
        }

        return [];
    }

    /**
     * @param string $query
     */
    public function setFindPhrase(string $query): void
    {
        $this->searchQuery = $query;
    }

    /**
     * @param array|null $articles
     * @return array
     */
    private function toArray(?array $articles): array
    {
        $response = [];

        if(!empty($articles)) {
            /** @var Article $article */
            foreach ($articles as $k => $article) {
                $response[$k] = [
                    'title' => $article->getTitle(),
                    'publicationDate' => $article->getPublicationDate(),
                    'lead' => $article->getLeadParagraph(),
                    'image' => $article->getImage(),
                    'url' => $article->getWebUrl(),
                    'section' => $article->getSection(),
                    'subsection' => $article->getSubsection()
                ];
                if(empty($this->searchQuery)) {
                   unset($response[$k]['section']);
                   unset($response[$k]['subsection']);
                }
            }
        }
        return $response;
    }
}