<?php
class OrdersModel
{
     private $userId;
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
     public function setUserId($userId)
     {
          $this->userId = $userId;
     }
     public function getOrdersId()
     {
          try {
               global $db;
               $result = $db->get(table: "orders", condition: "user_id = " . $this->userId);
               $orders = [];
               foreach ($result as $row) {
                    $order = (object) $row;
                    $orders[] = $order;
               }
               return $orders;
          } catch (Exception $e) {
               return $e->getMessage() . " OrdersModel, getOrdersId exception";
          }
     }

     public function getOrdersById()
     {
          try {
               global $db;
               $result = $db->get(table: "orders", condition: "id = " . $this->orderId);
               $order = (object) $result[0];
               return $order;
          } catch (Exception $e) {
               return $e->getMessage() . " OrdersModel, getOrdersById exception";
          }
     }

     public function getOrder($id)
     {
          try {
               global $db;
               $result = $db->get(table: "orders", condition: "id = " . $id);
               $order = (object) $result[0];
               return $order;
          } catch (Exception $e) {
               echo $e->getMessage() . " OrdersModel, getOrder exception";
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
     public function checkUserInOrder($userId)
     {
          global $db;
          $query = $db->query("SELECT * FROM orders WHERE user_id = $userId");
          $query->execute();
          $result = $query->fetch(PDO::FETCH_ASSOC);
          return $result ? true : false;
     }
}
