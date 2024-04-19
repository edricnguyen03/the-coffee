<?php
class Home extends Controller
{
     public $productModel;
     public $data;
     public function __construct()
     {
          $this->productModel = $this->model('ProductModel');
          $this->data = [];
     }
     public function index($page = 1)
     {
          $sanPhams = $this->productModel->get($page);
          $data['sanPhams'] = $sanPhams;
          $this->view('/Client/Home', $data);
     }

     public function page($page = 1)
     {
          $sanPhams = $this->productModel->get($page);
          $data['sanPhams'] = $sanPhams;
          $this->view('/Client/pages/product-list', $data);
     }

     public function getNumberOfPages()
     {
          $numberOfPages = $this->productModel->getNumberOfPages();
          // Trả về dữ liệu dưới dạng JSON
          header('Content-Type: application/json');
          echo json_encode($numberOfPages);
          exit;
     }
}
