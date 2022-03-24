<?php

namespace App\NYTimesApi\Response;

use Psr\Log\LoggerInterface;

abstract class AbstractResponse implements ResponseInterface
{
    protected ?string $rawData = null;
    protected ?array $arrayData = null;
    protected bool $isCorrectResponse = true;
    protected ?string $errorMessage = null;

    public function __construct(
        protected string $apiData
    )
    {
        $this->rawData = $apiData;

        $this->arrayData = json_decode($apiData, true);

        if ($apiData && null === $this->arrayData) {
            // @codeCoverageIgnoreStart
            $this->logger->critical('Response is not valid JSON', ['raw' => $this->getRawData()]);
            // @codeCoverageIgnoreEnd
        }
    }

    public function toArray(): ?array
    {
        return $this->arrayData['response'] ?? null;
    }

    public function getRawData(): string
    {
        return $this->rawData;
    }

    public function getErrorMsg(): ?string
    {
        return $this->errorMessage;
    }

    public function isCorrect(): bool
    {
        return $this->isCorrectResponse;
    }
}
