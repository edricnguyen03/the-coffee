<?php
     class Home extends Controller{
          public $productModel;
          public $data;
          public function __construct(){
               $this->productModel = $this->model('ProductModel');
               $this->data = [];
          }
          public function index(){
               $sanPhams = $this->productModel->get();
               $data['sanPhams'] = $sanPhams;
               $this->view('/Client/Home',$data);
          }
     }
?>