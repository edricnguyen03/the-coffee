<?php
class ReceiptController extends Controller {

    public $data;
    public $receiptModel;

    public function __construct()
    {
        $this->data = [];
        $this->receiptModel = $this->model('ReceiptModel');
    }

      // Function to show user data from the database
    public function index()
    {
        $this->view('/Admin/pages/receipts',);

    }

    // Function to create a new user in the database
    public function create()
    {
        // $this->data = $this->receiptModel->getAllReceipts();
        // echo '<pre>';
        // print_r( $this->data);
        // echo '<pre>';

        $this->view('/Admin/pages/receipts/create',);
    }


    public function store(){
        
    }

    // Function to edit an existing user in the database
    public function edit($userId, $newUserData)
    {
        // Your code to update the user data in the database based on $userId with $newUserData
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