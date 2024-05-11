<?php
class Cart extends Controller
{
    public $cartModel;
    public $data;
    public $productModel;
    public $orderModel;
    public $orderProductModel;


    public function __construct()
    {
        $this->cartModel = $this->model('CartModel');
        $this->data = [];
        $this->productModel = $this->model('ProductModel');
        $this->orderModel = $this->model('OrdersModel');
        $this->orderProductModel = $this->model('OrderProductsModel');
    }

    public function index()
    {
        if (!isset($_SESSION['login']['id'])) {
            require_once './App/errors/404.php';
            return;
        }

        $productsInCart = $this->cartModel->getProductsInCart($_SESSION['login']['id']);
        $products = $this->productModel->getAllProducts();

        $this->data['productsInCart'] = $productsInCart;
        $this->data['products'] = $products;
        $this->view('/Client/Cart', $this->data);
    }

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
            'order_status' => $status
        ];

        //goi ham o ordersmodel
        $this->orderModel->insertOrder($data);


        foreach ($products as $product) {
            //goi ham o orderproductmodel
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

        //cap nhat lai so luong san pham trong kho sử dụng changeStock
        foreach ($products as $product) {

            $this->productModel->changeStock($product->idProduct, $product->quantity);
        }


        //return mua hang thanh cong va tro ve trang chu
        echo 'success';
    }
}
