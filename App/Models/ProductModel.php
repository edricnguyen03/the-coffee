<?php
class ProductModel
{

    public $numberOfProductsInOnePage = 4; // số sản phẩm trên 1 trang
    public function __construct()
    {
    }
    public function getById($id)
    {
        global $db;
        $result = $db->get("products", "*", "id = $id");
        $row = $result[0];
        $sanPham = (object) $row;
        if (!isset($sanPham->thumb_image) || !file_exists("./resources/images/products/" . $sanPham->thumb_image)) {
            $sanPham->thumb_image = "product-default.png";
        }
        return $sanPham;
    }

    public function getNumberOfPages($idDanhMuc = "all", $minMucGia = 0, $maxMucGia = -1, $noiDung = "")
    { // hàm đếm số trang

        $condition = "status = 1 ";

        // Nếu $idDanhMuc không phải là "all", thêm điều kiện lọc theo category_id
        if ($idDanhMuc != "all") {
            $condition .= " AND category_id = $idDanhMuc";
        }
        // Nếu $noiDung được cung cấp, thêm điều kiện lọc theo tên sản phẩm
        if ($noiDung != "") {
            $condition .= " AND name LIKE '%$noiDung%'";
        }
        // Nếu $minMucGia không phải là 0, thêm điều kiện lọc giá nhỏ hơn hoặc bằng $minMucGia
        if ($minMucGia != 0) {
            $condition .= " AND price >= $minMucGia";
        }
        // Nếu $maxMucGia không phải là -1, thêm điều kiện lọc giá lớn hơn hoặc bằng $maxMucGia
        if ($maxMucGia != -1) {
            $condition .= " AND price <= $maxMucGia";
        }
        //Lấy hết sản phẩm lên xong .size() để lấy số lượng sản phẩm---------------------------------------
        global $db;
        $Products = $db->get("products", "*", $condition);
        $numberOfProduct = count($Products);

        // Hàm lấy số lượng tất cả sản phẩm
        if ($numberOfProduct % $this->numberOfProductsInOnePage == 0) {
            return $numberOfProduct / $this->numberOfProductsInOnePage;
        } else {
            return floor($numberOfProduct / $this->numberOfProductsInOnePage) + 1;
        }
    }

    public function get($page = 1, $idDanhMuc = "all", $minMucGia = 0, $maxMucGia = -1, $noiDung = "")
    {
        $offset = ($page - 1) * $this->numberOfProductsInOnePage;
        // Bắt đầu chuỗi SQL với điều kiện cơ bản
        $condition = "status = 1 ";

        // Nếu $idDanhMuc không phải là "all", thêm điều kiện lọc theo category_id
        if ($idDanhMuc != "all") {
            $condition .= " AND category_id = $idDanhMuc";
        }

        // Nếu $noiDung được cung cấp, thêm điều kiện lọc theo tên sản phẩm
        if ($noiDung != "") {
            $condition .= " AND name LIKE '%$noiDung%'";
        }

        // Nếu $minMucGia không phải là 0, thêm điều kiện lọc giá nhỏ hơn hoặc bằng $minMucGia
        if ($minMucGia != 0) {
            $condition .= " AND price >= $minMucGia";
        }

        // Nếu $maxMucGia không phải là -1, thêm điều kiện lọc giá lớn hơn hoặc bằng $maxMucGia
        if ($maxMucGia != -1) {
            $condition .= " AND price <= $maxMucGia";
        }

        $condition .= " LIMIT $this->numberOfProductsInOnePage OFFSET $offset";
        //chổ này code chạy sql lấy ds sản phẩm----------------------------------------------
        global $db;
        $result = $db->get("products", "*", $condition);

        $sanPhams = [];
        foreach ($result as $row) {
            $sanPham = (object) $row;

            if (!isset($sanPham->thumb_image) || !file_exists("./resources/images/products/" . $sanPham->thumb_image)) {
                $sanPham->thumb_image = "product-default.png";
            }

            $sanPhams[] = $sanPham;            
        }
        return $sanPhams;
    }
}
