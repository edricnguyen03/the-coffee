<?php
class CartModel
{

    public function addToCart($User_id, $idProduct, $soLuongMua)
    {
        $cartItem[] = array(
            'idProduct'=> $idProduct,
            'quantity' => $soLuongMua
        );
        global $db;
        try {
            // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng của người dùng hay chưa
            $currentCartItems = $db->get('carts', 'cart_items',  'user_id = ' . $User_id);
            // Nếu chưa có giỏ hàng, thêm một mục mới vào giỏ hàng
            if (!$currentCartItems) {
                $db->insert('carts', ['user_id' => $User_id, 'cart_items' => json_encode($cartItem)]);
                return true;
            }

            // Nếu đã có giỏ hàng, kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng hay chưa
            $cartItemsArray = json_decode(rtrim($currentCartItems[0]['cart_items'],'1'));
            $itemFound = false;
            foreach ($cartItemsArray as &$item) {
                if ($item->idProduct == $idProduct) {
                    // Tăng số lượng sản phẩm nếu đã tồn tại
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
}

