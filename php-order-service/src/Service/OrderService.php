<?php

namespace OrderService\Service;

use OrderService\DTO\CreateOrderDTO;
use OrderService\DTO\OrderDTO;
use OrderService\Storage\OrderStorage;
use OrderService\Service\ProductService;
use InvalidArgumentException;
use Exception;

class OrderService
{
    private OrderStorage $storage;
    private ProductService $productService;

    public function __construct()
    {
        $this->storage = new OrderStorage();
        $this->productService = new ProductService();
    }

    public function createOrder(CreateOrderDTO $createOrderDTO): OrderDTO
    {
        $product = $this->productService->getProduct($createOrderDTO->getProductId());

        if (!$product) {
            throw new InvalidArgumentException('Product not found');
        }

        $totalPrice = $this->productService->calculateOrderTotal(
            $createOrderDTO->getProductId(),
            $createOrderDTO->getQuantity()
        );

        $order = new OrderDTO(
            $this->generateOrderId(),
            $createOrderDTO->getProductId(),
            $createOrderDTO->getQuantity(),
            $totalPrice,
            new \DateTime()
        );

        $this->storage->save($order);

        return $order;
    }

    public function getAllOrders(): array
    {
        return $this->storage->findAll();
    }

    private function generateOrderId(): string
    {
        return \Ramsey\Uuid\Uuid::uuid4()->toString();
    }
}
