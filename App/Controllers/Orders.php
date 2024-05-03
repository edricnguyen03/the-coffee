<?php
class Orders extends Controller
{
     public $orderProductsModel;
     public $ordersModel;
     public $data;

     public function __construct()
     {
          $this->orderProductsModel = $this->model('OrderProductsModel');
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
               if (isset($orderId)){
                    if(!empty($orderId)){
                         $order_product = $this->orderProductsModel->getOrderProducts($orderId[0]->id);
                         $data['orders'] = $orderId;
                         $data['order'] = $this->ordersModel->getOrder($orderId[0]->id);
                         $data['order_products'] = $order_product;
                         $this->view('/Client/Orders', $data);
                    }else{
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
