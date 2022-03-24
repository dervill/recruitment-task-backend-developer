<?php

namespace App\NYTimesApi\Request;

class Articles extends AbstractRequest
{
    protected string $method = 'articlesearch.json';
    protected array $queryData = [];

    public function setQuery(string $query): void
    {
        if(!empty($query)) {
            $this->queryData['q'] = $query;
        }
    }

    public function setFilter(string $filter): void
    {
        if(!empty($filter)) {
            $this->queryData['fq'] = $filter;
        }
    }

    public function setSort(string $sort): void
    {
        if(!empty($sort)) {
            $this->queryData['sort'] = $sort;
        }
    }

}
