<?php

namespace App\NYTimesApi\Request;

abstract class AbstractRequest implements RequestInterface
{
    protected string $method;
    protected array $requestBody = [];
    protected int $timeout = 5;
    protected array $queryData = [];
    protected string $requestMethod = 'GET';
    protected array $headers = [];

    public function getMethod(): string
    {
        return $this->requestMethod;
    }

    public function getQuery(): string
    {
        return $this->queryData ? $this->method . '?' . http_build_query($this->queryData) : $this->method;
    }

    public function getTimeout(): int
    {
        return $this->timeout;
    }

    public function setExtraHeaders(array $headers): void
    {
        $this->headers = array_merge($this->headers, $headers);
    }

    public function getRequestBody(): array
    {
        return $this->requestBody ?? [];
    }

    // @codeCoverageIgnoreEnd
}
