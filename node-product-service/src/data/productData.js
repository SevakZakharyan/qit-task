const { v4: uuidv4 } = require('uuid');

class ProductData {
  constructor() {
    this.products = this.initializeProducts();
  }

  initializeProducts() {
    return [
      {
        id: uuidv4(),
        name: 'MacBook Pro 14"',
        price: 1999.99,
      },
      {
        id: uuidv4(),
        name: 'iPhone 15 Pro',
        price: 999.99,
      },
      {
        id: uuidv4(),
        name: 'AirPods Pro',
        price: 249.99,
      },
      {
        id: uuidv4(),
        name: 'Samsung 4K TV',
        price: 799.99,
      },
      {
        id: uuidv4(),
        name: 'Gaming Chair',
        price: 299.99,
      }
    ];
  }

  async findAll() {
    return this.products;
  }

  async findById(id) {
    return this.products.find(product => product.id === id);
  }
}

module.exports = ProductData;
