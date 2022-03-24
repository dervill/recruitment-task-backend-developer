<?php

namespace App\Services;

class CheckHeaders
{
    /**
     * @param string|null $apiKey
     * @return bool
     */
    public static function isApiKeyValid(?string $apiKey): bool
    {
        return !empty($apiKey) && $apiKey === $_ENV['APP_X_API_KEY'];
    }
}