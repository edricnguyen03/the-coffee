<?php
class OrderProductsModel
{
     public function __construct()
     {
     }
     public function getOrderProducts($orderId = -1)
     {
          global $db;
          try {
               $result = $db->get(table: "order_products", condition: "order_id = " . $orderId);
               $order_product = [];
               foreach ($result as $row) {
                    $order_product[] = (object) $row;
               }
               return $order_product;
          } catch (Exception $e) {
               echo $e->getMessage() . "OrdersProducts getOrderProducts exception";
          }
     }
     public function getOrder_OrderProduct($id)
     {
          global $db;
          try {
               $result = $db->get(table: "order_products,orders,products", condition: "order_products.order_id = orders.id AND order_products.product_id = products.id AND order_id = " . $id);
               $order_product = [];
               foreach ($result as $row) {
                    $order_product[] = (object) $row;
               }
               return $order_product;
          } catch (Exception $e) {
               echo $e->getMessage() . "OrdersProducts getOrderProducts exception";
          }
     }

     public function getMaxId()
     {
          global $db;
          $query = $db->query("SELECT MAX(id) as max_id FROM order_products");
          $query->execute();
          $result = $query->fetch(PDO::FETCH_ASSOC);
          return $result['max_id'];
     }

     public function insertOrderProduct($data)
     {
          global $db;
          $db->insert('order_products', $data);
          return true;
     }
     public function checkProductInOrder($productId)
     {
          global $db;
          $query = $db->query("SELECT * FROM order_products WHERE product_id = $productId");
          $query->execute();
          $result = $query->fetch(PDO::FETCH_ASSOC);
          return $result ? true : false;
     }
}
