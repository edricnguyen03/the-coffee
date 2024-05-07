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
                                <p> <input type="text" class="form-control" id="name" name="name" placeholder="Họ tên" onblur="validation('name_result', this.value)" required> </p>
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
                        <div class="col-12">
                            <div class="form-group">
                                <p> <input type="email" class="form-control" id="email" name="email" placeholder="Email" onblur="validation('email_result', this.value)"> </p>
                            </div>
                            <div>
                                <span class="text-danger" id="email_result"></span>
                            </div>
                        </div>

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
                                        <span class="number_of_item">Số lượng: <input type="number" name="soLuong" class="product_quantity" min="1" max="' . $cartProduct->stock . '" value="' . $cartProduct->quantity  . '"> </span>
                                        <strong class=" cart_item_price">' . $cartProduct->price . '</strong>

                                        <button class="text-danger cart_item_remove" id="delete" onclick="deleteProductInCart(' .  $_SESSION['login']['id'] . ' , ' . $cartProduct->idProduct . ')">Xóa</button>

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
    //add a function to remove an item out a cart and reload the page
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

    //add a function to check the quantity input from user
    function checkQuantityInput(event) {
        try {
            var quantity = parseInt(event.target.value);
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Số lượng không hợp lệ',
                text: "Số lượng phải là số nguyên",
            });
            event.target.value = 1;
            return;
        }
        var stock = parseInt(event.target.getAttribute('max'));
        if (quantity > stock || quantity < 1 || quantity == "") {
            Swal.fire({
                icon: 'error',
                title: 'Số lượng không hợp lệ',
                text: "Số lượng phải nằm trong khoảng từ 1 đến " + stock,
            });
            event.target.value = 1;
            return;
        }
    }

    //add an event listener to check all quantity inputs
    document.addEventListener('DOMContentLoaded', function() {
        var quantityInputs = document.querySelectorAll('.product_quantity');
        quantityInputs.forEach(function(input) {
            input.addEventListener('input', checkQuantityInput);
        });
    });

    //add a function to calculate the total price of the cart
    function calculateTotalPrice() {
        var quantityInputs = document.querySelectorAll('.product_quantity');
        var currentTotal = 0;

        quantityInputs.forEach(function(input) {
            if (input.value.includes('.')) {
                input.value = 0;
            }
            var quantity = parseInt(input.value);
            var priceElement = input.closest('.cart_item').querySelector('.cart_item_price');
            var price = parseInt(priceElement.innerText);
            var total = quantity * price;
            currentTotal += total;
        });
        if(isNaN(currentTotal)){
            currentTotal = 0;
        }
        document.querySelector('.cartSub').innerText = formatCurrency(currentTotal);
        document.querySelector('.cartTotal').innerText = formatCurrency(currentTotal);
    }

    //add an event listener to calculate the total price of the cart
    document.addEventListener('DOMContentLoaded', function() {
        var quantityInputs = document.querySelectorAll('.product_quantity');
        quantityInputs.forEach(function(input) {
            input.addEventListener('input', calculateTotalPrice);
        });
        calculateTotalPrice();
    });

    //add a jQuery code to pass the value of total price to the hidden input field
    $('.product_quantity').on('input', function() {
        // Calculate the new total price
        var newTotalPrice = calculateTotalPrice();

        // Update the cartTotal span
        $('.cartTotal').text(newTotalPrice);

        // Update the hidden input field
        $('#cartTotal').val(newTotalPrice);
    });

    //a function to format the price to vnd
    function formatCurrency(number) {
        return new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }).format(number);
    }

    //function validation shipping information
    function validation(field, value) {
        //check the name
        if (field == 'name_result') {
            if (value.length < 4) {
                $('#name_result').html('Tên phải lớn hơn 4 ký tự');
            } else if (value.length > 40) {
                $('#name_result').html('Tên không được quá 40 ký tự');
            } else if (!/^[a-zA-Z ]+$/.test(value)) {
                $('#name_result').html('Tên không được chứa ký tự đặc biệt hoặc số');
            } else {
                $('#name_result').html('');
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

        //check the email
        if (field == 'email_result') {
            if (value == '') {
                $('#email_result').html('');
            } else {
                if (!/([\w\-]+\@[\w\-]+\.[\w\-]+)/.test(value)) {
                    $('#email_result').html('Email không hợp lệ');
                } else if (value.length > 40) {
                    $('#email_result').html('Email dài quá 40 ký tự');
                } else {
                    $('#email_result').html('');
                }
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
</script>