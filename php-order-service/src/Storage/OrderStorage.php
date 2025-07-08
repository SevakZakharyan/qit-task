<?php

namespace OrderService\Storage;

use OrderService\DTO\OrderDTO;

class OrderStorage
{
    public function __construct()
    {
        $this->startSession();
    }

    private function startSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['orders'])) {
            $_SESSION['orders'] = [];
        }
    }

    public function save(OrderDTO $order): void
    {
        $_SESSION['orders'][$order->getOrderId()] = $order->toArray();
    }

    public function findAll(): array
    {
        $orders = [];
        foreach ($_SESSION['orders'] as $orderData) {
            $orders[] = $this->arrayToOrder($orderData);
        }
        return $orders;
    }

    public function findById(string $orderId): ?OrderDTO
    {
        if (isset($_SESSION['orders'][$orderId])) {
            return $this->arrayToOrder($_SESSION['orders'][$orderId]);
        }
        return null;
    }

    public function clear(): void
    {
        $_SESSION['orders'] = [];
    }

    private function arrayToOrder(array $data): OrderDTO
    {
        return new OrderDTO(
            $data['orderId'],
            $data['productId'],
            $data['quantity'],
            $data['totalPrice'],
            new \DateTime($data['createdAt'])
        );
    }
}
