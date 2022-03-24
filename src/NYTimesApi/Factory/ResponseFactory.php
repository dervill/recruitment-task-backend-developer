<?php

namespace App\NYTimesApi\Factory;

use App\NYTimesApi\Request\RequestInterface;
use App\NYTimesApi\Response\ErrorResponse;
use App\NYTimesApi\Response\ResponseInterface;

class ResponseFactory
{
    /**
     * Create response class depends on name of request class
     * @param string $response
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public static function prepareResponse(
        string $response,
        RequestInterface $request,
    ): ResponseInterface {
        try {
            $type = 'App\NYTimesApi\Response\\'.(new \ReflectionClass($request))->getShortName();
            $handler = new $type($response);
        } catch (\Exception $e) {
            return new ErrorResponse($e->getMessage());
        }

        return $handler;
    }
}
