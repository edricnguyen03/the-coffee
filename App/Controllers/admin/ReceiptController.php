<?php
class ReceiptController extends Controller {

    public $data;
    public $receiptModel;
    public $providerModel;
    public $productModel;

    public function __construct()
    {
        $this->data = [];
        $this->receiptModel = $this->model('ReceiptModel');
        $this->providerModel = $this->model('ProviderModel');
        $this->productModel = $this->model('ProductModel');
    }

      // Function to show user data from the database
    public function index()
    {
        $this->view('/Admin/pages/receipts/index',);

    }

    // Function to create a new user in the database
    public function create()
    {
        $this->data['nameOfProvider'] = $this->providerModel->getAllProvidersName();
        $this->data['nameOfProduct']= $this->productModel->getAllProductsName();;
        // echo '<pre>';
        // print_r($this->data['name']);
        // echo '<pre>'; ;
        $this->view('/Admin/pages/receipts/create',$this->data);
    }


    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $providerId = $_POST['provider'];
            $total = $_POST['total'];
            $product = $_POST['product'];
            $price = $_POST['price'];
            
            $this->data['nameOfProvider'] = $this->providerModel->getAllProvidersName();
            $this->data['nameOfProduct']= $this->productModel->getAllProductsName();;


            // Get the current max id
            $maxId = $this->receiptModel->getMaxId();
            $newId = $maxId + 1;

            $data = [
                'id' => $newId,
                'name' => $name,
                'provider_id' => $providerId,
                'total' => $total,
            ];
            // var_dump($data);
            // die();
            if ($this->receiptModel->insertReceipt($data)) {
                $this->view('/Admin/pages/receipts/create', ['success' => 'Nhập hàng thành công']);
                //tao session
                //them exit()
            } else {
                $this->view('/Admin/pages/receipts/create', ['error' => 'Nhập hàng thất bại']);
            };
        }  
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