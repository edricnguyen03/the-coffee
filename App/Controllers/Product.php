<?php
require_once './App/Models/Auth.php';
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
        $danhMucs = $this->categoryModel->getAllCategoryExist();
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

    public function addToCart($productID, $soLuongMua = 1)
    {
        //Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['login']['status'])) {
            echo "login";
            return;
        }

        $User_id = $_SESSION['login']['id'];

        if(Auth::hasAdminPermission($User_id)){
            echo '<script> alert("Admin không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }

        // Gọi hàm addToCart từ model và xử lý kết quả
        $result = $this->cartModel->addToCart($User_id, $productID, $soLuongMua);
        echo $result;
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
        if(isset($_POST['sortOption'])){
            $sortOption = $_POST['sortOption'];
        }else{
            $sortOption = "";
        }

        $sanPhams = $this->productModel->get($page, $idDanhMuc, $minMucGia, $maxMucGia,$sortOption, $noiDung);
        $data['sanPhams'] = $sanPhams;

        return  $this->view('/Client/pages/product-list', $data);
    }
}
