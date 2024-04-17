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
     public function getOrdersId()
     {
          try {
               global $db;
               $result = $db->get(table: "orders",condition: "user_id = " . $this->userId);
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
     public function getOrder($id){
          try{
               global $db;
               $result = $db->get(table: "orders",condition: "id = " . $id);
               $order = (object) $result[0];
               return $order;
          }catch(Exception $e){
               echo $e->getMessage()." OrdersModel, getOrder exception";
          }
     }

}
