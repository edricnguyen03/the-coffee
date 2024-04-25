<?php
class OrderController extends Controller {

    public $data;
    public $orderModel;

    public function __construct()
    {
        $this->data = [];
        $this->orderModel = $this->model('OrdersModel');
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


    public function store(){
        
    }

    // Function to edit an existing user in the database
    public function edit($orderId)
    {
        $order = $this->orderModel->getOrderById($orderId);

        $this->data['user'] = $order[0];
        $this->view('/Admin/pages/users/edit', $this->data);
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