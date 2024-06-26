<?php
include_once './App/Models/Auth.php';

class StatsController extends Controller
{
    public $data;
    public $orderModel;
    public $orderProductModel;
    public $productModel;

    public $statModel;


    public function __construct()
    {
        $this->data = [];
        $this->orderModel = $this->model('OrdersModel');
        $this->orderProductModel = $this->model('OrderProductsModel');
        $this->productModel = $this->model('ProductModel');
        $this->statModel = $this->model('StatModel');
    }

    public function index()
    {
        if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
            // If not, display an alert message and redirect them to the login page
            // header('Location: alert');
            header('Location: /the-coffee/Login_Regis/logout');
            exit;
        }
        if (Auth::checkPermission($_SESSION['login']['id'], Auth::$permissionDashboard) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        $this->view('/Admin/pages/stats/index',);
    }

    public function income()
    {
        if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
            // If not, display an alert message and redirect them to the login page
            // header('Location: alert');
            header('Location: /the-coffee/Login_Regis/logout');
            exit;
        }
        if (Auth::checkPermission($_SESSION['login']['id'], Auth::$permissionDashboard) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        $this->view('/Admin/pages/stats/income');
    }

    // ham lay du lieu thong ke san pham ban chay
    public function getTopProducts()
    {
        if (!isset($_POST['from']) || !isset($_POST['to'])) {
            echo '';
        }
        $fromDate = $_POST['from'];
        $toDate = $_POST['to'];
        $data = $this->statModel->getTopProducts($fromDate, $toDate);
        echo json_encode($data);
    }

    public function getIncomeCategories()
    {
        if (!isset($_POST['fromDate']) || !isset($_POST['toDate'])) {
            echo '';
        }
        $fromDate = $_POST['fromDate'];
        $toDate = $_POST['toDate'];
        $data = $this->statModel->getIncomeCategories($fromDate, $toDate);
        echo json_encode($data);
    }
}
