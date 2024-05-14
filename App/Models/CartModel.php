<?php
class CartModel
{
    //them cac san pham da them vo database bang carts
    public function addToCart($User_id, $idProduct, $soLuongMua)
    {
        $productModel = new ProductModel();
        $cartItem[] = array(
            'idProduct' => $idProduct,
            'quantity' => $soLuongMua
        );
        global $db;
        try {
            if($productModel->getById($idProduct)->stock <= 0){
                return 'Số lượng sản phẩm trong giỏ hàng đã vượt quá số lượng tồn kho. Vui lòng giảm số lượng mua hoặc chọn sản phẩm khác !';
            }
            // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng của người dùng hay chưa
            $currentCartItems = $db->get('carts', 'cart_items',  'user_id = ' . $User_id);
            // Nếu chưa có giỏ hàng, thêm một mục mới vào giỏ hàng
            if (!$currentCartItems) {
                $db->insert('carts', ['user_id' => $User_id, 'cart_items' => json_encode($cartItem)]);
                return true;
            }

            // Nếu đã có giỏ hàng, kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng hay chưa
            $cartItemsArray = json_decode(rtrim($currentCartItems[0]['cart_items'], '1'));
            $itemFound = false;
            foreach ($cartItemsArray as &$item) {
                if ($item->idProduct == $idProduct) {
                    // Tăng số lượng sản phẩm nếu đã tồn tại
                    if ($item->quantity + $soLuongMua > $productModel->getById($idProduct)->stock) {
                        return 'Số lượng sản phẩm trong giỏ hàng đã vượt quá số lượng tồn kho. Vui lòng giảm số lượng mua hoặc chọn sản phẩm khác !';
                    }
                    $item->quantity += $soLuongMua;
                    $itemFound = true;
                    break;
                }
            }
            unset($item); // Giải phóng biến tham chiếu

            // Nếu sản phẩm không tồn tại trong giỏ hàng, thêm một mục mới
            if (!$itemFound) {
                $cartItemsArray[] = array(
                    'idProduct' => $idProduct,
                    'quantity' => $soLuongMua
                );
            }
            // Cập nhật giỏ hàng trong cơ sở dữ liệu
            $db->update('carts', ['cart_items' => json_encode($cartItemsArray)],  'User_id = ' . $User_id);
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    //lay cac san pham trong cart hien len giao dien cart
    public function getProductsInCart($User_id)
    {
        global $db;
        $cartItems = $db->get('carts', 'cart_items',  'user_id = ' . $User_id);
        if (!$cartItems) {
            return [];
        }
        return json_decode(rtrim($cartItems[0]['cart_items'], '1'));
    }

    //xoa san pham trong cart
    public function deleteProductInCart($User_id, $idProduct)
    {
        global $db;
        $cartItems = $db->get('carts', 'cart_items',  'user_id = ' . $User_id);
        if (!$cartItems) {
            return false;
        }

        $cartItemsArray = json_decode(rtrim($cartItems[0]['cart_items'], '1'));
        $newCartItemsArray = [];
        foreach ($cartItemsArray as $item) {
            if ($item->idProduct != $idProduct) {
                $newCartItemsArray[] = $item;
            }
        }
        $db->update('carts', ['cart_items' => json_encode($newCartItemsArray)],  'User_id = ' . $User_id);
        return true;
    }

    //xoa tat ca san pham trong cart
    public function deleteAllProductInCart($User_id)
    {
        global $db;
        $db->update('carts', ['cart_items' => '[]'],  'User_id = ' . $User_id);
    }

    // cập nhật số lượng sản phẩm trong giỏ hàng
    public function updateProductQuantity($User_id, $idProduct, $newQuantity)
    {
        global $db;
        $cartItems = $db->get('carts', 'cart_items', 'user_id = ' . $User_id);
        if (!$cartItems) {
            return false;
        }

        $cartItemsArray = json_decode(rtrim($cartItems[0]['cart_items'], '1'));
        foreach ($cartItemsArray as &$item) {
            if ($item->idProduct == $idProduct) {
                $item->quantity = $newQuantity;
                break;
            }
        }
        unset($item); // Giải phóng biến tham chiếu

        $db->update('carts', ['cart_items' => json_encode($cartItemsArray)], 'User_id = ' . $User_id);
        return true;
    }
}
