<?php

// Define the namespace for the class.
namespace App\Services;

use App\Repositories\Interfaces\APIServiceInterface;
// Import the Facade for Laravel's HTTP client.
use Illuminate\Support\Facades\Http;

class APIService implements APIServiceInterface
{
    public function fetch(string $url): array
    {
        $response = Http::get($url);

        if ($response->failed()) {
            throw new \Exception('Failed to fetch API data');
        }

        return [
            'body' => $response->body(),
            'content_type' => $response->header('Content-Type'),
        ];
    }

}
