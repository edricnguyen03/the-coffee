<?php
include_once './App/Models/Auth.php';
class ReceiptController extends Controller
{

    public $data;
    public $receiptModel;
    public $providerModel;
    public $productModel;
    public $productsReceipts;

    public function __construct()
    {
        $this->data = [];
        $this->receiptModel = $this->model('ReceiptModel');
        $this->providerModel = $this->model('ProviderModel');
        $this->productModel = $this->model('ProductModel');
        $this->productsReceipts = $this->model('ProductsReceipts');
    }

    // Function to show user data from the database
    public function index()
    {
        if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
            // If not, display an alert message and redirect them to the login page
            // header('Location: alert');
            header('Location: ../../Login_Regis/logout');
            exit;
        }
        if (Auth::checkPermission($_SESSION['login']['id'], 8) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        $this->view('/Admin/pages/receipts/index',);
    }

    // Function to create a new user in the database
    public function create()
    {
        if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
            // If not, display an alert message and redirect them to the login page
            // header('Location: alert');
            header('Location: ../../Login_Regis/logout');
            exit;
        }
        if (Auth::checkPermission($_SESSION['login']['id'], 8) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        $this->data['nameOfProvider'] = $this->providerModel->getAllProvidersName();
        $this->data['nameOfProduct'] = $this->productModel->getAllProductsName();;
        // echo '<pre>';
        // print_r($this->data['name']);
        // echo '<pre>'; ;
        $this->view('/Admin/pages/receipts/create', $this->data);
    }


    public function store()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $providerId = $_POST['provider'];
            $quantity = $_POST['item_quantity'];
            $productId = $_POST['item_name'];
            $price = $_POST['item_price'];
            //phần sắp xếp



            //xử lý total = quantity từng phần + lại
            $total = 0;
            foreach ($quantity as $value) {
                $total += $value;
            }
            // echo $total;
            // echo '<pre>';
            // print_r($price);
            // echo '<pre>'; 
            // die();
            $this->data['nameOfProvider'] = $this->providerModel->getAllProvidersName();
            $this->data['nameOfProduct'] = $this->productModel->getAllProductsName();;
            // Get the current max id
            $maxId = $this->receiptModel->getMaxId();
            $newId = $maxId + 1;

            $data = [
                'id' => $newId,
                'name' => $name,
                'provider_id' => $providerId,
                'total' => $total,
            ];

