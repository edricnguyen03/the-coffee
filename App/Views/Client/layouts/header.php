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
                    <a class="btn btn-black btn-rounded" id="login" style="border: 2px solid black;"><i class="fa-solid fa-user icon"></i>Đăng nhập</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="inner-loginform" id="loginContent">
    
</div>
<style>
    .inner-loginform {
        /* background-color: #c9d6ff;
          background: linear-gradient(to right, #e2e2e2, #c9d6ff);
          display: fixed ;
          align-items: center;
          justify-content: center;
          flex-direction: column;
          height: 100vh; */
        position: fixed;
        z-index: 999;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        overflow-x: hidden;
        width: 100%;
        height: 100%;
        /* Ngăn chặn cuộn ngang */
        overflow-y: auto;
        /* Cho phép cuộn dọc nếu nội dung quá dài */
        align-items: center;
        justify-content: center;
    }
</style>
<script>
    const loginBtn = document.getElementById("login");

    loginBtn.addEventListener("click", () => {
        var xhttp = new XMLHttpRequest();

        var method = "GET";
        var url = "./App/Views/Client/pages/login-regis.php";
        xhttp.open(method, url, true);
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState === XMLHttpRequest.DONE && xhttp.status === 200) {
                // Nếu kết quả là 200 (OK), gán nội dung của file PHP vào phần tử HTML
                //alert(xhttp.responseText);
                document.getElementById("loginContent").innerHTML = xhttp.responseText;
            }
        };
        // Gửi yêu cầu đến file PHP
        xhttp.send();

    });
</script>