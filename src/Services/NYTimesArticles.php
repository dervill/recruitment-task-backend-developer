<?php

namespace App\Services;

use App\NYTimesApi\Request\Articles;
use App\NYTimesApi\Response\node\Article;
use App\NYTimesApi\Service\NYTimesAPI;

class NYTimesArticles
{
    protected ?string $searchQuery = null;

    public function __construct(
        protected NYTimesAPI $NYTimesAPI
    ) {}

    public function getArticles(): array
    {
        $request = new Articles();
        $request->setQuery($this->searchQuery ?? '');
        $request->setSort('newest');
        $request->setFilter('news_desk:("Automobiles" "Cars")');

        /** @var \App\NYTimesApi\Response\Articles $response */
        $response = $this->NYTimesAPI->execute($request);
        if($response->isCorrect()) {
            return $this->toArray($response->getArticles(10));
        }
        return [];
    }

    public function setQueryToFind(string $query): void
    {
        $this->searchQuery = $query;
    }

    private function toArray(?array $articles): array
    {
        $response = [];

        if(!empty($articles)) {
            /** @var Article $article */
            foreach ($articles as $article) {
                $response[] = [
                    'title' => $article->getTitle(),
                    'publicationDate' => $article->getPublicationDate(),
                    'lead' => $article->getLeadParagraph(),
                    'image' => $article->getImage(),
                    'url' => $article->getWebUrl(),
                    'section' => $article->getSection(),
                    'subsection' => $article->getSubsection()

                ];
            }
        }
        return $response;
    }
}