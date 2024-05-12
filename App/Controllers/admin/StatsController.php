<?php

class StatsController extends Controller
{
    public $data;
    public $orderModel;
    public $orderProductModel;
    public $productModel;

    public function __construct()
    {
        $this->data = [];
        $this->orderModel = $this->model('OrdersModel');
        $this->orderProductModel = $this->model('OrderProductsModel');
        $this->productModel = $this->model('ProductModel');
    }

    public function index()
    {

        $this->view('/Admin/pages/stats/index',);
    }
}
