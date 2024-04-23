<?php
class Cart extends Controller
{
     public $cartModel;
     public $data;
     public $productModel;

     public function __construct()
     {
          $this->cartModel = $this->model('CartModel');
          $this->data = [];
          $this->productModel = $this->model('ProductModel');
     }

     public function index()
     {
          if (!isset($_SESSION['login']['id'])) {
               require_once './App/errors/404.php';
               return;
          }

          $productsInCart = $this->cartModel->getProductsInCart($_SESSION['login']['id']);
          $products = $this->productModel->getAllProducts();

          $this->data['productsInCart'] = $productsInCart;
          $this->data['products'] = $products;
          $this->view('/Client/Cart', $this->data);
     }
}
