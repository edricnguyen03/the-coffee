<?php
class Cart extends Controller{
     public $cartModel;
     public $data;

     public function __construct(){
          $this->cartModel = $this->model('CartModel');
          $this->data = [];
     }

     
}
?>