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
     public function get()
     {
          return 1;
     }
}
