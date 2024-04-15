<!------------------------------------------------------Sticky header---------------------------------------------------------------->
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
                                <div class="user-info">
                                    <img></img>
                                    <h3>
                                        <?php
                                        if (isset($_SESSION['login']['username'])) {
                                            echo $_SESSION['login']['username'];
                                        }
                                        ?>
                                    </h3>
                                </div>
                                <hr>
                                <a href="#" class="sub-menu-link">
                                    <img src="/the-coffee/resources/images/user-detail/profile.png" alt="">
                                    <p>Edit profile</p>
                                    <span></span>
                                </a>
                                <a href="#" class="sub-menu-link">
                                    <img src="/the-coffee/resources/images/user-detail/shopping-cart.png" alt="">
                                    <p>Cart</p>
                                    <span></span>
                                </a>
                                <a href="#" class="sub-menu-link">
                                    <img src="/the-coffee/resources/images/user-detail/setting.png" alt="">
                                    <p>Setting</p>
                                    <span></span>
                                </a>
                                <a href="Login_Regis/Logout" class="sub-menu-link" >
                                    <img src="/the-coffee/resources/images/user-detail/logout.png" alt="">
                                    <p>Logout</p>
                                    <span></span>
                                </a>
                            </div>
                        </div>
                        <div class="sub-menu-wrapper" id="subMenu">
                            <div class="sub-menu">
                                <div class="user-info">
                                    <img></img>
                                    <h3>
                                        <?php
                                        if (isset($_SESSION['login']['username'])) {
                                            echo $_SESSION['login']['username'];
                                        }
                                        ?>
                                    </h3>
                                </div>
                                <hr>
                                <a href="#" class="sub-menu-link">
                                    <img src="/the-coffee/resources/images/user-detail/profile.png" alt="">
                                    <p>Edit profile</p>
                                    <span></span>
                                </a>
                                <a href="#" class="sub-menu-link">
                                    <img src="/the-coffee/resources/images/user-detail/shopping-cart.png" alt="">
                                    <p>Cart</p>
                                    <span></span>
                                </a>
                                <a href="#" class="sub-menu-link">
                                    <img src="/the-coffee/resources/images/user-detail/setting.png" alt="">
                                    <p>Setting</p>
                                    <span></span>
                                </a>
                                <a href="Login_Regis/Logout" class="sub-menu-link" >
                                    <img src="/the-coffee/resources/images/user-detail/logout.png" alt="">
                                    <p>Logout</p>
                                    <span></span>
                                </a>
                            </div>
                        </div>
                    <?php
                    } else if ($_SESSION['login']['status'] == -1) {
                    ?>
                        <li class="nav-item ms-3">
                            <a class="btn btn-black btn-rounded" id="login-btn" style="border: 2px solid black;width:150px;"><i class="fa-solid fa-user icon"></i>Đăng nhập</a>
                        </li>
                        <div class="nav-item ms-3">
                            <a class="btn btn-black btn-rounded" id="regis-btn" style="border: 2px solid black;width:150px;"><i class="fa-solid fa-user icon"></i>Đăng kí</a>
                        </div>
                    <?php
                        unset($_SESSION['login']['status']);
                    } else if ($_SESSION['login']['status'] == 0) {
                    ?>
                        <li class="nav-item ms-3">
                            <a class="btn btn-black btn-rounded" id="login-btn" style="border: 2px solid black;width:150px;"><i class="fa-solid fa-user icon"></i>Đăng nhập</a>
                        </li>
                        <div class="nav-item ms-3">
                            <a class="btn btn-black btn-rounded" id="regis-btn" style="border: 2px solid black;width:150px;"><i class="fa-solid fa-user icon"></i>Đăng kí</a>
                        </div>
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: "Tài khoản của bạn đã ăn global ban"
                            });
                        </script>
                    <?php
                        unset($_SESSION['login']['status']);
                    }
                } else {
                    ?>
                    <li class="nav-item ms-3">
                        <a class="btn btn-black btn-rounded" id="login-btn" style="border: 2px solid black;width:150px;"><i class="fa-solid fa-user icon"></i>Đăng nhập</a>
                    </li>
                    <div class="nav-item ms-3">
                        <a class="btn btn-black btn-rounded" id="regis-btn" style="border: 2px solid black;width:150px;"><i class="fa-solid fa-user icon"></i>Đăng kí</a>
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
        background: #fff;
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
    }

    .user-info h3 {
        font-weight: 500;
    }

    .user-info img {
        width: 60px;
        border-radius: 50%;
        margin-right: 15px;

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

<script>
    const loginBtn = document.getElementById('login-btn');
    const regisBtn = document.getElementById('regis-btn');
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
                        const toggle_registerBtn = document.getElementById('register');
                        const toggle_loginBtn = document.getElementById('login');
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
                                    switch (response) {
                                        case "success": {
                                            window.location.reload();
                                            break;
                                        }
                                        case "notFound": {
                                            $('#responseEmail').html("Email không tồn tại.");
                                            $('#responsePassword').html("");
                                            break;
                                        }
                                        case "banned": {
                                            window.location.reload();
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
                        const toggle_registerBtn = document.getElementById('register');
                        const toggle_loginBtn = document.getElementById('login');
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

                        toggle_registerBtn.addEventListener('click', () => {
                            container.classList.add("active");
                        });
                        toggle_loginBtn.addEventListener('click', () => {
                            container.classList.remove("active");
                        });
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
    // form kiem tra dang ky
    //function validForm
    function validForm() {
        var name = document.getElementById('name').value;
        var email = document.getElementById('email').value;
        var phone = document.getElementById('phone').value;
        var password = document.getElementById('password').value;
        var repassword = document.getElementById('repassword').value;

        if (name == "" || email == "" || phone == "" || password == "" || repssword == "") {
            alert('Vui lòng nhập đầy đủ thông tin');
            document.getElementById('name').focus();
        } else {
            var name_result = document.getElementById('name_result');
            var email_result = document.getElementById('email_result');
            var phone_result = document.getElementById('phone_result');
            var password_result = document.getElementById('password_result');
            var repassword_result = document.getElementById('repassword_result');

            if (
                name_result.innerHTML == "Tên phải lớn hơn 4 ký tự" ||
                email_result.innerHTML == "Email không hợp lệ" ||
                phone_result.innerHTML == "Số điện thoại không hợp lệ" ||
                password_result.innerHTML == "Mật khẩu phải lớn hơn 4 ký tự" ||
                repassword_result.innerHTML == "Mật khẩu không khớp"

            ) {
                alert('Vui lòng nhập đúng các thông tin!');
            } else {
                document.getElementById('regisForm').submit();
            }
        }

    }

    //function validate using jQuery
    function validate(field, value) {
        $.post(
            "/Login_Regis/validation", {
                field: field,
                value: value
            },
            function(data) {
                $("#" + field).html(data);
            }
        );
    }
</script>