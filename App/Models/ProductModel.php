<?php
class ProductModel
{   
    public $numberOfProductsInOnePage = 8; // số sản phẩm trên 1 trang

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

    public function getNumberOfPages($idDanhMuc = "all", $minMucGia = 0, $maxMucGia = -1, $noiDung = ""){ // hàm đếm số trang

        $sql = "SELECT * FROM products WHERE 1";
    
        // Nếu $idDanhMuc không phải là "all", thêm điều kiện lọc theo category_id
        if ($idDanhMuc != "all") {
            $sql .= " AND category_id = $idDanhMuc";
        }
        // Nếu $noiDung được cung cấp, thêm điều kiện lọc theo tên sản phẩm
        if ($noiDung != "") {
            $sql .= " AND name LIKE '%$noiDung%'";
        }
        // Nếu $minMucGia không phải là 0, thêm điều kiện lọc giá nhỏ hơn hoặc bằng $minMucGia
        if ($minMucGia != 0) {
            $sql .= " AND price >= $minMucGia";
        }
        // Nếu $maxMucGia không phải là -1, thêm điều kiện lọc giá lớn hơn hoặc bằng $maxMucGia
        if ($maxMucGia != -1) {
            $sql .= " AND price <= $maxMucGia";
        }
        //Lấy hết sản phẩm lên xong .size() để lấy số lượng sản phẩm---------------------------------------


        $numberOfProduct = 24;
        if($noiDung !=""){
            $numberOfProduct = 44;
        }
        
        // Hàm lấy số lượng tất cả sản phẩm
        if($numberOfProduct%$this->numberOfProductsInOnePage == 0){
            return $numberOfProduct/$this->numberOfProductsInOnePage;
        }
        else{
            return floor($numberOfProduct / $this->numberOfProductsInOnePage) + 1;
        }
        
    }

    public function get($page = 1, $idDanhMuc = "all", $minMucGia = 0, $maxMucGia = -1, $noiDung = "")
    {   
        $offset = ($page - 1) * $this->numberOfProductsInOnePage;
        // Bắt đầu chuỗi SQL với điều kiện cơ bản
        $sql = "SELECT * FROM products WHERE 1";
    
        // Nếu $idDanhMuc không phải là "all", thêm điều kiện lọc theo category_id
        if ($idDanhMuc != "all") {
            $sql .= " AND category_id = $idDanhMuc";
        }
    
        // Nếu $noiDung được cung cấp, thêm điều kiện lọc theo tên sản phẩm
        if ($noiDung != "") {
            $sql .= " AND name LIKE '%$noiDung%'";
        }
    
        // Nếu $minMucGia không phải là 0, thêm điều kiện lọc giá nhỏ hơn hoặc bằng $minMucGia
        if ($minMucGia != 0) {
            $sql .= " AND price >= $minMucGia";
        }
    
        // Nếu $maxMucGia không phải là -1, thêm điều kiện lọc giá lớn hơn hoặc bằng $maxMucGia
        if ($maxMucGia != -1) {
            $sql .= " AND price <= $maxMucGia";
        }

        $sql .= " LIMIT $this->numberOfProductsInOnePage OFFSET $offset";
        //chổ này code chạy sql lấy ds sản phẩm----------------------------------------------

        $sanPhams = []; // hoặc có thể sử dụng cú pháp: $sanPhams = [];
        $sanPham = new stdClass();
        $sanPham->id = 1;
        $sanPham->name = 'Coffee Product tìm kiếm 1.'.$page;
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
        $sanPham2->name = 'Coffee Product tìm kiếm 2. '.$page;
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
        $sanPham3->name = 'Coffee Product tìm kiếm 3. '.$page;
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

        $sanPham3 = new stdClass();
        $sanPham3->id = 4;
        $sanPham3->name = 'Coffee Product tìm kiếm 4. '.$page;
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

        $sanPham3 = new stdClass();
        $sanPham3->id = 5;
        $sanPham3->name = 'Coffee Product tìm kiếm 5. '.$page;
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

        $sanPham3 = new stdClass();
        $sanPham3->id = 6;
        $sanPham3->name = 'Coffee Product tìm kiếm 6. '.$page;
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

}
