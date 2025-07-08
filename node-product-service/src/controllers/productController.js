const ProductService = require('../services/ProductService');

class ProductController {
  constructor() {
    this.productService = new ProductService();
  }

  async getAllProducts(req, res) {
    try {
      const products = await this.productService.getAllProducts();
      res.json({ success: true, data: products, count: products.length });
    } catch (error) {
      res.status(500).json({ success: false, error: error.message });
    }
  }

  async getProductById(req, res) {
    try {
      const { id } = req.params;
      const product = await this.productService.getProductById(id);

      if (!product) {
        return res.status(404).json({ success: false, error: 'Product not found' });
      }

      res.json({ success: true, data: product });
    } catch (error) {
      res.status(500).json({ success: false, error: error.message });
    }
  }
}

module.exports = ProductController;
