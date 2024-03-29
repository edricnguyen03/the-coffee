<!------------------------------------------------------Sticky header---------------------------------------------------------------->
<nav class="navbar sticky-top navbar-expand-lg " style="background: linear-gradient(to right, #ffad3d, #fb8d17)">
    <div class="container-fluid px-5 py-2">
        <div class="col-md-6 col-sm-12 justify-content-small-center">
            <a href="home"><img src="./resources/images/header-logo.png" style="width: 10%;"></a>
        </div>
        <div class="col-md-6 col-sm-12">
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link mx-2" href="home"><i class="fa-solid fa-house icon"></i>Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2" href="#!"><i class="fa-solid fa-list icon"></i>Danh mục</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2" href="#!"><i class="fa-brands fa-shopify icon"></i>Sản phẩm</a>
                </li>
                <li class="nav-item ms-3">
                    <!-- <a class="btn btn-black btn-rounded" id="login-btn" style="border: 2px solid black;"><i class="fa-solid fa-user icon"></i>Đăng nhập</a> -->
                    <div class="dropdown">
                        <button class="btn btn-black btn-rounded dropbtn"></button>
                        <div id="login-regis" class="dropdown-content">
                            <a href="login" class="btn btn-black btn-rounded" id="login-btn" style="border: 2px solid black;"><i class="fa-solid fa-user icon"></i>Đăng nhập</a>
                            <a href="register" class="btn btn-black btn-rounded" id="regis-btn" style="border: 2px solid black;"><i class="fa-solid fa-user icon"></i>Đăng kí</a>
                        </div>
                    </div>
                </li>
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

    /* */
    /* Style the dropdown button */
    .dropbtn {
        background-color: #3498DB;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
        cursor: pointer;
    }

    /* Dropdown button on hover & focus */
    .dropbtn:hover,
    .dropbtn:focus {
        background-color: #2980B9;
    }

    /* The container <div> - needed to position the dropdown content */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    /* Dropdown Content (Hidden by Default) */
    .dropdown-content {
        display: flex;
        position: absolute;
        background-color: transparent;
        align-items: center;
        justify-content: center;
        min-width: 160px;
        z-index: 1;
        right:0;
    }
    /* Change color of dropdown links on hover */
    .dropdown-content a:hover {
        background-color: #ddd;
    }

    /* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
    .show {
        display: block;
    }
</style>
<script>
    const loginBtn = document.getElementById('login-btn');
    const regisBtn = document.getElementById('regis-btn');
    const inner_login_regis_form = document.getElementById('login-regis-form');
    const login_regis_overlay = document.getElementById('login-regis-overlay');
    document.addEventListener('DOMContentLoaded', function() {
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
                    const form_registerBtn = document.getElementById('register');
                    const form_loginBtn = document.getElementById('login');
                    form_registerBtn.addEventListener('click', () => {
                        container.classList.add("active");
                    });
                    form_loginBtn.addEventListener('click', () => {
                        container.classList.remove("active");
                    });
                }
            }
            xhttp.send();

        });

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
    //Script for dropdown
    // Function to show the dropdown menu on hover
    document.querySelector('.dropdown').addEventListener('mouseenter', function() {
        var dropdownContent = document.getElementById("login-regis");
        dropdownContent.classList.add("show");
    });

    // Function to hide the dropdown menu when mouse leaves
    document.querySelector('.dropdown').addEventListener('mouseleave', function() {
        var dropdownContent = document.getElementById("login-regis");
        dropdownContent.classList.remove("show");
    });

    // Close the dropdown menu if the user clicks outside of it
    window.addEventListener('click', function(event) {
        if (!event.target.matches('.dropdown')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    });
</script>