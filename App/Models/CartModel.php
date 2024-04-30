<?php
class CartModel
{
    //them cac san pham da them vo database bang carts
    public function addToCart($User_id, $idProduct, $soLuongMua)
    {
        $cartItem[] = array(
            'idProduct' => $idProduct,
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
            $cartItemsArray = json_decode(rtrim($currentCartItems[0]['cart_items'], '1'));
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

    //kiem tra thong tin giao hang nhap vao
    public function validateShip($field, $val)
    {
        $result = '';

        //kiem tra ho ten
        if ($field == 'name_result') {
            //kiem tra do dai ten duoi 4 ki tu
            if (strlen(trim($val)) < 4) {
                $result = 'Tên phải lớn hơn 4 ký tự';
            }

            //kiem tra do dai ten qua 40 ki tu 
            else if (strlen(trim($val)) > 40) {
                $result = 'Tên không được quá 40 ký tự';
            }

            //kiem tra ten co chua ki tu dac biet hoac so khong
            else if (!preg_match("/^[\p{L} ]*$/u", $val) || preg_match("/\d/", $val)) {
                $result = 'Tên không được chứa ký tự đặc biệt hoặc số';
            } else {
                $result = '<label class="text-success">Hợp lệ</label>';
            }
        }

        //kiem tra so dien thoai
        if ($field == "phone_result") {
            if (!preg_match("/^0(\d{9}|9\d{8})$/", $val)) {
                $result = 'Số điện thoại không hợp lệ';
            } else {
                $result = '<label class="text-success">Hợp lệ</label>';
            }
        }

        //kiem tra email
        if ($field == "email_result") {

            if ($val == "") {
                $result = '<label class="text-success">Hợp lệ</label>';
            }

            //kiem tra email hop le
            if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $val)) {
                $result = 'Email không hợp lệ';
            }

            //kiem tra do dai email
            else if (!preg_match("/^(?=.{1,40}$)([\w\-]+\@[\w\-]+\.[\w\-]+)/", $val)) {
                $result = 'Email dài quá 40 ký tự';
            } else {
                $result = '<label class="text-success">Hợp lệ</label>';
            }
        }

        //kiem tra da chon tinh thanh pho hay chua trong combobox
        if ($field == "province_result") {
            if ($val == "Bạn chưa chọn") {
                $result = 'Vui lòng chọn Tỉnh/Thành phố';
            } else {
                $result = '<label class="text-success">Hợp lệ</label>';
            }
        }

        //kiem tra da chon huyen hay chua trong combobox
        if ($field == "district_result") {
            if ($val == "") {
                $result = 'Vui lòng chọn Quận/Huyện';
            } else {
                $result = '<label class="text-success">Hợp lệ</label>';
            }
        }

        //kiem tra da chon xa hay chua trong combobox
        if ($field == "ward_result") {
            if ($val == "") {
                $result = 'Vui lòng chọn Phường/Xã';
            } else {
                $result = '<label class="text-success">Hợp lệ</label>';
            }
        }

        //kiem tra dia chi
        if ($field == "address_result") {
            if (strlen(trim($val)) < 10) {
                $result = 'Địa chỉ phải lớn hơn 10 ký tự';
            } else {
                $result = '<label class="text-success">Hợp lệ</label>';
            }
        }

        return $result;
    }
}
