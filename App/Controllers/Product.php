<?php
class Product extends Controller
{
    public $productModel;
    public $categoryModel;

    public $cartModel;
    public $data;

    public function __construct()
    {
        $this->productModel = $this->model('ProductModel');
        $this->categoryModel = $this->model('CategoryModel');
        $this->cartModel = $this->model('CartModel');
        $this->data = [];
    }

    public function index()
    {
        $sanPhams = $this->productModel->get();
        $danhMucs = $this->categoryModel->get();
        $data['sanPhams'] = $sanPhams;
        $data['danhMucs'] = $danhMucs;
        $this->view('/Client/Product', $data);
    }
    public function detail($id = 1)
    {
        $sanPham = $this->productModel->getById($id);
        $data['sanPham'] = $sanPham;
        $this->view('/Client/pages/product-detail', $data);
    }

    public function addToCart($productID, $soLuongMua = 1){
        //Kiểm tra xem người dùng đã đăng nhập chưa
        if(!isset($_SESSION['login']['status'])){
            echo "login";
            return;
        }
        
        //$User_id = isset($_SESSION['login']['id']);--------------------
        // Gọi hàm addToCart từ model và xử lý kết quả
        $User_id = 1;
        $result = $this->cartModel->addToCart($User_id, $productID, $soLuongMua);
        
        if($result){
            echo "success";
        } else {
            echo "fail";
        }
    
    }

    public function GetNumberOfPages()
    {
        if (isset($_POST['idDanhMuc'])) {
            $idDanhMuc = $_POST['idDanhMuc'];
        } else {
            $idDanhMuc = "all";
        }
        if (isset($_POST['minMucGia'])) {
            $minMucGia = $_POST['minMucGia'];
        } else {
            $minMucGia = 0;
        }
        if (isset($_POST['maxMucGia'])) {
            $maxMucGia = $_POST['maxMucGia'];
        } else {
            $maxMucGia = -1;
        }
        if (isset($_POST['noiDung'])) {
            $noiDung = $_POST['noiDung'];
        } else {
            $noiDung = "";
        }
        $numberOfPages = $this->productModel->getNumberOfPages($idDanhMuc, $minMucGia, $maxMucGia, $noiDung);
        header('Content-Type: application/json');
        echo json_encode($numberOfPages);
        exit;
    }

    public function filter()
    {
        if (isset($_POST['page'])) {
            $page = $_POST['page'];
        } else {
            $page = 1;
        }
        if (isset($_POST['idDanhMuc'])) {
            $idDanhMuc = $_POST['idDanhMuc'];
        } else {
            $idDanhMuc = "all";
        }
        if (isset($_POST['minMucGia'])) {
            $minMucGia = $_POST['minMucGia'];
        } else {
            $minMucGia = 0;
        }
        if (isset($_POST['maxMucGia'])) {
            $maxMucGia = $_POST['maxMucGia'];
        } else {
            $maxMucGia = -1;
        }
        if (isset($_POST['noiDung'])) {
            $noiDung = $_POST['noiDung'];
        } else {
            $noiDung = "";
        }

        $sanPhams = $this->productModel->get($page, $idDanhMuc, $minMucGia, $maxMucGia, $noiDung);
        $data['sanPhams'] = $sanPhams;
        return  $this->view('/Client/pages/product-list', $data);
    }
}
