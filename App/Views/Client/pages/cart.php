<section>
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
                                <p> <textarea class="form-control" id="note" name="note" placeholder="Ghi chú" rows="2"></textarea> </p>
                            </div>
                        </div>

                        <!-- Province -->
                        <div class="col-12">
                            <div class="form-group">
                                <p> <label for="province">Tỉnh/Thành phố</label> </p>
                                <p> <select class="input_search province" id="province" required>
                                        <option value>Bạn chưa chọn</option>
                                        <!-- dung vong lap de in ra cac tinh thanh -->


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
                                <p> <select class="input_search district" id="district" required>

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
                                <p> <select class="input_search ward" id="ward" required>

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
                    <div class="cart" id="cart" style="border:none">
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

                            ?>

                                <div class="cart_item">
                                    <div class="ca rt_item_thumb">
                                        <a href="#">
                                            <img style="object-fit: cover;width: 100%; height: 100%;" src="./resources/images/products/<?php echo $cartProduct->thumb_image ?>" />
                                        </a>
                                    </div>
                                    <div class="cart_item_caption">
                                        <a href="#">
                                            <h4 class="product_title"><?php echo $cartProduct->name ?></h4>
                                        </a>
                                        <span class="number_of_item">Số lượng: <?php echo $cartProduct->quantity ?></span>
                                        <strong class="cart_item_price"><?php echo $cartProduct->price ?></strong>
                                        <a href="#" class="text-danger cart_item_remove" id="delete">Xóa</a>


                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>

                    </div>
                    <!-- Button -->
                    <div class="cart_action">
                        <button type="submit" class="btn-checkout">Thanh toán</button>
                    </div>


        </form>

    </div>

</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script src="./resources/js/filter-province.js"></script>