<?php

namespace App\NYTimesApi\Response;

interface ResponseInterface
{
    public function toArray(): ?array;
    public function getRawData(): ?string;
    public function isCorrect(): bool;
    public function getErrorMsg(): ?string;
}
