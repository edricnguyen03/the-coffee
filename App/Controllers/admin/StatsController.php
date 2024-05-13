<?php

class StatsController extends Controller
{
    public $data;
    public $orderModel;
    public $orderProductModel;
    public $productModel;

    public $statModel;

    public $userModel;

    public function __construct()
    {
        $this->data = [];
        $this->orderModel = $this->model('OrdersModel');
        $this->orderProductModel = $this->model('OrderProductsModel');
        $this->productModel = $this->model('ProductModel');
        $this->statModel = $this->model('StatModel');
        $this->userModel = $this->model('UserModel');
    }

    public function index()
    {   
        if($this->userModel->checkPermission($_SESSION['login']['id'], 6) == false){
            echo "<script>alert('Bạn không có quyền truy cập vào trang này','danger','/the-coffee/admin')</script>";
            require_once './App/errors/404.php';
            return;
        }

        $this->view('/Admin/pages/stats/index',);
    }

    public function income()
    {
        if($this->userModel->checkPermission($_SESSION['login']['id'], 6) == false){
            echo "<script>alert('Bạn không có quyền truy cập vào trang này','danger','/the-coffee/admin')</script>";
            require_once './App/errors/404.php';
            return;
        }
        $this->data['userModel'] = $this->userModel;
        $this->view('/Admin/pages/stats/income', $this->data);
    }

    public function getIncomeCategories()
    {
        if(!isset($_POST['fromDate']) || !isset($_POST['toDate'])){
            echo '';
        }
        $fromDate = $_POST['fromDate'];
        $toDate = $_POST['toDate'];
        $data = $this->statModel->getIncomeCategories($fromDate, $toDate);
        echo json_encode($data);
    }
}
