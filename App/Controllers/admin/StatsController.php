<?php

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
        $this->view('/Admin/pages/stats/index',);
    }

    public function income()
    {
        $this->view('/Admin/pages/stats/income');
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
