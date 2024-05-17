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
        if (Auth::checkPermission($_SESSION['login']['id'], Auth::$permissionOrder) == false) {
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
        if (isset($_POST['column_id']) && !empty($_POST['column_id'])){
            // echo '<pre>';
            // print_r($_POST['column_id']);
            // echo '<pre>';
            // die();
            global $db;
            $output = '';  
            $order = $_POST["order"];  
            if($order == 'desc')  
            {  
                $order = 'asc';  
            }  
            else  
            {  
                $order = 'desc';  
            }  
            // $query = "SELECT * FROM receipts ORDER BY ".$_POST["column_id"]." ".$_POST["order"]."";  
            $query = $db->query("SELECT * FROM orders ORDER BY ".$_POST["column_id"]." ".$_POST["order"]."");
            $query->execute();
            $output .= '
                <div class="mb-3">
                    <form method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Tìm kiếm theo tên khách hàng">
                            <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                        </div>
                    </form>
                </div>  
                <table class="table">
                <thead>
                    <tr>
                        <th scope="col"><a class="column_sort" id="id" data-order="'.$order.'" href="#">ID</a></th>
                        <th scope="col"><a class="column_sort" id="name_receiver" data-order="'.$order.'" href="#">Tên Khách hàng</a></th>
                        <th scope="col"><a class="column_sort" id="total" data-order="'.$order.'" href="#">Số tiền</a></th>
                        <th scope="col"><a class="column_sort" id="payment_status" data-order="'.$order.'" href="#">Tình trạng thanh toán</a></th>
                        <th scope="col"><a class="column_sort" id="order_status" data-order="'.$order.'" href="#">Tình trạng đơn hàng</a></th>
                        <th scope="col"><a class="column_sort" id="create_at" data-order="'.$order.'" href="#">Ngày</a></th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>  
            ';
            // $role_id = $user['role_id'];
            // $query = $db->query("SELECT * FROM roles WHERE id = $role_id");
            // $query->execute();
            // $role = $query->fetch();
            // echo $role['name'];
            $order2 = $query->fetchAll();
            // foreach ($order2 as $row) {
            //     echo '<pre>';
            //     var_dump($row['payment_status']);
            //     echo '<pre>';
            // }
            // die();
            foreach ($order2 as $row) 
            {  
                // $role_id = $row['role_id'];
                // $query = $db->query("SELECT * FROM roles WHERE id = $role_id");
                // $query->execute();
                // $role = $query->fetch();
                // echo $role['name'];
                $output .= ' 
                    <tbody>
                    <tr>
                        <th scope="row">' . $row["id"] . '</th>
                        <td>' . $row["name_receiver"] . '</td>
                        <td>' . $row["total"] . '</td>
                        <td>';

                        // Bắt đầu bộ đệm đầu ra để kiểm tra điều kiện thanh toán
                        if ($row['payment_status'] == 1) { 
                            $output .= '<button class="btn btn-success" disabled>Đã thanh toán</button>';
                        } else { 
                            $output .= '<button class="btn btn-danger" disabled>Chưa thanh toán</button>';
                        }

                        $output .= '</td>
                        <td>';

                        if ($row['order_status'] == 1) { 
                            $output .= '<span style="color: #0d6efd;">Đang chờ xử lý</span>';
                        } elseif ($row['order_status'] == 2) { 
                            $output .= '<span style="color: #0d6efd;">Đã xác nhận và sẵn sàng giao hàng</span>';
                        } elseif ($row['order_status'] == 3) { 
                            $output .= '<span style="color: #0d6efd;">Đang giao hàng</span>';
                        } elseif ($row['order_status'] == 4) { 
                            $output .= '<span style="color: green;">Đã giao hàng</span>';
                        } elseif ($row['order_status'] == 5) { 
                            $output .='<span style="color: red;">Đã hủy</span>';
                        }

                        $output .= '</td>
                        <td>' . $row['create_at'] . '</td>
                        <td>
                            <a href="detail/' . $row["id"] . '" class="btn btn-primary">Chi tiết</a>
                        </td>
                    </tr>
                    </tbody>
                '; 
            }  
            $output .= '</table>';  
            echo $output;  
            //PHẦN XỬ LÝ SẮP XẾP TĂNG DẦN GIẢM DẦN
        }
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
        if (Auth::checkPermission($_SESSION['login']['id'], Auth::$permissionOrder) == false) {
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
