<?php
class StatModel
{
    public function getIncomeCategories($fromDate, $toDate)
    {
        global $db;
        $query = $db->query("SELECT SUM(orders.total) as total, SUM(order_products.qty) AS qty, categories.name
                            FROM orders
                            JOIN order_products ON orders.id = order_products.order_id
                            JOIN products ON products.id = order_products.product_id
                            JOIN categories ON categories.id = products.category_id
                            WHERE DATE(orders.create_at) BETWEEN '$fromDate' AND '$toDate'
                            GROUP BY categories.id");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
}
