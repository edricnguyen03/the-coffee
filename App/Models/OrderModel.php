<?php
class OrdersModel
{
     private $userId;
     function __construct()
     {
     }
     public function setUserId($userId)
     {
          $this->userId = $userId;
     }
     public function getOrdersById()
     {
          try {
               global $db;
               $result = $db->get(table: "orders", fields : "id",condition: "user_id = " . $this->userId);
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
