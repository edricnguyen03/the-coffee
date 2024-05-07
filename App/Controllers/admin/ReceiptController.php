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
                $_SESSION['success'] = 'Thêm đơn nhập hàng thành công';
                header('Location: /the-coffee/admin/receipt/index');
                exit();
                //tao session
                //them exit()
            } else {
                $_SESSION['error'] = 'Xóa đơn nhập hàng thất bại';
            };
        }  
    }

    // Function to edit an existing user in the database
    public function edit($receiptId)
    {
        
        $receipt = $this->receiptModel->getReceiptById($receiptId);
       
        $this->data['name'] = $this->receiptModel->getReceiptNameById($receiptId);
        $this->data['nameOfProvider'] = $this->providerModel->getAllProvidersName();
        $this->data['providerId'] = $this->receiptModel->getProviderIdById($receiptId);
        $this->data['receiptId'] = $receiptId;
        $this->data['receipt'] = $receipt[0];
        $this->view('/Admin/pages/receipts/edit', $this->data);
        // Redirect to the index page or show a success message
    
    }
    
    public function update($receiptId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $providerId = $_POST['provider'];
            $total = $_POST['total'];

            $updateData = [
                'name' => $name,
                'provider_id' => $providerId,
                'total' => $total,
            ];
            if ($this->receiptModel->updateReceipt($receiptId, $updateData)) {
                $receipt = $this->receiptModel->getReceiptById($receiptId);
                $this->data['name'] = $this->receiptModel->getReceiptNameById($receiptId);
                $this->data['receipt'] = $receipt[0];
                $this->data['providerId'] = $providerId;
                $this->data['nameOfProvider'] = $this->providerModel->getAllProvidersName();
                $_SESSION['success'] = 'Chỉnh sửa đơn nhập hàng thành công';
                $this->view('/Admin/pages/receipts/edit', $this->data);
                exit();
            } else {
                $this->view('/Admin/pages/receipts/edit', ['error' => 'Chỉnh sửa đơn nhập hàng thất bại']);
            };
        }
    }

    public function delete($receiptId)
    {
        if($this->receiptModel->deleteReceipt($receiptId)){
            // If the deletion was successful, save success message to session
            $_SESSION['success'] = 'Xóa đơn nhập hàng thành công';
            // Then redirect to the index page
            header('Location: /the-coffee/admin/receipt/');
            exit();
        } else {
            // If the deletion failed, show an error message and stay on the current page
            // You can also save the error message to session and display it on the current page
            $_SESSION['error'] = 'Xóa đơn nhập hàng thất bại';
        }
        // Your code to delete the user from the database based on $userId
    }

    public function alert()
    {
        $this->view('/alert',);
    }
}