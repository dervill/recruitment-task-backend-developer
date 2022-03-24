<?php

namespace App\NYTimesApi\Service;

use App\NYTimesApi\Factory\ResponseFactory;
use App\NYTimesApi\Request\RequestInterface;
use App\NYTimesApi\Response\ErrorResponse;
use App\NYTimesApi\Response\ResponseInterface;

class NYTimesAPI
{
    private string $apiUrl = '';
    private string $apiKey = '';

    public function __construct(
        protected array $nytimes_config
    ) {
        $this->apiUrl = $this->nytimes_config['url'] ?? '';
        $this->apiKey = $this->nytimes_config['key'] ?? '';

    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface|null
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function execute(RequestInterface $request): ?ResponseInterface
    {
        try {
            $curl = curl_init();
            $opt = [
                CURLOPT_URL => $this->apiUrl . $request->getQuery() . '&api-key=' . $this->apiKey,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_CONNECTTIMEOUT => 0,
                CURLOPT_TIMEOUT => $request->getTimeout(),
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            ];

            curl_setopt_array($curl, $opt);
            $response = curl_exec($curl);
            curl_close($curl);

            return ResponseFactory::prepareResponse($response, $request);
        }catch (\Exception $exception) {
            return new ErrorResponse($exception->getMessage());
        }
    }
}
