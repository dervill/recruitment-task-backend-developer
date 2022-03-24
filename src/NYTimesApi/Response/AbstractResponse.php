<?php

namespace App\NYTimesApi\Response;


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
        $this->arrayData = @json_decode($apiData, true);
    }

    /**
     * @return array|null
     */
    public function toArray(): ?array
    {
        return $this->arrayData['response'] ?? null;
    }

    /**
     * @return string
     */
    public function getRawData(): string
    {
        return $this->rawData;
    }

    /**
     * @return string|null
     */
    public function getErrorMsg(): ?string
    {
        return $this->errorMessage;
    }

    /**
     * @return bool
     */
    public function isCorrect(): bool
    {
        return $this->isCorrectResponse;
    }
}
