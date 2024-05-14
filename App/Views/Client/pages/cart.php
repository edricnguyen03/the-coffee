<section>
    <div class="container">
        <form action="Cart/buyNow" method="post">
            <div class="row">
                <div class="col-lg-7 col-md-12">
                    <!-- Heading -->
                    <h4 class="mb-5">Thông tin giao hàng</h4>
                    <!-- Billing Form -->
                    <div class="row mb-3 mb-30">

                        <!-- Name -->
                        <div class="col-12">
                            <div class="form-group">
                                <p> <input type="text" class="form-control" id="name" name="name" placeholder="Họ tên" onblur="validation('name_result', this.value)" required value="<?php echo $_SESSION['login']['username'] ?>"> </p>
                            </div>
                            <div>
                                <span class=" text-danger" id="name_result"></span>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="col-12">
                            <div class="form-group">
                                <p> <input type="phone" class="form-control" id="phone" name="phone" placeholder="Số điện thoại" onblur="validation('phone_result', this.value)" required> </p>
                            </div>
                            <div>
                                <span class="text-danger" id="phone_result"></span>
                            </div>
                        </div>

                        <!-- Email -->
                        <!-- <div class="col-12">
                            <div class="form-group">
                                <p> <input type="email" class="form-control" id="email" name="email" placeholder="Email" onblur="validation('email_result', this.value)"> </p>
                            </div>
                            <div>
                                <span class="text-danger" id="email_result"></span>
                            </div>
                        </div> -->

                        <!-- Note -->
                        <div class="col-12">
                            <div class="form-group">
                                <p> <textarea class="form-control" id="note" name="note" placeholder="Ghi chú" rows="2"></textarea> </p>
                            </div>
                        </div>

                        <!-- Province -->
                        <div class="col-12">
                            <div class="form-group">
                                <p> <label for="province">Tỉnh/Thành phố</label> </p>
                                <p> <select class="input_search province" id="province" name="province" onblur="validation('province_result', this.value)" required>
                                        <option selected>Bạn chưa chọn</option>
                                        <!-- dung vong lap de in ra cac tinh thanh -->


                                    </select>
                                </p>
                                <input type="hidden" name="province_name" id="province_name">
                            </div>

                            <div>
                                <span class="text-danger" id="province_result"></span>
                            </div>
                        </div>

                        <!-- District -->
                        <div class="col-12">
                            <div class="form-group">
                                <p> <label for="district">Quận/Huyện</label> </p>
                                <p> <select class="input_search district" id="district" name="district" onblur="validation('district_result', this.value)" required>

                                        <!-- chon tinh in ra huyen tuong ung php -->

                                    </select>
                                </p>
                                <input type="hidden" name="district_name" id="district_name">
                            </div>

                            <div>
                                <span class="text-danger" id="district_result"></span>
                            </div>
                        </div>

                        <!-- Ward -->
                        <div class="col-12">
                            <div class="form-group">
                                <p> <label for="ward">Phường/Xã</label> </p>
                                <p> <select class="input_search ward" id="ward" name="ward" onblur="validation('ward_result', this.value)" required>

                                        <!-- chon huyen in ra xa tuong ung !-->
                                    </select>
                                </p>
                                <input type="hidden" name="ward_name" id="ward_name">
                            </div>

                            <div>
                                <span class="text-danger" id="ward_result"></span>
                            </div>
                        </div>

                        <!-- Address Detail -->
                        <div class="col-12">
                            <div class="form-group">
                                <p> <input type="text" class="form-control" id="address_detail" name="address_detail" placeholder="Địa chỉ chi tiết" onblur="validation('address_result', this.value)" required> </p>
                            </div>

                            <div>
                                <span class="text-danger" id="address_result"></span>
                            </div>
                        </div>

                    </div>

                    <!-- Payment heading -->
                    <h4 class="mb-3">Phương thức thanh toán</h4>
                    <div class="list-group list-group-sm mb-5">
                        <div class="list-group-item">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="paymentCard" name="paymentMethod" value="1" checked>
                                <label class="custom-control-label font-size-sm" for="paymentCard">Tiền mặt</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-5">
                    <!-- Heading -->
                    <h4 class="mb-5">Đơn hàng của bạn</h4>
                    <!-- Order Summary -->
                    <div class="cart" id="cart" style="border:none">
                        <div class="cart-priceTotal">
                            <?php

                            //ham xu ly so tien
                            function product_price($priceFloat)
                            {
                                $symbol = ' ₫';
                                $symbol_thousand = '.';
                                $decimal_place = 0;
                                $price = number_format($priceFloat, $decimal_place, '', $symbol_thousand);
                                return $price . $symbol;
                            }

                            $total_price = 0;
                            foreach ($productsInCart as $cartProduct) {
                                foreach ($products as $product) {
                                    if ($cartProduct->idProduct == $product->id) {
                                        //tong tien = don gia * so luong
                                        $total_price +=  $product->price * $cartProduct->quantity;
                                    }
                                }
                            }
                            ?>
                            <h6>
                                Tổng Đơn Hàng
                                <span class="cartSub"> <?php echo product_price($total_price) ?></span>
                            </h6>

                            <div class="shipping-cart">
                                <h6>
                                    Phí Vận Chuyển
                                    <span>-</span>
                                </h6>
                            </div>
                            <h6>
                                Tổng Tiền
                                <span class="cartTotal"><?php echo product_price($total_price) ?></span>
                                <!-- add a hidden input to store the total price -->
                                <input type="hidden" name="cartTotal" id="cartTotal" value="<?php echo $total_price; ?>">
                            </h6>
                        </div>

                        <div class="cart_select_items">
                            <?php

                            foreach ($productsInCart as $cartProduct) {
                                foreach ($products as $product) {
                                    if ($cartProduct->idProduct == $product->id) {
                                        $cartProduct->name = $product->name;
                                        $cartProduct->thumb_image = $product->thumb_image;
                                        $cartProduct->price = $product->price;
                                        $cartProduct->stock = $product->stock;
                                    }
                                }



                                echo ' <div class="cart_item">
                                    <div class="cart_item_thumb">
                                        <span>
                                            <img style="object-fit: cover;width: 100%; height: 100%;" src="./resources/images/products/' . $cartProduct->thumb_image . '" />
                                        </span>
                                    </div>
                                    <div class="cart_item_caption">
                                        <span>
                                            <h4 class="product_title">' . $cartProduct->name . '</h4>
                                        </span>
                                        <span class="number_of_item"><b>Số lượng: </b><input type="number" name="soLuong" productid = "' . $cartProduct->idProduct . '"  class="product_quantity" min="1" max="' . $cartProduct->stock . '" value="' . $cartProduct->quantity  . '"> </span>
                                         <span class=" cart_item_price" style="font-size: 14px"><b>Giá tiền: </b>' . $cartProduct->price . '</span>

                                        <button class="text-danger cart_item_remove" id="delete" style="border: none;" onclick="deleteProductInCart(' .  $_SESSION['login']['id'] . ' , ' . $cartProduct->idProduct . ')">Xóa</button>

                                    </div>
                                </div> ';
                            }
                            ?>
                        </div>

                    </div>
                    <!-- Button -->
                    <div class="cart_action" style="margin-bottom: 50px">
                        <button type="submit" class="btn-checkout">Thanh toán</button>
                    </div>


        </form>

    </div>

