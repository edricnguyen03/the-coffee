<?php
class ProductModel
{   
    public $numberOfProductsInOnePage = 8; // số sản phẩm trên 1 trang
    public function get($page=1)
    {
        $sanPhams = []; // hoặc có thể sử dụng cú pháp: $sanPhams = [];
        $sanPham = new stdClass();
        $sanPham->id = 1;
        $sanPham->name = 'Coffee Product 1.'.$page;
        $sanPham->slug = 'Từ nơi đồng xanh thơm hương lúa';
        $sanPham->thumb_image = 'product-default.png';
        $sanPham->category_id = 1;
        $sanPham->description = 'abcdnnnnnn';
        $sanPham->content = 'abcdnnnnnn';
        $sanPham->weight = 100;
        $sanPham->price = 10000;
        $sanPham->status = 1;
        $sanPham->stock = 30;
        $sanPhams[] = $sanPham;

        $sanPham2 = new stdClass();
        $sanPham2->id = 2;
        $sanPham2->name = 'Coffee Product 2. '.$page;
        $sanPham2->slug = 'Từ nơi đồng xanh thơm hương lúa';
        $sanPham2->thumb_image = 'product-default.png';
        $sanPham2->category_id = 1;
        $sanPham2->description = 'abcdnnnnnn';
        $sanPham2->content = 'abcdnnnnnn';
        $sanPham2->weight = 100;
        $sanPham2->price = 10000;
        $sanPham2->status = 1;
        $sanPham2->stock = 30;
        $sanPhams[] = $sanPham2;

        $sanPham3 = new stdClass();
        $sanPham3->id = 3;
        $sanPham3->name = 'Coffee Product 3. '.$page;
        $sanPham3->slug = 'Từ nơi đồng xanh thơm hương lúa';
        $sanPham3->thumb_image = 'product-default.png';
        $sanPham3->category_id = 1;
        $sanPham3->description = 'abcdnnnnnn';
        $sanPham3->content = 'abcdnnnnnn';
        $sanPham3->weight = 100;
        $sanPham3->price = 10000;
        $sanPham3->status = 1;
        $sanPham3->stock = 30;
        $sanPhams[] = $sanPham3;


        return $sanPhams;
    }

    public function getById($id){
        $sanPham = new stdClass();
        $sanPham->id = 1;
        $sanPham->name = 'Coffee Product '.$id;
        $sanPham->slug = 'Từ nơi đồng xanh thơm hương lúa';
        $sanPham->thumb_image = 'product-default.png';
        $sanPham->category_id = 1;
        $sanPham->description = 'abcdnnnnnn';
        $sanPham->content = 'abcdnnnnnn';
        $sanPham->weight = 100;
        $sanPham->price = 10000;
        $sanPham->status = 1;
        $sanPham->stock = 30;
        return $sanPham;
    }

    public function getNumberOfPages(){ // hàm đếm số trang
        $numberOfProduct = 24;
        // Hàm lấy số lượng tất cả sản phẩm
        if($numberOfProduct%$this->numberOfProductsInOnePage == 0){
            return $numberOfProduct/$this->numberOfProductsInOnePage;
        }
        else{
            return floor($numberOfProduct / $this->numberOfProductsInOnePage) + 1;
        }
        
    }

}
