<?php
     class Home extends Controller{
          public $productModel;

          public function __construct(){
               $this->productModel = $this->model('ProductModel');
          }
          public function index(){
               $sanPhams = $this->productModel->get();
               $this->view('/Client/Home',$sanPhams);
          }
     }
?>