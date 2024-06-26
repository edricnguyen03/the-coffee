<?php
class ProductModel
{

    public $numberOfProductsInOnePage = 4; // số sản phẩm trên 1 trang
    public function __construct()
    {
    }

    function getAllProductsName()
    {
        global $db;
        $products = $db->get('products', 'name');
        return $products;
    }

    public function getById($id)
    {
        global $db;
        $result = $db->get("products", "*", "id = $id AND status = 1");
        $row = $result[0];
        $sanPham = (object) $row;
        if (!isset($sanPham->thumb_image) || !file_exists("./resources/images/products/" . $sanPham->thumb_image)) {
            $sanPham->thumb_image = "noimage.jpg";
        }
        return $sanPham;
    }


    // public function getStockByProductId($id)
    // {
    //     global $db;
    //     $result = $db->get("products", "stock", "id = $id");
    //     $row = $result[0];
    //     $sanPham = (object) $row;
    //     if (!isset($sanPham->thumb_image) || !file_exists("./resources/images/products/" . $sanPham->thumb_image)) {
    //         $sanPham->thumb_image = "noimage.jpg";
    //     }
    //     return $sanPham;
    // }

    public function getStockByProductId($id)
    {
        global $db;
        $result = $db->get("products", "stock", "id = $id");
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

    public function get($page = 1, $idDanhMuc = "all", $minMucGia = 0, $maxMucGia = -1, $sortOption = "", $noiDung = "")
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

        // Nếu $sortOption được cung cấp, sắp xếp sản phẩm theo $sortOption
        if ($sortOption != "") {
            $condition .= " ORDER BY " . $sortOption;
        }

        $condition .= " LIMIT $this->numberOfProductsInOnePage OFFSET $offset";


        //chổ này code chạy sql lấy ds sản phẩm----------------------------------------------
        global $db;
        $result = $db->get("products", "*", $condition);

        $sanPhams = [];
        foreach ($result as $row) {
            $sanPham = (object) $row;

            if (!isset($sanPham->thumb_image) || !file_exists("./resources/images/products/" . $sanPham->thumb_image)) {
                $sanPham->thumb_image = "noimage.jpg";
            }

            $sanPhams[] = $sanPham;
        }
        return $sanPhams;
    }



    public function getAllProducts()
    {
        global $db;
        $result = $db->get("products", "*");
        $sanPhams = [];
        foreach ($result as $row) {
            $sanPham = (object) $row;
            if (!isset($sanPham->thumb_image) || !file_exists("./resources/images/products/" . $sanPham->thumb_image)) {
                $sanPham->thumb_image = "noimage.jpg";
            }
            $sanPhams[] = $sanPham;
        }
        return $sanPhams;
    }

    public function getMaxId()
    {
        global $db;
        $result = $db->get("products", "MAX(id) as maxId");
        return $result[0]['maxId'];
    }

    public function insertProduct($data)
    {
        global $db;
        return $db->insert("products", $data);
    }

    public function getProductById($productId)
    {
        global $db;
        $result = $db->get("products", "*", "id = $productId ");
        $row = $result[0];
        $sanPham = (object) $row;
        if (!isset($sanPham->thumb_image) || !file_exists("./resources/images/products/" . $sanPham->thumb_image)) {
            $sanPham->thumb_image = "noimage.jpg";
        }
        return $sanPham;
    }

    public function updateProduct($productId, $data)
    {
        global $db;
        return $db->update("products", $data, "id = $productId");
    }

    public function deleteProduct($productId)
    {
        global $db;
        return $db->delete("products", "id = $productId");
    }

    public function search($search)
    {
        global $db;
        $result = $db->get("products", "*", "name LIKE '%$search%'");
        $sanPhams = [];
        foreach ($result as $row) {
            $sanPham = (object) $row;
            if (!isset($sanPham->thumb_image) || !file_exists("./resources/images/products/" . $sanPham->thumb_image)) {
                $sanPham->thumb_image = "noimage.jpg";
            }
            $sanPhams[] = $sanPham;
        }
        return $sanPhams;
    }

    // thêm hàm cập nhật số lượng sản phẩm trong kho
    public function changeStock($id, $quantity)
    {
        global $db;
        $product = $db->get("products", "*", "id = $id")[0];
        $stock = $product['stock'];
        $stock -= $quantity;
        $result = $db->update("products", ["stock" => $stock], "id = $id");
        return $result;
    }

    public function addStock($id, $quantity)
    {
        global $db;
        $product = $db->get("products", "*", "id = $id")[0];
        $stock = $product['stock'];
        $stock += $quantity;
        $result = $db->update("products", ["stock" => $stock], "id = $id");
        return $result;
    }
    public function setProductStatus($id, $status)
    {
        global $db;
        return $db->update("products", ["status" => $status], "id = $id");
    }

    public function checkProductNameExists($name)
    {
        global $db;
        $result = $db->get("products", "*", "name = '$name'");
        if (count($result) > 0) {
            return true;
        }
        return false;
    }
    public function checkCategoryInProduct($categoryId)
    {
        global $db;
        $query = $db->query("SELECT * FROM products WHERE category_id = $categoryId");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result ? true : false;
    }
}
