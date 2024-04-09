<?php
class CategoryModel
{
    public function __construct()
    {
    }


    function get()
    {
        $categories = array();

        // Tạo và thêm các đối tượng vào mảng
        $category = new stdClass();
        $category->id = 1;
        $category->name = 'Starbucks';
        $category->slug = 'Starbucks';
        $category->icon = 'icon-1.png';
        $category->status = 1;
        $categories[] = $category;

        $category = new stdClass();
        $category->id = 2;
        $category->name = 'Costa Coffee';
        $category->slug = 'Costa-Coffee';
        $category->icon = 'icon-1.png';
        $category->status = 1;
        $categories[] = $category;

        $category = new stdClass();
        $category->id = 3;
        $category->name = 'Dunkin Donuts';
        $category->slug = 'Dunkin-Donuts';
        $category->icon = 'icon-1.png';
        $category->status = 1;
        $categories[] = $category;

        $category = new stdClass();
        $category->id = 4;
        $category->name = 'Tim Hortons';
        $category->slug = 'Tim-Hortons';
        $category->icon = 'icon-1.png';
        $category->status = 1;
        $categories[] = $category;

        $category = new stdClass();
        $category->id = 5;
        $category->name = 'Nespresso';
        $category->slug = 'Nespresso';
        $category->icon = 'icon-1.png';
        $category->status = 1;
        $categories[] = $category;


        return $categories;
    }
}
