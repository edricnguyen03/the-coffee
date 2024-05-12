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
               $result = $db->get("orders",  "*", "id = $this->orderId");
               $row = $result[0];
               $order = (object) $row;
               return $order;
          } catch (Exception $e) {
               return $e->getMessage() . " OrdersModel, getOrdersId exception";
          }
     }
     public function getOrder($id)
     {
          try {

     public function updateStatus($status)
     {
          try {
               global $db;
               $result = $db->get(table: "orders", condition: "id = " . $id);
               $order = (object) $result[0];
               return $order;
          } catch (Exception $e) {
               echo $e->getMessage() . " OrdersModel, getOrder exception";
               $result = $db->update("orders", ["order_status" => $status], "id = $this->orderId");
               return $result;
          } catch (Exception $e) {
               return $e->getMessage() . " OrdersModel, updateStatus exception";
          }
     }

     public function getMaxId()
     {
          global $db;
          $query = $db->query("SELECT MAX(id) as max_id FROM orders");
          $query->execute();
          $result = $query->fetch(PDO::FETCH_ASSOC);
          return $result['max_id'];
     }

     public function insertOrder($data)
     {
          global $db;
          $db->insert('orders', $data);
          return true;
     }
}
