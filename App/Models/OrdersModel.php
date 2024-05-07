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
               $result = $db->get("orders", "*", "id = $this->orderId");
               $row = $result[0];
               $order = (object) $row;
               return $order;
          } catch (Exception $e) {
               return $e->getMessage() . " OrdersModel, getOrdersId exception";
          }
     }

     public function updateStatus($status)
     {
          try {
               global $db;
               $result = $db->update("orders", ["order_status" => $status], "id = $this->orderId");
               return $result;
          } catch (Exception $e) {
               return $e->getMessage() . " OrdersModel, updateStatus exception";
          }
     }
}
