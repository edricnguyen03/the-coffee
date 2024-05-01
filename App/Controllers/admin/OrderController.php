<?php
class OrderController extends Controller
{

    public $data;
    public $orderModel;
    public $ordersProducts;

    public $productModel;

    public function __construct()
    {
        $this->data = [];
        $this->orderModel = $this->model('OrdersModel');
        $this->ordersProducts = $this->model('OrdersProducts');
        $this->productModel = $this->model('ProductModel');
    }

    // Function to show user data from the database
    public function index()
    {
        // $this->data['orders'] = $this->orderModel->getAllOrders();
        $this->view('/Admin/pages/orders/index',);
    }

    // Function to create a new user in the database
    public function create()
    {
    }


    public function store()
    {
        //
    }

    // Function to edit an existing user in the database
    public function edit($orderId)
    {
        // echo $orderId;
        $oderProducts = $this->ordersProducts->getOrderProducts2($orderId);
        $this->orderModel->setOrderId($orderId);
        $order = $this->orderModel->getOrdersById();
        //echo '<pre>';
        // print_r($oderProducts);
        // echo '<pre>'; ;

        // $nameOfProduct = array_map(function ($row) {
        //     return $row['product_name'];
        // }, $oderProducts);

        // $price = array_map(function ($row) {
        //     return $row['product_price'];
        // }, $oderProducts);

        // $quantity = array_map(function ($row) {
        //     return $row['qty'];
        // }, $oderProducts);
        // echo '<pre>';
        // print_r($nameOfProduct);
        // echo '<pre>'; ;

        // foreach($nameOfProduct as $key => $value){
        //     $this->data['name'.$key] = $value;
        // }
        // foreach($price as $key => $value){
        //     $this->data['price'.$key] = $value;
        // }
        // foreach($quantity as $key => $value){
        //     $this->data['qty'.$key] = $value;
        // }
        // echo '<pre>';
        // print_r($this->data);
        // echo '<pre>'; ;

        foreach ($oderProducts as &$orderProduct) {
            $orderProduct['thumb_image'] = $this->productModel->getById($orderProduct['product_id'])->thumb_image;
        }

        $this->data['orderProducts'] = $oderProducts;
        $this->data['order'] = $order;
        $this->view('/Admin/pages/orders/detail', $this->data);
        // Redirect to the index page or show a success message
    }
    public function delete($userId)
    {
        // Your code to delete the user from the database based on $userId
    }

    public function alert()
    {
        $this->view('/alert',);
    }
}
