<!------------------------------------------------------Sticky header---------------------------------------------------------------->
<?php
require_once './App/Models/Auth.php';

?>
<nav class="navbar sticky-top navbar-expand-lg" style="background: linear-gradient(to right, #ffad3d, #fb8d17); z-index:10;">
    <div class="container-fluid px-5 py-2">
        <div class="col-md-4 col-sm-12 justify-content-small-center">
            <a href="" id="home-logo"><img src="/the-coffee/resources/images/header-logo.png" style="width: 10%;"></a>
        </div>
        <div class="col-md-8 col-sm-12">
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link mx-2" href="home"><i class="fa-solid fa-house icon"></i>Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2" href="/the-coffee/product"><i class="fa-brands fa-shopify icon"></i>Sản phẩm</a>
                </li>
                <?php
                if (isset($_SESSION['login']['status'])) {
                    if ($_SESSION['login']['status'] == 1) {
                ?>
                        <div class="nav-item ms-3">
                            <a class="btn btn-black btn-rounded" id="user-detail-btn" style="border: 2px solid black;"><i class="fa-regular fa-circle-user icon"></i>User</a>
                        </div>
                        <div class="sub-menu-wrapper" id="subMenu">
                            <div class="sub-menu">
                                <div class="user-info text-center">
                                    <h5>
                                        <?php
                                        if (isset($_SESSION['login']['username'])) {
                                            echo $_SESSION['login']['username'];
                                        }
                                        ?>
                                    </h5>
                                </div>
                                <hr>
                                <a href="/the-coffee/profile" class="sub-menu-link" id="user-profile-button">
                                    <img src="/the-coffee/resources/images/user-detail/profile.png" alt="">
                                    <p>Tài khoản</p>
                                    <span></span>
                                </a>
                                <?php

                                if (Auth::hasAdminPermission($_SESSION['login']['id']) == true) {
                                ?>
                                    <a href="admin/dashboard/" class="sub-menu-link">
                                        <img src="/the-coffee/resources/images/user-detail/setting.png" alt="">
                                        <p>Cài đặt</p>
                                        <span></span>
                                    </a>
                                <?php
                                } else {
                                ?>
                                    <a href="/the-coffee/cart" class="sub-menu-link">
                                        <img src="/the-coffee/resources/images/user-detail/shopping-cart.png" alt="">
                                        <p>Giỏ hàng</p>
                                        <span></span>
                                    </a>
                                    <a href="/the-coffee/orders" class="sub-menu-link">
                                        <img src="/the-coffee/resources/images/user-detail/order.png" alt="">
                                        <p>Đơn hàng</p>
                                        <span></span>
                                    </a>
                                <?php
                                }
                                ?>
                                <a href="Login_Regis/Logout" class="sub-menu-link">
                                    <img src="/the-coffee/resources/images/user-detail/logout.png" alt="">
                                    <p>Đăng xuất</p>
                                    <span></span>
                                </a>
                            </div>
                        </div>
                    <?php
                    } else if ($_SESSION['login']['status'] == -1) {
                    ?>
                        <li class="nav-item ms-3">
                            <a class="btn btn-black btn-rounded" id="header-login-btn" style="border: 2px solid black;width:150px;"><i class="fa-solid fa-user icon"></i>Đăng nhập</a>
                        </li>
                        <div class="nav-item ms-3">
                            <a class="btn btn-black btn-rounded" id="header-regis-btn" style="border: 2px solid black;width:150px;"><i class="fa-solid fa-user icon"></i>Đăng kí</a>
                        </div>
                    <?php
                        unset($_SESSION['login']['status']);
                    } else if ($_SESSION['login']['status'] == 0) {
                    ?>
                        <li class="nav-item ms-3">
                            <a class="btn btn-black btn-rounded" id="header-login-btn" style="border: 2px solid black;width:150px;"><i class="fa-solid fa-user icon"></i>Đăng nhập</a>
                        </li>
                        <div class="nav-item ms-3">
                            <a class="btn btn-black btn-rounded" id="header-regis-btn" style="border: 2px solid black;width:150px;"><i class="fa-solid fa-user icon"></i>Đăng kí</a>
                        </div>
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: "Tài khoản của bạn đã bị khóa !"
                            });
                        </script>
                    <?php
                        unset($_SESSION['login']['status']);
                    }
                } else {
                    ?>
                    <li class="nav-item ms-3">
                        <a class="btn btn-black btn-rounded" id="header-login-btn" style="border: 2px solid black;width:150px;"><i class="fa-solid fa-user icon"></i>Đăng nhập</a>
                    </li>
                    <div class="nav-item ms-3">
                        <a class="btn btn-black btn-rounded" id="header-regis-btn" style="border: 2px solid black;width:150px;"><i class="fa-solid fa-user icon"></i>Đăng kí</a>
                    </div>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
<div id="login-regis-overlay" class="login_regis_overlay"></div>
<div id="login-regis-form"></div>
<style>
    #login-regis-overlay {
        background-color: rgba(0, 0, 0, 0.5);
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: none;
        z-index: 1111;
    }

    #login-regis-form {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1112;
    }

    .sub-menu-wrapper {
        position: absolute;
        top: 100%;
        right: 2%;
        width: 220px;
        max-height: 0px;
        overflow: hidden;
        transition: max-height 0.5s;
    }

    .sub-menu-wrapper.open-menu {
        max-height: 400px;
    }

    .sub-menu {
        background: #f8be71;
        border-radius: 5px;
        padding: 20px;
        margin: 10px;
    }

    .sub-menu hr {
        border: 0;
        height: 1px;
        width: 100%;
        background: #ccc;
        margin: 15px 0 10px;
    }

    .user-info {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .user-info h5 {
        font-weight: 500;
    }

    .sub-menu-link {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: #525252;
        margin: 10px 0
    }

    .sub-menu-link p {
        width: 100%;
        margin-bottom: 0px;
    }

    .sub-menu-link img {
        width: 35px;
        background: #e5e5e5;
        border-radius: 50%;
        padding: 8px;
        margin-right: 15px;
    }

    .sub-menu-link span {
        font-size: 20px;
        transition: transform 0.5s;
    }

    .sub-menu-link:hover span {
        transform: translateX(5px);
    }

    .sub-menu-link:hover p {
        font-weight: 600;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const loginBtn = document.getElementById('header-login-btn');
    const regisBtn = document.getElementById('header-regis-btn');
    const logoutBtn = document.getElementById('logout-btn');
    const userDetailBtn = document.getElementById('user-detail-btn');
    const inner_login_regis_form = document.getElementById('login-regis-form');
    const login_regis_overlay = document.getElementById('login-regis-overlay');
    <?php
    if (isset($_SESSION['login']['status']) && $_SESSION['login']['status'] == true) {
    ?>
        var subMenu = document.getElementById('subMenu');
        userDetailBtn.addEventListener('click', function() {
            subMenu.classList.toggle("open-menu");
        });
    <?php
    }
    ?>
    document.addEventListener('DOMContentLoaded', function() {
        var homeLogo = document.getElementById('home-logo');
        homeLogo.addEventListener('click', function() {
            event.preventDefault();
            window.location.href = "/the-coffee/home";
        });
        if (loginBtn != null) {
            loginBtn.addEventListener('click', () => {
                event.preventDefault();
                login_regis_overlay.style.display = 'block';
                var xhttp = new XMLHttpRequest();
                var method = "GET";
                var url = "./App/Views/Client/pages/login-regis.php";
                xhttp.open(method, url, true);
                xhttp.onreadystatechange = function() {
                    if (xhttp.readyState === XMLHttpRequest.DONE && xhttp.status === 200 && this.readyState === 4) {
                        inner_login_regis_form.innerHTML = xhttp.responseText;
                        inner_login_regis_form.style.display = "block";
                        document.body.style.overflow = "hidden";

                        const container = document.getElementById('login-wrapper');
                        // hai nut chuyen form dang nhap va dang ky
                        const toggle_registerBtn = document.getElementById('register');
                        const toggle_loginBtn = document.getElementById('login');
                        // hai nut xac nhan dang nhap va dang ky
                        const form_loginBtn = document.getElementById('loginButton');
                        const form_registerBtn = document.getElementById('registerButton');

                        form_loginBtn.addEventListener('click', () => {
                            event.preventDefault();
                            var username = document.getElementById('loginUsername').value;
                            var password = document.getElementById('loginPassword').value;
                            if (username.trim() == "" && password.trim() == "") {
                                $('#responsePassword').html('Vui lòng nhập đầy đủ mật khẩu.');
                                $('#responseEmail').html('Vui lòng nhập đầy đủ tài khoản.');
                                return;
                            }
                            if (username.trim() == "") {
                                $('#responseEmail').html('Vui lòng nhập đầy đủ tài khoản.');
                                $('#responsePassword').html('');
                                return;
                            }
                            if (password.trim() == "") {
                                $('#responsePassword').html('Vui lòng nhập đầy đủ mật khẩu.');
                                $('#responseEmail').html('');
                                return;
                            }
                            $.ajax({
                                type: 'POST',
                                url: '/the-coffee/Login_Regis/Login', // replace with your login endpoint
                                data: {
                                    username: username,
                                    password: password
                                },
                                success: function(response) {
                                    response = response.trim();
                                    console.log(response);
                                    switch (response) {
                                        case "success": {
                                            // an form dang nhap va lop phu cua no
                                            login_regis_overlay.style.display = 'none';
                                            inner_login_regis_form.style.display = 'none';

                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Thành công',
                                                text: 'Đăng nhập thành công !',
                                                showConfirmButton: false,
                                                timer: 2000
                                            }).then(function() {
                                                window.location.href = "/the-coffee/";
                                            });

                                            break;
                                        }
                                        case "notFound": {
                                            $('#responseEmail').html("Email không tồn tại.");
                                            $('#responsePassword').html("");
                                            break;
                                        }
                                        case "banned": {
                                            // an form dang nhap va lop phu cua no
                                            login_regis_overlay.style.display = 'none';
                                            inner_login_regis_form.style.display = 'none';

                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Error',
                                                text: 'Tài khoản của bạn đã bị khóa !',
                                                showConfirmButton: false,
                                                timer: 2000
                                            }).then(function() {
                                                window.location.href = "/the-coffee/";
                                            });

                                            break;
                                        }
                                        case "wrongPassword": {
                                            $('#responsePassword').html("Sai mật khẩu.");
                                            $('#responseEmail').html("");
                                            break;
                                        }
                                    }
                                }
                            });
                        });

                        toggle_registerBtn.addEventListener('click', () => {
                            container.classList.add("active");
                        });
                        toggle_loginBtn.addEventListener('click', () => {
                            container.classList.remove("active");
                        });

                    }
                }
                xhttp.send();

            });
        }

        // xu ly su kien click vao nut dang ky
        if (regisBtn != null) {
            regisBtn.addEventListener('click', () => {
                event.preventDefault();
                login_regis_overlay.style.display = 'block';
                var xhttp = new XMLHttpRequest();
                var method = "GET";
                var url = "./App/Views/Client/pages/login-regis.php";
                xhttp.open(method, url, true);
                xhttp.onreadystatechange = function() {
                    if (xhttp.readyState === XMLHttpRequest.DONE && xhttp.status === 200 && this.readyState === 4) {
                        inner_login_regis_form.innerHTML = xhttp.responseText;
                        inner_login_regis_form.style.display = "block";
                        document.body.style.overflow = "hidden";

                        const container = document.getElementById('login-wrapper');
                        // hai nut chuyen form dang nhap va dang ky
                        const toggle_registerBtn = document.getElementById('register');
                        const toggle_loginBtn = document.getElementById('login');
                        // hai nut xac nhan dang nhap va dang ky
                        const form_loginBtn = document.getElementById('loginButton');
                        const form_registerBtn = document.getElementById('registerButton');


                        form_loginBtn.addEventListener('click', () => {
                            var username = document.getElementById('loginUsername').value;
                            var password = document.getElementById('loginPassword').value;

                            $.ajax({
                                type: 'POST',
                                url: '/the-coffee/Login_Regis/Login', // replace with your login endpoint
                                data: {
                                    username: username,
                                    password: password
                                },
                                success: function(response) {
                                    switch (response) {
                                        case "success": {
                                            window.location.reload();
                                            break;
                                        }
                                        case "notFound": {
                                            $('#responseEmail').html("Email address incorrect.");
                                            $('#responsePassword').html("");
                                            break;
                                        }
                                        case "banned": {
                                            window.location.reload();
                                            break;
                                        }
                                        case "wrongPassword": {
                                            $('#responsePassword').html("Incorrect password.");
                                            $('#responseEmail').html("");
                                            break;
                                        }
                                    }
                                }
                            });

                        });

                        //xu ly form dang ky
                        form_registerBtn.addEventListener('click', () => {
                            event.preventDefault();
                            var username = document.getElementById('name').value;
                            var email = document.getElementById('email').value;
                            var password = document.getElementById('password').value;
                            var repassword = document.getElementById('repassword').value;

                            // kiem tra xem cac truong co bi trong hay khong
                            if (username == "" && email == "" && password == "" && repassword == "") {
                                $('#name_result').html('Vui lòng nhập tên.');
                                $('#email_result').html('Vui lòng nhập email.');
                                $('#password_result').html('Vui lòng nhập mật khẩu.');
                                $('#repassword_result').html('Vui lòng nhập lại mật khẩu.');
                                return;
                            } else {
                                // kiem tra ten co trong khong
                                if (username.trim() == "") {
                                    $('#name_result').html('Vui lòng nhập tên.');
                                    $('#email_result').html('');
                                    $('#password_result').html('');
                                    $('#repassword_result').html('');
                                    return;
                                } else {

                                    // kiem tra ten co hop le khong
                                    // ten phai tu 4 ki tu tro len
                                    if (username.trim().length < 4) {
                                        $('#name_result').html('Tên phải lớn hơn 4 ký tự.');
                                        $('#email_result').html('');
                                        $('#password_result').html('');
                                        $('#repassword_result').html('');
                                        return;
                                    }

                                    // ten phai duoi 40 ki tu
                                    else if (username.trim().length > 40) {
                                        $('#name_result').html('Tên phải nhỏ hơn 40 ký tự.');
                                        $('#email_result').html('');
                                        $('#password_result').html('');
                                        $('#repassword_result').html('');

                                        return;
                                    }
                                    // kiem tra ten co chua khoang trang o dau va cuoi chuoi hay khong
                                    else if (username.trim() !== username) {
                                        $('#name_result').html('Tên không được chứa khoảng trắng ở đầu và cuối.');
                                        $('#email_result').html('');
                                        $('#password_result').html('');
                                        $('#repassword_result').html('');
                                        return;
                                    }
                                    // kiem tra ten co chua so hoac ki tu dac biet hay khong
                                    else if (!/^[\p{L} ]*$/gu.test(username) || /\d/.test(username)) {
                                        $('#name_result').html('Tên không được chứa ký tự đặc biệt hoặc số.');
                                        $('#email_result').html('');
                                        $('#password_result').html('');
                                        $('#repassword_result').html('');
                                        return;
                                    } else {
                                        $('#name_result').html('');
                                    }
                                }

                                // kiem tra email co trong khong
                                if (email.trim() == "") {
                                    $('#email_result').html('Vui lòng nhập email.');
                                    $('#name_result').html('');
                                    $('#password_result').html('');
                                    $('#repassword_result').html('');
                                    return;
                                } else {
                                    // kiem tra email co hop le khong (duoi email tu 2 den 3 ki tu)
                                    if (!/^[a-zA-Z0-9]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$/.test(email)) {
                                        $('#email_result').html('Email không hợp lệ.');
                                        $('#name_result').html('');
                                        $('#password_result').html('');
                                        $('#repassword_result').html('');
                                        return;
                                    }
                                    // kiem tra email co dai qua 40 ki tu hay khong
                                    else if (!/^[a-zA-Z0-9]{1,40}@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$/.test(email)) {
                                        $('#email_result').html('Email dài quá 40 ký tự.');
                                        $('#name_result').html('');
                                        $('#password_result').html('');
                                        $('#repassword_result').html('');
                                        return;
                                    }

                                    // kiem tra email dung dinh dang hay khong (gioi han mail vn)
                                    else if (!email.includes('.com') && !/^[a-zA-Z0-9]+@[a-zA-Z0-9.-]+\.vn$/.test(email) && !email.includes('.org') && !email.includes(' ')) {
                                        $('#email_result').html('Email không hợp lệ.');
                                        $('#name_result').html('');
                                        $('#password_result').html('');
                                        $('#repassword_result').html('');
                                        return;
                                    } else {
                                        $('#email_result').html('');
                                    }
                                }

                                // kiem tra password co trong khong
                                if (password.trim() == "") {
                                    $('#password_result').html('Vui lòng nhập mật khẩu.');
                                    $('#name_result').html('');
                                    $('#email_result').html('');
                                    $('#repassword_result').html('');
                                    return;
                                } else {
                                    // kiem tra password co hop le khong
                                    // password phai tu 4 den 10 ki tu
                                    if (password.trim().length < 4 || password.trim().length > 10) {
                                        $('#password_result').html('Mật khẩu phải từ 4 đến 10 ký tự.');
                                        $('#name_result').html('');
                                        $('#email_result').html('');
                                        $('#repassword_result').html('');
                                        return;
                                    }
                                    // kiem tra mat khau co chua khoang trang o 2 dau khong
                                    else if (password.trim() !== password) {
                                        $('#password_result').html('Mật khẩu không được chứa khoảng trắng ở đầu và cuối.');
                                        $('#name_result').html('');
                                        $('#email_result').html('');
                                        $('#repassword_result').html('');
                                        return;
                                    }

                                    // kiem tra mat khau co chua khoang trang hay khong
                                    else if (password.includes(' ')) {
                                        $('#password_result').html('Mật khẩu không được chứa khoảng trắng.');
                                        $('#name_result').html('');
                                        $('#email_result').html('');
                                        $('#repassword_result').html('');
                                        return;
                                    } else {
                                        $('#password_result').html('');
                                    }
                                }

                                // kiem tra repassword co trong khong
                                if (repassword.trim() == "") {
                                    $('#repassword_result').html('Vui lòng nhập lại mật khẩu.');
                                    $('#name_result').html('');
                                    $('#email_result').html('');
                                    $('#password_result').html('');
                                    return;
                                } else {
                                    // kiem tra repassword co hop le khong
                                    // repassword phai trung voi password
                                    if (repassword.trim() !== password.trim()) {
                                        $('#repassword_result').html('Mật khẩu không khớp.');
                                        $('#name_result').html('');
                                        $('#email_result').html('');
                                        $('#password_result').html('');
                                        return;
                                    } else {
                                        $('#repassword_result').html('');
                                    }
                                }


                            }

                            //su dung ajax de gui du lieu len server
                            $.ajax({
                                type: 'POST',
                                url: '/the-coffee/Login_Regis/Register', // replace with your register endpoint
                                data: {
                                    name: username,
                                    email: email,
                                    password: password,
                                    repassword: repassword
                                },
                                success: function(response) {
                                    response = response.trim();
                                    switch (response) {

                                        case 'notmatch':
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Error',
                                                text: 'Mật khẩu không khớp !'
                                            });
                                            break;


                                        case 'fail':
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Error',
                                                text: 'Đăng kí thất bại !'
                                            });
                                            break;

                                        case 'success':
                                            // an form dang ki va lop phu cua no
                                            login_regis_overlay.style.display = 'none';
                                            inner_login_regis_form.style.display = 'none';

                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Thành công',
                                                text: 'Đăng kí thành công !',
                                                showConfirmButton: false,
                                                timer: 2000

                                            }).then(function() {

                                                window.location.href = "/the-coffee/";
                                            });
                                            break;


                                    }
                                }
                            });

                        });


                        toggle_registerBtn.addEventListener('click', () => {
                            container.classList.add("active");
                        });
                        toggle_loginBtn.addEventListener('click', () => {
                            container.classList.remove("active");
                        });

                        //khi an vao nut dang ki thi form tu overlay trang dang ki
                        toggle_registerBtn.click();

                    }
                }
                xhttp.send();
            });
        }

    });
    login_regis_overlay.addEventListener('click', function(event) {
        closeLoginRegisForm();
    });

    inner_login_regis_form.addEventListener('click', function(event) {
        event.stopPropagation();
    });

    function closeLoginRegisForm() {
        login_regis_overlay.style.display = 'none';
        inner_login_regis_form.style.display = 'none';
        document.body.style.overflow = 'auto';
    };
</script>