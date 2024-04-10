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
}
