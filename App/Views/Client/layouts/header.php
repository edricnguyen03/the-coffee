<!------------------------------------------------------Sticky header---------------------------------------------------------------->
<nav class="navbar sticky-top navbar-expand-lg" style="background: linear-gradient(to right, #ffad3d, #fb8d17); z-index:10;">
    <div class="container-fluid px-5 py-2">
        <div class="col-md-4 col-sm-12 justify-content-small-center">
            <a href="home"><img src="./resources/images/header-logo.png" style="width: 10%;"></a>
        </div>
        <div class="col-md-8 col-sm-12">
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link mx-2" href="#!"><i class="fa-solid fa-house icon"></i>Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2" href="/the-coffee/product"><i class="fa-brands fa-shopify icon"></i>Sản phẩm</a>
                </li>
                <?php
                if (!isset($_SESSION['login']['status']) || !$_SESSION['login']['status']) {
                ?>
                    <li class="nav-item ms-3">
                        <a class="btn btn-black btn-rounded" id="login-btn" style="border: 2px solid black;width:150px;"><i class="fa-solid fa-user icon"></i>Đăng nhập</a>
                    </li>
                    <div class="nav-item ms-3">
                        <a class="btn btn-black btn-rounded" id="regis-btn" style="border: 2px solid black;width:150px;"><i class="fa-solid fa-user icon"></i>Đăng kí</a>
                    </div>
                <?php
                } else {
                ?>
                    <div class="nav-item ms-3">
                        <a class="btn btn-black btn-rounded" id="logout-btn" href="Login_Regis/Logout" style="border: 2px solid black;width:150px;"><i class="fa-solid fa-user icon"></i>Đăng xuất</a>
                    </div>
                    <div class="nav-item ms-3">
                        <a class="btn btn-black btn-rounded" id="user-detail-btn" style="border: 2px solid black;"><i class="bi bi-person-lines-fill"></i>User</a>
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
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    const loginBtn = document.getElementById('login-btn');
    const regisBtn = document.getElementById('regis-btn');
    const logoutBtn = document.getElementById('logout-btn');
    const userDetailBtn = document.getElementById('user-detail-btn');
    const inner_login_regis_form = document.getElementById('login-regis-form');
    const login_regis_overlay = document.getElementById('login-regis-overlay');
    document.addEventListener('DOMContentLoaded', function() {
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
                            var username = document.getElementById('loginUsername').value;
                            var password = document.getElementById('loginPassword').value;
                            document.getElementById('loginForm').submit();
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
                            var username = dopcument.getElementById('loginUsername').value;
                            var password = document.getElementById('loginPassword').value;
                            document.getElementById('loginForm').submit();
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
    //
</script>