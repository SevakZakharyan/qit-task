# Node.js Product Service

A RESTful API service for getting products list and single product by id.

## Setup Instructions

1. **Navigate to the directory from the root of the project**
   ```bash
   cd node-product-service
   ```

2. **Install Dependencies**
   Run the following command to install all Node.js dependencies:
   ```bash
   npm install
   ```

3. **Configure Environment Variables**
   Create a `.env` file at the root directory based on the provided example `.env.example`. Set the required environment variables, such as:

4. **Run the Service**
   Start the server by running:
   ```bash
   npm start
   ```
   The service will start and be accessible at `http://localhost:3000`.

## API Endpoints

### **GET /api/products**
- **Description**: Retrieves a list of all products.
- **Full Path**: http://localhost:3000/api/products
- **Response**:
  ```json
  {
    "success": true,
    "data": [
      {
        "id": "8a64527b-ef9e-4f13-b9dc-672191acf72d",
        "name": "Sample Product 1",
        "price": 19.99
      },
      {
        "id": "0f5c34f4-fabc-4630-bcfe-43ed73d3061b",
        "name": "Sample Product 2",
        "price": 39.99
      }
    ],
    "count": 2
  }
  ```
- **Example cURL Request**:
  ```bash
  curl --location 'http://localhost:3000/api/products'
  ```

### **GET /api/products/:id**
- **Description**: Retrieves details of a single product by ID.
- **Full Path**: http://localhost:3000/api/products/:id
- **Request Parameters**:
  - **id**: The UUID of the product to retrieve.
- **Response**:
  ```json
  {
    "success": true,
    "data": {
      "id": "8a64527b-ef9e-4f13-b9dc-672191acf72d",
      "name": "Sample Product",
      "price": 19.99
    }
  }
  ```
- **Example cURL Request**:
  ```bash
  curl --location 'http://localhost:3000/api/products/uuid'
  ```

---