            //create new receipt
            if ($this->receiptModel->insertReceipt($data)) {
                global $db;
                for ($count = 0; $count < count($_POST["item_name"]); $count++) {
                    $data2 = [
                        'product_id' => $_POST["item_name"][$count],
                        'receipt_id' => $newId,
                        'quantity' => $_POST["item_quantity"][$count],
                        'product_price' => $_POST["item_price"][$count],
                    ];
                    // echo '<pre>';
                    // print_r($_POST);
                    // echo '<pre>'; 
                    $this->productsReceipts->insertPR($data2);
                    //cập nhật stock
                    $this->productModel->changeStock($_POST["item_name"][$count], -$_POST["item_quantity"][$count]);
                    // $query = "
                    // INSERT INTO product_receipt 
                    // (product_id, receipt_id, quantity) 
                    // VALUES (:product_id, :receipt_id, :quantity)
                    // ";
                    // $query3 = "
                    // INSERT INTO products 
                    // (item_price) 
                    // VALUES (:item_price)
                    // ";
                    // $connect = new PDO("mysql:host=localhost; dbname=the-coffe","root","");
                    // $query = "INSERT INTO product_receipt (id, product_id, receipt_id, quantity) VALUES (:id, :product_id, :receipt_id, :quantity)";
                    // // $query = "INSERT INTO product_receipt (id, product_id, receipt_id, quantity) VALUES (:product_id, :quantity)";
                    // $statement1 = $connect->prepare($query);
                    // $statement1->bindParam(':product_id', $_POST["item_name"][$count]);
                    // $statement1->bindParam(':receipt_id', $newId);
                    // $statement1->bindParam(':quantity', $_POST["item_quantity"][$count]);
                    // $statement1->execute();
                }
                echo 'oke';
                // $result = $statement1->fetchAll();
                //     if(isset($result))
                //     {
                //         echo 'ok';
                //     }
                // echo '<pre>';
                // print_r($_POST);
                // echo '<pre>'; 
                // $_SESSION['success'] = 'Thêm đơn nhập hàng thành công';
                // header('Location: /the-coffee/admin/receipt/index');
                // exit();

                //tao session
                //them exit()
            } else {
                $_SESSION['error'] = 'Thêm đơn nhập hàng thành công thật bại';
            };
        }
    }

    // Function to edit an existing user in the database
    public function edit($receiptId)
    {
        if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
            // If not, display an alert message and redirect them to the login page
            // header('Location: alert');
            header('Location: ../../Login_Regis/logout');
            exit;
        }
        if (Auth::checkPermission($_SESSION['login']['id'], 8) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        // $receipt = $this->receiptModel->getReceiptById($receiptId);

        // $this->data['name'] = $this->receiptModel->getReceiptNameById($receiptId);
        // $this->data['nameOfProvider'] = $this->providerModel->getAllProvidersName();
        // $this->data['providerId'] = $this->receiptModel->getProviderIdById($receiptId);
        // $this->data['receiptId'] = $receiptId;
        // $this->data['receipt'] = $receipt[0];
        // $this->view('/Admin/pages/receipts/edit', $this->data);
        // Redirect to the index page or show a success message

        $providerId = $this->receiptModel->getProviderIdById($receiptId);
        // echo '<pre>';
        // print_r($receiptId);
        // echo '<pre>';
        $providerName = $this->providerModel->getProvidersName($providerId[0]['provider_id']);
        // echo '<pre>';
        // print_r($providerName[0]);
        // echo '<pre>';
        $receiptName = $this->receiptModel->getReceiptNameById($receiptId);
        $receiptTotal = $this->receiptModel->getReceiptTotalById($receiptId);
        // echo '<pre>';
        // print_r($receiptTotal);
        // echo '<pre>';
        $productReceipts = $this->productsReceipts->getProductsReceipt($receiptId);
        $receipt = $this->productsReceipts->getPRById($receiptId);
        foreach ($productReceipts as &$productReceipt) {
            //lấy và group với name của product
            $productReceipt['product_name'] = $this->productModel->getById($productReceipt['product_id'])->name;
        }
        $this->data['receiptTotal'] = $receiptTotal[0]['total'];
        $this->data['nameProvider'] = $providerName[0]['name'];
        $this->data['productReceipts'] = $productReceipts; //product_receipt là name
        $this->data['receipt'] = $receipt;
        $this->data['nameReceipt'] = $receiptName[0]['name'];
        $product_prices = array_column($productReceipts, 'product_price');
        $sum = 0;
        foreach ($product_prices as $price) {
            $sum += $price;
        }
        $this->data['sum'] = $sum;
        // echo $sum;
        // echo '<pre>';
        // print_r($product_prices);
        // echo '<pre>';
        $this->data['nameReceipt'] = $receiptName[0]['name'];
        // echo '<pre>';
        // print_r($this->data['productReceipts']);
        // echo '<pre>';
        // echo '<pre>';
        // print_r($this->data['receipt']);
        // echo '<pre>';
        $this->view('/Admin/pages/receipts/detail', $this->data);
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
        if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
            // If not, display an alert message and redirect them to the login page
            // header('Location: alert');
            header('Location: ../../Login_Regis/logout');
            exit;
        }
        if (Auth::checkPermission($_SESSION['login']['id'], 8) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        if ($this->receiptModel->deleteReceipt($receiptId)) {
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
