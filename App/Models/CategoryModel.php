<?php
class CategoryModel
{
    function __construct()
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

    public function getCategoryById($categoryId)
    {
        global $db;
        $category = $db->get('categories', '*', 'id = ' . $categoryId);
        return $category;
    }

    public function getAllCategories()
    {
        global $db;
        $categories = $db->get('categories');
        return $categories;
    }
    public function getMaxId()
    {
        global $db;
        $query = $db->query("SELECT MAX(id) as max_id FROM categories");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['max_id'];
    }
    public function insertCategory($data)
    {
        global $db;
        $db->insert('categories', $data);
        return true;
    }

    public function updateCategory($categoryId, $newData)
    {
        global $db;
        $db->update('categories', $newData, 'id = ' . $categoryId);
        return true;
    }

    public function deleteCategory($categoryId)
    {
        global $db;
        $db->delete('categories', 'id = ' . $categoryId);
        return true;
    }
    public function setCategoryStatus($categoryId, $status)
    {
        global $db;
        $result = $db->update("categories", ["status" => $status], "id = $categoryId");
        return $result;
    }
}
