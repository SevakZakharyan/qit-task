# PHP Order Service

A RESTful API service for managing orders as part of the Order Management System. This service communicates with the Node.js Product Service to fetch product details and calculate the order details.

## Features

- Create new orders.
- Retrieve a list of all orders.
- Communicates with the Product Service to fetch product information via REST API calls.
- Clean, modular architecture for maintainability.

## Setup Instructions

1. **Navigate to the directory from the root of the project**
   ```bash
   cd php-order-service
   ```

2. **Install Dependencies**
   Run the following command to install all required PHP dependencies:
   ```bash
   composer install
   ```

3. **Configure Environment Variables**
   Create a `.env` file at the root directory based on the provided example `.env.example`. Set the required environment variables, such as:


4. **Run the Service**
   Start PHP server:
   ```bash
   php -S localhost:8000 index.php
   ```
   The service will be available at `http://localhost:8000`.

## API Endpoints

### **POST /api/orders**
- **Description**: Creates a new order for a product.
- **Full Path**: http://localhost:8000/api/orders
- **Request Body**:
  ```json
  {
    "productId": "UUID",
    "quantity": 2
  }
  ```
- **Response**:
  ```json
  {
    "orderId": "UUID",
    "productId": "UUID",
    "quantity": 2,
    "totalPrice": 40.00,
    "createdAt": "2025-07-08T10:00:00Z"
  }
  ```
- **Example cURL Request**:
  ```bash
  curl --location 'http://localhost:8000/api/orders' \
  --header 'Content-Type: application/json' \
  --header 'Cookie: PHPSESSID=sessid' \
  --data '{
    "productId": "6149ee98-0233-42ff-b644-f21148f960b6",
    "quantity": 6
  }'

  ```

### **GET /api/orders**
- **Description**: Retrieves a list of all created orders.
- **Full Path**: http://localhost:8000/api/orders
- **Response**:
  ```json
  [
    {
      "orderId": "UUID",
      "productId": "UUID",
      "quantity": 2,
      "totalPrice": 40.00,
      "createdAt": "2025-07-08T10:00:00Z"
    }
  ]
  ```
- **Example cURL Request**:
  ```bash
  curl --location 'http://localhost:8000/api/orders' \
  --header 'Cookie: PHPSESSID=sessid'
  ```

