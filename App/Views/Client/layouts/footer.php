<footer class="footer" style="background-color: #262626; color: white;">
    <div class="bg-dark text-white pt5 pb-4">
        <div class="container text-md-left">
            <div class="row text-md-left">
                <!----------------------------------------------------Cột 1------------------------------------------------------->
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3 text-center">
                    <h5 class="text-uppercase text-center mb-4 font-weight-bold text-warning">The Coffee Shop</h5>
                    <p>The Coffee Shop là điểm đến lý tưởng cho những người yêu thưởng thức hương vị tinh tế và độc đáo của cà phê. Chúng tôi cam kết mang lại cho khách hàng trải nghiệm cà phê tốt nhất.</p>
                </div>
                <!----------------------------------------------------Cột 2------------------------------------------------------->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3 text-center">
                    <h5 class="text-uppercase text-center mb-4 font-weight-bold text-warning">Liên Hệ</h5>
                    <p>
                        <i class="fa fa-envelope icon"></i>Admin@gmail.com
                    </p>
                    <p>
                        <i class="fa fa-phone-square icon"></i>1234567890
                    </p>
                    <p>
                        <i class="fa-solid fa-location-dot icon"></i>HCM
                    </p>

                </div>
                <!----------------------------------------------------Cột 3------------------------------------------------------->
                <div class="col-md-3 col-lg-2 mx-auto mt-3 text-center">
                    <h5 class="text-uppercase text-center mb-4 font-weight-bold text-warning">Trang Web</h5>

                    <p>
                        <a href="/the-coffee/" class="text-white" style="text-decoration: none;">Trang Chủ</a>
                    </p>
                    <p>
                        <a href="/the-coffee/product" class="text-white" style="text-decoration: none;">Sản Phẩm</a>
                    </p>
                    <?php
                    if (isset($_SESSION['login']['status'])) {
                        if ($_SESSION['login']['status'] == 1) {
                    ?>
                            <p>
                                <a href="/the-coffee/cart" class="text-white" style="text-decoration: none;">Giỏ Hàng</a>
                            </p>
                            <p>
                                <a href="/the-coffee/profile" class="text-white" style="text-decoration: none;">Tài Khoản</a>
                            </p>
                        <?php
                        } else {
                            unset($_SESSION['login']['status']);
                        }
                    } else {
                        ?>
                        <p>
                            <a class="text-white" style="text-decoration: none; cursor:pointer;" id="footer-sign-up-btn">Đăng kí</a>
                        </p>
                        <p>
                            <a class="text-white" style="text-decoration: none; cursor:pointer;" id="footer-login-btn">Đăng nhập</a>
                        </p>
                    <?php
                    }
                    ?>

                </div>
                <!----------------------------------------------------Cột 4------------------------------------------------------->
                <div class="col-md-4 col-lg-3 mx-auto mt-3 text-center">
                    <h5 class="text-uppercase text-center mb-4 font-weight-bold text-warning">Thành Viên</h5>
                    <p>
                        <a href="https://www.facebook.com/profile.php?id=100027954192211" class="text-white" style="text-decoration: none;"> <i class="fa-solid fa-user icon"></i>Dat Nguyen</a>
                    </p>
                    <p>
                        <a href="https://www.facebook.com/profile.php?id=100009295230748" class="text-white" style="text-decoration: none;"> <i class="fa-solid fa-user icon"></i>Tien Phan</a>
                    </p>

                    <p>
                        <a href="https://www.facebook.com/profile.php?id=100027954192211" class="text-white" style="text-decoration: none;"> <i class="fa-solid fa-user icon"></i>Nam Tran</a>
                    </p>

                    <p>
                        <a href="https://www.facebook.com/trongphu21" class="text-white" style="text-decoration: none;"> <i class="fa-solid fa-user icon"></i>Phu Tran</a>
                    </p>

                    <p>
                        <a href="https://www.facebook.com/profile.php?id=100027954192211" class="text-white" style="text-decoration: none;"> <i class="fa-solid fa-user icon"></i>Huy Le</a>
                    </p>
                </div>
            </div>
            <!----------------------------------------------------Dòng 2------------------------------------------------------->
            <hr class="mb-4">
            <div class="row align-items-center">
                <div class="col-md-7 col-lg-8">
                    <p>Sản phẩm được thực hiện bởi:
                        <span href="" style="text-decoration: none;">
                            <strong class="text-warning">Nhóm 21</strong>
                        </span>
                    </p>
                </div>

                <div class="col-md-5 col-lg-4">
                    <div class="text-end text-md-right">
                        <ul class="list-unstyled list-inline">
                            <li class="list-inline-item">
                                <a href="https://www.facebook.com" class="btn-floating btn-sm text-white" style="font-size: 23px;">
                                    <i class="fab fa-facebook"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://www.google.com" class="btn-floating btn-sm text-white" style="font-size: 23px;">
                                    <i class="fab fa-google-plus"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://www.linkedin.com" class="btn-floating btn-sm text-white" style="font-size: 23px;">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://www.instagram.com" class="btn-floating btn-sm text-white" style="font-size: 23px;">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!----------------------------------------------------hết------------------------------------------------------->
        </div>
    </div>
</footer>

<script>
    const footerLoginBtn = document.getElementById('footer-login-btn');
    const footerSignUpBtn = document.getElementById('footer-sign-up-btn');
    if (loginBtn != null) {
        footerLoginBtn.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth' // Tạo hiệu ứng cuộn mượt
            });
            loginBtn.dispatchEvent(new Event('click'));
        })
    }
    if (regisBtn != null) {
        footerSignUpBtn.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth' // Tạo hiệu ứng cuộn mượt
            });
            regisBtn.dispatchEvent(new Event('click'));
        })
    }
</script>