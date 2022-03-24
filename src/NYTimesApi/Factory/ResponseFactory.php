<?php

namespace App\NYTimesApi\Factory;

use App\NYTimesApi\Request\RequestInterface;
use App\NYTimesApi\Response\ErrorResponse;
use App\NYTimesApi\Response\ResponseInterface;

class ResponseFactory
{
    public static function prepareResponse(
        string $response,
        RequestInterface $request,
    ): ResponseInterface {
        try {
            $type = 'App\NYTimesApi\Response\\'.(new \ReflectionClass($request))->getShortName();
            // @codeCoverageIgnoreStart
        } catch (\Exception $e) {
            return new ErrorResponse($e->getMessage());
        }
        // @codeCoverageIgnoreEnd

        try {
            $handler = new $type($response);
            // @codeCoverageIgnoreStart
        } catch (\Exception $e) {
            return new ErrorResponse($e->getMessage());
        }
        // @codeCoverageIgnoreEnd

        return $handler;
    }
}
