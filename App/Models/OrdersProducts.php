<?php
class OrdersProducts
{
     public function __construct()
     {
     }
     public function getOrderProducts($orderId = array())
     {
          if ($orderId != null) {
               global $db;
               $orders = [];
               foreach ($orderId as $item){
                    $result = $db->get("order_products", "*", "order_id = $item->id");
                    foreach ($result as $row) {
                         $order = (object) $row;
                         $orders[] = $order;
                    }
               }
               return $orders;
          }
     }
     public function getOrderProducts2($orderId)
     {
          if ($orderId != null) {
               global $db;
               $orders = $db->get("order_products", "*", "order_id = " .$orderId); // Gán kết quả cho $orders
               return $orders; // Trả về biến đã gán
          }
          return null;
     }

      public function getUserById($userId)
    {
        global $db;
        $user = $db->get('users', '*', 'id = ' . $userId);
        return $user;
    }

    public function getAllorders_products()
    {
        global $db;
        $users = $db->get('order_products');
        return $users;
    }
}
