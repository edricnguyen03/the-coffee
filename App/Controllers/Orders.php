<?php
class Orders extends Controller
{
     public $order_productsModel;
     public $ordersModel;
     public $data;

     public function __construct()
     {
          $this->order_productsModel = $this->model('OrdersProducts');
          $this->ordersModel = $this->model('OrdersModel');
          $this->data = [];
     }
     public function index()
     {
          if (!isset($_SESSION['login']['status'])) {
               $this->__loadError();
          } else {
               $userId = $_SESSION['login']['id'];
               $this->ordersModel->setUserId($userId);
               $orderId = $this->ordersModel->getOrdersId();
               $orders = $this->order_productsModel->getOrderProducts($orderId);
               $data['orders'] = $orders;
               $this->view('/Client/Orders',$data);
          }
     }
     public function __loadError($name = "404")
     {
          require_once './app/errors/' . $name . '.php';
     }
}
