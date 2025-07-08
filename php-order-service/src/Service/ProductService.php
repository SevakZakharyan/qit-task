<?php

namespace OrderService\Service;

use OrderService\DTO\ProductDTO;
use OrderService\HttpClient\ProductApiClient;
use InvalidArgumentException;
use Exception;

class ProductService
{
    private ProductApiClient $apiClient;

    public function __construct()
    {
        $this->apiClient = new ProductApiClient();
    }

    public function getProduct(string $productId): ?ProductDTO
    {
        $productData = $this->apiClient->getProduct($productId);
        
        if (!$productData) {
            return null;
        }

        return new ProductDTO(
            $productData['id'],
            $productData['name'],
            $productData['price'],
        );
    }

    public function getProductPrice(string $productId): float
    {
        $product = $this->getProduct($productId);
        
        if (!$product) {
            throw new InvalidArgumentException('Product not found');
        }

        return $product->getPrice();
    }

    public function calculateOrderTotal(string $productId, int $quantity): float
    {
        if ($quantity <= 0) {
            throw new InvalidArgumentException('Quantity must be positive');
        }

        $price = $this->getProductPrice($productId);

        return $price * $quantity;
    }
}
