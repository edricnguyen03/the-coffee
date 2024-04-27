<?php
class OrdersModel
{
     private $orderId;
     function __construct()
     {
     }
     public function setOrderId($orderId)
     {
          $this->orderId = $orderId;
     }

     public function getAllOrdersTitle($orderId)
     {
          $this->orderId = $orderId;
     }

     public function getAllProduct_idByOrderId($orderId)
     {
          $this->orderId = $orderId;
     }

     public function getOrdersById()
     {
          try {
               global $db;
               $result = $db->get(table: "orders", fields : "id",condition: "order_id = " . $this->orderId);
               $orders = [];
               foreach ($result as $row) {
                    $order = (object) $row;
                    $orders[] = $order;
               }
               return $orders;
          } catch (Exception $e) {
               return $e->getMessage()." OrdersModel, getOrdersId exception";
          }
     }

}
