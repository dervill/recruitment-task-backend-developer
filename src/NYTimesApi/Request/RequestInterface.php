<?php

namespace App\NYTimesApi\Request;

interface RequestInterface
{
    public function getTimeout(): int;

    public function setExtraHeaders(array $headers): void;

    public function getQuery(): string;

    public function getMethod(): string;

    public function getRequestBody(): array;
}
