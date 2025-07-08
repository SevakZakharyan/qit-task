<?php

namespace OrderService\DTO;

use DateTime;

class OrderDTO
{
    public function __construct(
        private string $orderId,
        private string $productId,
        private int $quantity,
        private float $totalPrice,
        private DateTime $createdAt
    ) { }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function toArray(): array
    {
        return [
            'orderId' => $this->orderId,
            'productId' => $this->productId,
            'quantity' => $this->quantity,
            'totalPrice' => $this->totalPrice,
            'createdAt' => $this->createdAt->format('c')
        ];
    }
}
