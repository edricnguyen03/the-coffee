<?php
class Product extends Controller
{
    public $productModel;
    public $data;

    public function __construct()
    {
        $this->productModel = $this->model('ProductModel');
        $this->data = [];
    }

    public function index(){
        $sanPhams = $this->productModel->get();
        $data['sanPhams'] = $sanPhams;
        $this->view('/Client/Product', $data);
    }
    public function detail($id = 1){
        $sanPham = $this->productModel->getById($id);
        $data['sanPham'] = $sanPham;
        $this->view('/Client/pages/product-detail',$data);
    }
}
