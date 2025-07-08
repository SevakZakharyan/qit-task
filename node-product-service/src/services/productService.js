const ProductData = require('../data/productData');

class ProductService {
  constructor() {
    this.storage = new ProductData();
  }

  async getAllProducts() {
    return this.storage.findAll();
  }

  async getProductById(id) {
    return this.storage.findById(id);
  }
}

module.exports = ProductService;
