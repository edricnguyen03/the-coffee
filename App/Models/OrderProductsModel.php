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

     public function addOrderProduct($orderId, $product, $quantity)
     {
          global $db;
          try {
               $data = [
                    'order_id' => $orderId,
                    'product_id' => $product->product_id,
                    'qty' => $quantity
               ];
               $db->insert(table: 'order_products', data: $data);
               return true;
          } catch (Exception $e) {
               echo $e->getMessage() . "OrdersProducts addOrderProduct exception";
               return false;
          }
     }
}
