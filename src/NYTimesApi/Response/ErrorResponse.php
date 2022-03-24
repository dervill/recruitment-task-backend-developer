<?php

namespace App\NYTimesApi\Response;

class ErrorResponse extends AbstractResponse
{
    protected bool $correctResponse = false;

    public function __construct(string $message)
    {
        parent::__construct('');
        $this->errorMessage = $message;
    }


}