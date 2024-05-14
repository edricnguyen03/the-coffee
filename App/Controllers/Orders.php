<?php
require_once './App/Models/Auth.php';

class Orders extends Controller
{
     private $orderProductsModel;
     private $ordersModel;
     private $data;
     private $productModel;

     public function __construct()
     {
          $this->orderProductsModel = $this->model('OrderProductsModel');
          $this->ordersModel = $this->model('OrdersModel');
          $this->productModel = $this->model('ProductModel');
          $this->data = [];
     }
     public function index()
     {
          if (Auth::hasAdminPermission($_SESSION['login']['id']) == true) {
               echo '<script> alert("Admin không có quyền vào trang này"); </script>';
               require_once './App/errors/404.php';
               return;
          }
          if (!isset($_SESSION['login']['status'])) {
               $this->__loadError();
          } else {
               $userId = $_SESSION['login']['id'];
               $this->ordersModel->setUserId($userId);
               $orderId = $this->ordersModel->getOrdersId();
               if (isset($orderId)) {
                    if (!empty($orderId)) {
                         $order_product = $this->orderProductsModel->getOrderProducts($orderId[0]->id);
                         $data['orders'] = $orderId;
                         $data['order'] = $this->ordersModel->getOrder($orderId[0]->id);
                         $data['order_products'] = $order_product;
                         $data['product'] = [];
                         foreach ($order_product as $product) {
                              $result = $this->productModel->getById($product->product_id);
                              array_push($data['product'], $result);
                         }
                         $this->view('/Client/Orders', $data);
                    } else {
                         $data['orders'] = $orderId;
                         $this->view('/Client/Orders', $data);
                    }
               } else {
                    $this->__loadError();
               }
          }
     }
     public function detail($id = -1)
     {
          $order_product = $this->orderProductsModel->getOrder_OrderProduct($id);
          $data['order_products'] = $order_product;
          $json_data = json_encode($order_product, JSON_FORCE_OBJECT);
          echo $json_data;
     }
     public function __loadError($name = "404")
     {
          require_once './app/errors/' . $name . '.php';
     }
}
