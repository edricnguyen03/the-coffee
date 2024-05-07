<div class="container">
    <form action="" method="post">
        <div class="row">
            <div class="col-lg-7 col-md-12">
                <!-- Heading -->
                <h4 class="mb-5">Thông tin giao hàng</h4>
                <!-- Billing Form -->
                <div class="row mb-3 mb-30">

                    <!-- Name -->
                    <div class="col-12">
                        <div class="form-group">
                            <p> <input type="text" class="form-control" id="name" name="name" placeholder="Họ tên" required> </p>
                        </div>
                        <div>
                            <span class="text-danger" style="color:#00ffff"></span>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="col-12">
                        <div class="form-group">
                            <p> <input type="phone" class="form-control" id="phone" name="phone" placeholder="Số điện thoại" required> </p>
                        </div>
                        <div>
                            <span class="text-danger" style="color:#00ffff"></span>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="col-12">
                        <div class="form-group">
                            <p> <input type="email" class="form-control" id="email" name="email" placeholder="Email" required> </p>
                        </div>
                        <div>
                            <span class="text-danger" style="color:#00ffff"></span>
                        </div>
                    </div>

                    <!-- Note -->
                    <div class="col-12">
                        <div class="form-group">
                            <p> <textarea class="form-control" id="note" name="note" placeholder="Ghi chú" rows="3"></textarea> </p>
                        </div>
                    </div>

                    <!-- Province -->
                    <div class="col-12">
                        <div class="form-group">
                            <p> <label for="province">Tỉnh/Thành phố</label> </p>
                            <p> <select class="input_province" name="province" required>
                                    <option value>Bạn chưa chọn</option>
                                    <!-- dung vong lap de in ra cac tinh thanh -->
                                    <?php
                                    foreach ($provinces as $province) {
                                        echo "<option value='$province->id'>$province->name</option>";
                                    }
                                    ?>

                                </select>
                            </p>
                        </div>

                        <div>
                            <span class="text-danger" style="color:#00ffff"></span>
                        </div>
                    </div>

                    <!-- District -->
                    <div class="col-12">
                        <div class="form-group">
                            <p> <label for="district">Quận/Huyện</label> </p>
                            <p> <select class="input_district" name="district" required>
                                    <option value>Bạn chưa chọn</option>
                                    <!-- chon tinh in ra huyen tuong ung php -->

                                </select>
                            </p>
                        </div>

                        <div>
                            <span class="text-danger" style="color:#00ffff"></span>
                        </div>
                    </div>

                    <!-- Ward -->
                    <div class="col-12">
                        <div class="form-group">
                            <p> <label for="ward">Phường/Xã</label> </p>
                            <p> <select class="input_ward" name="ward" required>
                                    <option value>Bạn chưa chọn</option>
                                    <!-- chon huyen in ra xa tuong ung !-->
                                </select>
                            </p>
                        </div>

                        <div>
                            <span class="text-danger" style="color:#00ffff"></span>
                        </div>
                    </div>

                    <!-- Address Detail -->
                    <div class="col-12">
                        <div class="form-group">
                            <p> <input type="text" class="form-control" id="address_detail" name="address_detail" placeholder="Địa chỉ chi tiết" required> </p>
                        </div>

                        <div>
                            <span class="text-danger" style="color:#00ffff"></span>
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
                <div class="card mb-5" id="cart">
                    <div class="cart-priceTotal">
                        <h6>
                            Tổng Đơn Hàng
                            <span class="cartSub">0đ</span>
                        </h6>

                        <div class="shipping-cart">
                            <h6>
                                Phí Vận Chuyển
                                <span>-</span>
                            </h6>
                        </div>
                        <h6>
                            Tổng Tiền
                            <span class="cartTotal">0đ</span>
                        </h6>
                    </div>

                    <div class="cart_select_items">
                        <div class="cart_items">
                            <div class="cart_item">
                                <div class="cart_item_thumb">
                                    <a href="#">
                                        <img src="https://via.placeholder.com/100x100" alt="cart_thumb">
                                    </a>
                                </div>
                                <div class="cart_item_caption">
                                    <a href="#">
                                        <h4 class="product_title">Product Name</h4>
                                    </a>
                                    <span class="number_of_item">Số lượng: 1</span>
                                    <strong class="cart_item_price">100.000đ</strong>
                                    <a href="#" class="cart_item_remove">Xóa</a>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Button -->
                <div class="cart_action">
                    <button type="submit" class="btn btn-checkout">Thanh toán</button>
                </div>


    </form>
    <div>
        <span class="text-danger" style="color:#00ffff"></span>
    </div>


</div>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">