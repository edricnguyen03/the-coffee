<?php
class CategoryModel
{
    public function __construct()
    {
    }


    function get()
    {
        global $db;
        $result = $db->get('categories');
        $categories = [];
        foreach ($result as $row) {
            $category = (object) $row;
            $categories[] = $category;
        }

        return $categories;
    }

    function getCategoryById($categoryId)
    {
        global $db;
        $result = $db->get('categories', '*', "id = $categoryId");
        $category = [];
        foreach ($result as $row) {
            $category = (object) $row;
        }

        return $category;
    }

    // function getCategoryByProductId($productId)
    // {
    //     global $db;
    //     $result = $db->query("SELECT c.* FROM categories c INNER JOIN products p ON c.id = p.category_id WHERE p.id = $productId");
    //     $category = [];
    //     foreach ($result as $row) {
    //         $category = (object) $row;
    //     }

    //     return $category;
    // }

    function insertCategory($data)
    {
        global $db;
        return $db->insert('categories', $data);
    }

    function updateCategory($categoryId, $data)
    {
        global $db;
        return $db->update('categories', $data, "id = $categoryId");
    }

    function deleteCategory($categoryId)
    {
        global $db;
        return $db->delete('categories', "id = $categoryId");
    }
}
