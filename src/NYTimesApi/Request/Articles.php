<?php

namespace App\NYTimesApi\Request;

class Articles extends AbstractRequest
{
    protected string $method = 'articlesearch.json';
    protected array $queryData = [];

    /**
     * @param string $query
     */
    public function setQuery(string $query): void
    {
        if(!empty($query)) {
            $this->queryData['q'] = $query;
        }
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function setFilter(string $key, string $value): void
    {
        if(!empty($key) && !empty($value)) {
            if(!empty($this->queryData['fq'])) {
                $this->queryData['fq'] .= ' AND '. $key . ':('.$value.')';
            } else {
                $this->queryData['fq'] = $key . ':('.$value.')';
            }
        }
    }

    /**
     * @param string $sort
     */
    public function setSort(string $sort): void
    {
        if(!empty($sort)) {
            $this->queryData['sort'] = $sort;
        }
    }

}
