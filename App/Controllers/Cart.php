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

     public function deleteProductInCart()
     {
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
               if (!empty($_POST['User_id']) && !empty($_POST['idProduct'])) {
                    $User_id = $_POST['User_id'];
                    $idProduct = $_POST['idProduct'];
                    $this->cartModel->deleteProductInCart($User_id, $idProduct);
               }
          }
     }
}
