<?php
class CartModel{

    public function addToCart($User_id, $idProduct, $soLuongMua){
        $cartItem = array(
            'idProduct' => $idProduct,
            'quantity' => $soLuongMua
        );
    
        // Chuyển đổi mảng thành chuỗi JSON
        $cartItemJson = json_encode($cartItem);

        //Kiểm tra giỏ hàng có tồn tại hay chưa----------------------------------------------
        // Nếu giỏ hàng chưa tồn tại, tạo giỏ hàng mới---------------------------------------
        // Nếu giỏ hàng đã tồn tại, và spham đã có cập nhật giỏ hàng-----------------------------------------

        return true;

    }
}