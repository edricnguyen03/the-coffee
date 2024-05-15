<?php
include_once './App/Models/Auth.php';
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
        if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
            // If not, display an alert message and redirect them to the login page
            // header('Location: alert');
            header('Location: /the-coffee/Login_Regis/logout');
            exit;
        }
        if (Auth::checkPermission($_SESSION['login']['id'], 4) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
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
    public function edit($orderId) // hàm này là xem chi tiết á
    {
        if (!isset($_SESSION['login']['status']) && !isset($_SESSION['login']['id'])) {
            // If not, display an alert message and redirect them to the login page
            // header('Location: alert');
            header('Location: /the-coffee/Login_Regis/logout');
            exit;
        }
        if (Auth::checkPermission($_SESSION['login']['id'], 4) == false) {
            echo '<script> alert("Bạn không có quyền vào trang này"); </script>';
            require_once './App/errors/404.php';
            return;
        }
        // echo $orderId;
        $oderProducts = $this->ordersProducts->getOrderProducts2($orderId);
        $this->orderModel->setOrderId($orderId);
        $order = $this->orderModel->getOrdersById();

        foreach ($oderProducts as &$orderProduct) {
            $orderProduct['thumb_image'] = $this->productModel->getById($orderProduct['product_id'])->thumb_image;
            $orderProduct['product_name'] = $this->productModel->getById($orderProduct['product_id'])->name;
            $orderProduct['product_price'] = $this->productModel->getById($orderProduct['product_id'])->price;
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

    public function updateStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $orderId = $_POST['orderId'];
            $status = $_POST['orderStatus'];
            $this->orderModel->setOrderId($orderId);
            if ($status == 5) { // nếu hủy đơn hàng thì trả lại số lượng sản phẩm
                $order_products = $this->ordersProducts->getOrderProducts2($orderId);
                foreach ($order_products as $order_product) {
                    $this->productModel->changeStock($order_product['product_id'], -$order_product['qty']);
                }
            }
            $result = $this->orderModel->updateStatus($status);
            echo $result;
        }
    }
}
