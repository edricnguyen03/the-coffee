<?php
class CartModel{

    public function addToCart($User_id, $idProduct, $soLuongMua){
        global $db;
        try{
            $cartItem = array(
                'idProduct' => $idProduct,
                'quantity' => $soLuongMua
            );
            
            // Chuyển đổi mảng thành chuỗi JSON
            $cartItemJson = json_encode($cartItem);
    
            $currentCartJson = $db->get('cart','cart_items','User_id = '.$User_id);
            $currentCartItems = json_decode($currentCartJson, true);
            foreach($currentCartItems as $item){ // kiểm tra mặt hàng đã có trong giỏ hàng chưa
                if($item['idProduct'] == $idProduct){
                    $item['quantity'] += $soLuongMua;
                    $currentCartItems = json_encode($currentCartItems);
                    $db->update('cart', ['cart_items' => $currentCartItems], 'User_id = '.$User_id);
                    return true;
                }
            }
            $currentCartItems[] = $cartItem;
            $currentCartItems = json_encode($currentCartItems);
            $db->update('cart', ['cart_items' => $currentCartItems], 'User_id = '.$User_id);
            return true;
        }catch(Exception $e){
            return false;
        }
    }
}