<?php
class StatModel
{
    //ham lay du lieu thong ke san pham ban chay
    public function getTopProducts($fromDate, $toDate)
    {
        global $db;

        $query = $db->query("SELECT p.name, SUM(op.qty) AS quantity_sold
                                FROM orders o
                                JOIN order_products op ON o.id = op.order_id
                                JOIN products p ON op.product_id = p.id
                                WHERE o.create_at BETWEEN '$fromDate' AND '$toDate'
                                GROUP BY p.name 
                                ORDER BY `quantity_sold` DESC
                                LIMIT 5");

        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

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
