<?php
class Cart extends Controller
{
    public $cartModel;
    public $data;
    public $productModel;
    public $orderModel;
    public $orderProductModel;
    private $userModel;


    public function __construct()
    {
        $this->cartModel = $this->model('CartModel');
        $this->data = [];
        $this->productModel = $this->model('ProductModel');
        $this->orderModel = $this->model('OrdersModel');
        $this->orderProductModel = $this->model('OrderProductsModel');
        $this->userModel = $this->model('UserModel');
    }

    public function index()
    {
        if (!isset($_SESSION['login']['id'])) {
            require_once './App/errors/404.php';
            return;
        }

        $productsInCart = $this->cartModel->getProductsInCart($_SESSION['login']['id']);
        $products = $this->productModel->getAllProducts();
        $user = $this->userModel->getUserById($_SESSION['login']['id']);
        $this->data['user'] = $user[0];
        $this->data['productsInCart'] = $productsInCart;
        $this->data['products'] = $products;
        $this->view('/Client/Cart', $this->data);
    }

    // ham xoa 1 san pham khoi gio hang
    public function deleteProductInCart()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_POST['User_id']) && !empty($_POST['idProduct'])) {
                $User_id = $_POST['User_id'];
                $idProduct = $_POST['idProduct'];
                $this->cartModel->deleteProductInCart($User_id, $idProduct);
            }
        }
    }

    public function validateShip()
    {
        $val = $_POST['value'];
        $field = $_POST['field'];
        $result = $this->cartModel->validateShip($field, $val);
        return $result;
    }

    //ham cap nhat so luong san pham trong gio hang
    public function updateQuantityInCart()
    {
        if (!isset($_SESSION['login']['id'])) {
            require_once './App/errors/404.php';
            return;
        }
        $user_id = $_SESSION['login']['id'];
        $idProduct = $_POST['idProduct'];
        $newQuantity = $_POST['newQuantity'];
        $this->cartModel->updateProductQuantity($user_id, $idProduct, $newQuantity);
    }

    // ham thanh toan gio hang
    public function buyNow()
    {
        $id = $this->orderModel->getMaxId();
        $user_id = $_SESSION['login']['id'];
        $name = $_POST['name'];
        $phoneNumber = $_POST['phone'];
        $province = $_POST['province_name'];
        $district = $_POST['district_name'];
        $ward = $_POST['ward_name'];
        $address = $_POST['address_detail'];
        $total = $_POST['cartTotal'];
        $payment = 1;
        $status = 1;

        //lay ngay hien tai lam ngay dat hang
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date_order = date('Y-m-d H:i:s');

        $products = $this->cartModel->getProductsInCart($user_id);

        $data = [
            'id' => $id + 1,
            'user_id' => $user_id,
            'name_receiver' => $name,
            'address_receiver' => $address . ', ' . $ward . ', ' . $district . ', ' . $province,
            'phone_receiver' => $phoneNumber,
            'note' => null,
            'total' => $total,
            'payment_status' => $payment,
            'order_status' => $status,
            'create_at' => $date_order
        ];

        //goi ham add thong tin vao orders
        $this->orderModel->insertOrder($data);


        foreach ($products as $product) {
            //goi ham add thong tin vao orderProducts
            $orderId = $this->orderProductModel->getMaxId();
            $data_order = [
                'id' => $orderId + 1,
                'order_id' => $id + 1,
                'product_id' => $product->idProduct,
                'qty' => $product->quantity
            ];

            //them vao bang orderProduct
            $this->orderProductModel->insertOrderProduct($data_order);
        }
        //xoa tat ca san pham trong gio hang
        $this->cartModel->deleteAllProductInCart($user_id);

        //cap nhat lai so luong san pham trong kho su dung changeStock
        foreach ($products as $product) {

            $this->productModel->changeStock($product->idProduct, $product->quantity);
        }

        //return mua hang thanh cong va tro ve trang chu
        echo 'success';
    }
}
