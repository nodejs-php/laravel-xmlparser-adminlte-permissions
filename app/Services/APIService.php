<?php

// Define the namespace for the class.
namespace App\Services;

use App\Repositories\Interfaces\APIServiceInterface;
use Exception;
use Illuminate\Support\Facades\Http;

class APIService implements APIServiceInterface
{
    /**
     * @throws Exception
     */
    public function fetch(string $url): array
    {
        $response = Http::get($url);

        if ($response->failed()) {
            throw new Exception('Не удалось получить данные API.');
        }

        return [
            'body' => $response->body(),
            'content_type' => $response->header('Content-Type'),
        ];
    }

}
