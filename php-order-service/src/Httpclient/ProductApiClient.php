<?php
namespace OrderService\HttpClient;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Exception;

class ProductApiClient
{
    private Client $client;
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = $_ENV['PRODUCT_SERVICE_URL'] ?? 'http://localhost:3000';
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => 10.0,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);
    }

    public function getProduct(string $productId): ?array
    {
        try {
            $response = $this->client->get("/api/products/{$productId}");
            
            if ($response->getStatusCode() !== 200) {
                return null;
            }

            $data = json_decode($response->getBody()->getContents(), true);
            
            return $data['success'] ? $data['data'] : null;

        } catch (RequestException $e) {
            error_log("Product API request failed: " . $e->getMessage());

            return null;
        } catch (Exception $e) {
            error_log("Unexpected error: " . $e->getMessage());

            return null;
        }
    }
}
