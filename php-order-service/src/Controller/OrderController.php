<?php

namespace OrderService\Controller;

use OrderService\Service\OrderService;
use OrderService\DTO\CreateOrderDTO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use InvalidArgumentException;
use Exception;

class OrderController
{
    private OrderService $orderService;

    public function __construct()
    {
        $this->orderService = new OrderService();
    }

    public function createOrder(Request $request, Response $response): Response
    {
        try {
            $data = $request->getParsedBody();

            if (!isset($data['productId']) || !isset($data['quantity'])) {
                return $this->jsonResponse($response, [
                    'success' => false,
                    'error' => 'Missing required fields: productId and quantity'
                ], 400);
            }

            if (!is_numeric($data['quantity']) || (int)$data['quantity'] <= 0) {
                return $this->jsonResponse($response, [
                    'success' => false,
                    'error' => 'Quantity must be a positive integer'
                ], 400);
            }

            $createOrderDTO = new CreateOrderDTO(
                $data['productId'],
                (int)$data['quantity']
            );

            $order = $this->orderService->createOrder($createOrderDTO);

            return $this->jsonResponse($response, [
                'success' => true,
                'data' => $order->toArray()
            ], 201);

        } catch (InvalidArgumentException $e) {
            return $this->jsonResponse($response, [
                'success' => false,
                'error' => $e->getMessage()
            ], 400);
        } catch (Exception $e) {
            return $this->jsonResponse($response, [
                'success' => false,
                'error' => 'Internal server error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getAllOrders(Request $request, Response $response): Response
    {
        try {
            $orders = $this->orderService->getAllOrders();
            
            return $this->jsonResponse($response, [
                'success' => true,
                'data' => array_map(fn($order) => $order->toArray(), $orders),
                'count' => count($orders)
            ]);

        } catch (Exception $e) {
            return $this->jsonResponse($response, [
                'success' => false,
                'error' => 'Internal server error: ' . $e->getMessage()
            ], 500);
        }
    }

    private function jsonResponse(Response $response, array $data, int $status = 200): Response
    {
        $payload = json_encode($data);
        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($status);
    }
}