</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script src="./resources/js/filter-province.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const total_price = 0;
    //thêm một hàm để xóa một sản phẩm khỏi giỏ hàng và tải lại trang
    function deleteProductInCart(User_id, idProduct) {
        $.ajax({
            url: '/the-coffee/Cart/deleteProductInCart', //tro toi controller cart va goi ham delete
            type: 'POST',
            data: {
                User_id: User_id,
                idProduct: idProduct
            },
            success: function(response) {
                location.reload();
            }
        });
    }

    //thêm hàm để cập nhật số lượng của một sản phẩm trong giỏ hàng
    function updateQuantity(idProduct, newQuantity) {
        $.ajax({
            url: '/the-coffee/Cart/updateQuantityInCart',
            type: 'POST',
            data: {
                idProduct: idProduct,
                newQuantity: newQuantity
            },
            success: function(response) {
                location.reload();
            }

        });
    }



    // thêm hàm để kiểm tra số lượng nhập từ người dùng
    function checkQuantityInput(event) {

        //kiểm tra số lượng nhập vào có rỗng hay không
        if (isNaN(event.target.value)) {
            Swal.fire({
                icon: 'error',
                title: 'Số lượng không hợp lệ',
                text: 'Vui lòng nhập số lượng sản phẩm',
            });

        }
        //chuyen so luong ve so nguyen
        var quantity = parseInt(event.target.value);

        var stock = parseInt(event.target.getAttribute('max'));
        var idProduct = event.target.getAttribute('productid'); // lay id cua san pham da them
        // Kiểm tra số lượng nhập vào phải lớn hơn 0, nhỏ hơn hoặc bằng số lượng tồn kho và phải là số
        if (quantity < 1 || quantity > stock || isNaN(quantity)) {
            Swal.fire({
                icon: 'error',
                title: 'Số lượng không hợp lệ',
                text: "Số lượng phải nằm trong khoảng từ 1 đến " + stock,
                didClose: () => {
                    event.target.value = 1;
                }
            });



        } else {
            //gọi hàm cập nhật số lượng sản phẩm trong giỏ hàng
            updateQuantity(idProduct, quantity);
            calculateTotalPrice();
        }


    }




    // thêm sự kiện để kiểm tra tất cả các input nhập số lượng
    document.addEventListener('DOMContentLoaded', function() {
        var quantityInputs = document.querySelectorAll('.product_quantity');
        quantityInputs.forEach(function(input) {
            input.addEventListener('focusout', checkQuantityInput);
        });
    });

    // thêm hàm để tính tổng giá trị của giỏ hàng
    function calculateTotalPrice() {
        var quantityInputs = document.querySelectorAll('.product_quantity');
        // var currentTotal = 0;

        quantityInputs.forEach(function(input) {
            if (input.value.includes('.')) {
                input.value = 0;
            }
            var quantity = parseInt(input.value);
            var priceElement = input.closest('.cart_item').querySelector('.cart_item_price');
            var price = parseInt(priceElement.innerText);
            var total = quantity * price;
            total_price += total;
        });
        // if (isNaN(currentTotal)) {
        //     currentTotal = 0;
        // }
        document.querySelector('.cartSub').innerText = formatCurrency(currentTotal);
        document.querySelector('.cartTotal').innerText = formatCurrency(currentTotal);
    }

    //thêm sự kiện để tính tổng giá trị của giỏ hàng
    // document.addEventListener('DOMContentLoaded', function() {
    //     var quantityInputs = document.querySelectorAll('.product_quantity');
    //     quantityInputs.forEach(function(input) {
    //         input.addEventListener('input', calculateTotalPrice);
    //     });
    //     calculateTotalPrice();
    // });

    // thêm code Jquery để chuyển giá trị tổng tiền vào trường input ẩn để post dữ liệu
    $('.product_quantity').on('input', function() {
        // gọi hàm tính tổng giá trị của giỏ hàng
        var newTotalPrice = calculateTotalPrice();

        // cập nhật giá trị tổng tiền của giỏ hàng
        $('.cartTotal').text(newTotalPrice);

        // cập nhật giá trị tổng tiền vào trường input ẩn
        $('#cartTotal').val(newTotalPrice);
    });

    // thêm hàm để định dạng giá tiền sang vnd
    function formatCurrency(number) {
        return new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }).format(number);
    }

    // thêm hàm để kiểm tra thông tin giao hàng
    function validation(field, value) {
        //check the name
        if (field == 'name_result') {
            if (value.length < 4) {
                $('#name_result').html('Tên phải lớn hơn 4 ký tự');
            } else {
                if (value.length > 40) {
                    $('#name_result').html('Tên không được quá 40 ký tự');
                }

                // kiem tra ten co chua khoang trang o 2 dau khong
                else if (value.trim() !== value) {
                    $('#name_result').html('Tên không được chứa khoảng trắng');
                }

                //kiem tra chu cai tieng viet 
                else if (!/^[a-zA-ZáàảãạăắằặẳẵâầấẩẫậèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđĐ\s]+$/.test(value)) {
                    $('#name_result').html('Tên không được chứa ký tự đặc biệt hoặc số');
                } else {
                    $('#name_result').html('');
                }
            }
        }

        //check the phone number
        if (field == 'phone_result') {
            if (!/^0(\d{9}|9\d{8})$/.test(value)) {
                $('#phone_result').html('Số điện thoại không hợp lệ');
            } else {
                $('#phone_result').html('');
            }
        }


        //check selected item of combobox province
        if (field == 'province_result') {
            if (value == 'Bạn chưa chọn') {
                $('#province_result').html('Vui lòng chọn Tỉnh/Thành phố');
            } else {
                $('#province_result').html('');
            }
        }

        //check selected item of combobox district
        if (field == 'district_result') {
            if (value == '') {
                $('#district_result').html('Vui lòng chọn Quận/Huyện');
            } else {
                $('#district_result').html('');
            }
        }

        //check selected item of combobox ward
        if (field == 'ward_result') {
            if (value == '') {
                $('#ward_result').html('Vui lòng chọn Phường/Xã');
            } else {
                $('#ward_result').html('');
            }
        }

        //check the address detail
        if (field == 'address_result') {
            if (value.length < 4) {
                $('#address_result').html('Địa chỉ phải lớn hơn 4 ký tự');
            } else if (value.length > 40) {
                $('#address_result').html('Địa chỉ không được quá 40 ký tự');
            }
        }
    }

    // thêm hàm để thông báo đặt hàng thành công bằng ajax và sweetalert và trỏ về trang chủ
    $('form').submit(function(e) {
        e.preventDefault();
        var name = $('#name').val();
        var phone = $('#phone').val();
        // var email = $('#email').val();
        var province = $('#province option:selected').text();
        var district = $('#district option:selected').text();
        var ward = $('#ward option:selected').text();
        var address_detail = $('#address_detail').val();
        var cartTotal = $('#cartTotal').val();
        var payment = 1;

        $.ajax({
            url: '/the-coffee/Cart/buyNow',
            type: 'POST',
            data: {
                name: name,
                phone: phone,
                // email: email,
                province_name: province,
                district_name: district,
                ward_name: ward,
                address_detail: address_detail,
                cartTotal: cartTotal,
                payment: payment
            },
            // xử lý kết quả trả về từ server
            success: function(response) {
                response = response.trim();
                switch (response) {
                    // nếu giỏ hàng rỗng 
                    case 'empty':
                        Swal.fire({
                            icon: 'error',
                            title: 'Giỏ hàng của bạn đang trống',
                            text: 'Vui lòng chọn sản phẩm để mua',
                        });
                        break;
                        // nếu số lượng sản phẩm trong giỏ hàng vượt quá số lượng trong kho
                    case 'error':
                        Swal.fire({
                            icon: 'error',
                            title: 'Số lượng sản phẩm trong giỏ hàng vượt quá số lượng trong kho',
                            text: 'Vui lòng kiểm tra lại số lượng sản phẩm trong giỏ hàng',
                        });
                        break;


                    case 'success':
                        Swal.fire({
                            icon: 'success',
                            title: 'Đặt hàng thành công',
                            text: 'Cảm ơn bạn đã mua hàng tại The Coffee',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(function() {
                            window.location.href = '/the-coffee';
                        });
                        break;
                }


            },


        });
    });
</script>