<!-- <?php if ($type == 'register') echo 'active'; ?> -->
<div class="login-container" id="login-container">
     <div class="loginform-container sign-up">
          <form id="regForm" action="validation.php">
               <h1>Tạo Tài Khoản</h1>
               <input type="text" id="name" name="name" placeholder="Tên" onblur="validate('name_result', this.value)">
               <center>
                    <div class="text-danger" id="name_result"></div>
               </center>

               <input type="email" id="email" name="email" placeholder="Email" onblur="validate('email_result', this.value)">
               <center>
                    <div class="text-danger" id="email_result"></div>
               </center>

               <input type="text" id="phone" name="phone" placeholder="Số điện thoại" onblur="validate('phone_result', this.value)">
               <center>
                    <div class="text-danger" id="phone_result"></div>
               </center>

               <input type="password" id="password" name="password" placeholder="Mật khẩu" onblur="validate('password_result', this.value)">
               <center>
                    <div class="text-danger" id="password_result"></div>
               </center>

               <input type="password" id="repassword" name="repassword" placeholder="Nhập lại mật khẩu" onblur="validate('repassword_result', this.value)">
               <center>
                    <div class="text-danger" id="repassword_result"></div>
               </center>
               <!-- button trong form dang ky -->
               <button id="register-btn" name="register-btn" onclick="validForm()">Đăng Kí</button>
          </form>
     </div>
     <div class="loginform-container sign-in">
          <form>
               <h1>Đăng Nhập</h1>
               <input type="email" placeholder="Email">
               <input type="password" placeholder="Mật khẩu">
               <a href="#">Quên mật khẩu ?</a>
               <button>Đăng Nhập</button>
          </form>
     </div>
     <div class="toggle-container">
          <div class="toggle">
               <div class="toggle-panel toggle-left">
                    <h1>Xin chào</h1>
                    <p>Đăng kí tài khoản với thông tin cá nhân của bạn để trải nghiệm tất cả tính năng trên trang web </p>
                    <!-- button chuyen qua form dang nhap -->
                    <button class="hidden" id="login">Đăng nhập</button>
               </div>
               <div class="toggle-panel toggle-right">
                    <h1>Chào mừng trở lại !</h1>
                    <p>Đăng nhập để tiếp tục</p>
                    <!-- button chuyen qua form dang ky -->
                    <button class="hidden" id="register">Đăng kí</button>
               </div>
          </div>
     </div>
     <script>
          const container = document.getElementById('login-container');
          const registerBtn = document.getElementById('register');
          const loginBtn = document.getElementById('login');
          registerBtn.addEventListener('click', () => {
               alert('welcome');
               container.classList.add("active");
          });

          loginBtn.addEventListener('click', () => {
               alert('welcome');
               container.classList.remove("active");
          });
     </script>
</div>
<style>
     @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

     * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
          font-family: 'Montserrat', sans-serif;
     }

     /* body {
          background-color: #c9d6ff;
          background: linear-gradient(to right, #e2e2e2, #c9d6ff);
          display: flex;
          align-items: center;
          justify-content: center;
          flex-direction: column;
          height: 100vh;
     } */

     .login-container {
          /* display:fixed;
          top:0;
          left:0;
          z-index: 999; */


          background-color: #fff;
          border-radius: 30px;
          box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
          position: relative;
          overflow: hidden;
          width: 768px;
          max-width: 100%;
          min-height: 480px;
     }

     .login-container p {
          font-size: 14px;
          line-height: 20px;
          letter-spacing: 0.3px;
          margin: 20px 0;
     }

     .login-container span {
          font-size: 12px;
     }

     .login-container a {
          color: #333;
          font-size: 13px;
          text-decoration: none;
          margin: 15px 0 10px;
     }

     .login-container button {
          background-color: #fb8b17;
          color: #fff;
          font-size: 12px;
          padding: 10px 45px;
          border: 1px solid transparent;
          border-radius: 8px;
          font-weight: 600;
          letter-spacing: 0.5px;
          text-transform: uppercase;
          margin-top: 10px;
          cursor: pointer;
     }

     .login-container button.hidden {
          background-color: transparent;
          border-color: #333;
     }

     .login-container form {
          background-color: #fff;
          display: flex;
          align-items: center;
          justify-content: center;
          flex-direction: column;
          padding: 0 40px;
          height: 100%;
     }

     .login-container input {
          background-color: #eee;
          border: none;
          margin: 8px 0;
          padding: 10px 15px;
          font-size: 13px;
          border-radius: 8px;
          width: 100%;
          outline: none;
     }

     .loginform-container {
          position: absolute;
          top: 0;
          height: 100%;
          transition: all 0.6s ease-in-out;
     }

     .sign-in {
          left: 0;
          width: 50%;
          z-index: 2;
     }

     .login-container.active .sign-in {
          transform: translateX(100%);
     }

     .sign-up {
          left: 0;
          width: 50%;
          opacity: 0;
          z-index: 1;
     }

     .login-container.active .sign-up {
          transform: translateX(100%);
          opacity: 1;
          z-index: 5;
          animation: move 0s;
     }

     @keyframes move {

          0%,
          49.99% {
               opacity: 0;
               z-index: 1;
          }

          50%,
          100% {
               opacity: 1;
               z-index: 5;
          }
     }

     .toggle-container {
          position: absolute;
          top: 0;
          left: 50%;
          width: 50%;
          height: 100%;
          overflow: hidden;
          transition: all 0.6s ease-in-out;
          border-radius: 150px 0 0 100px;
          z-index: 1000;
     }

     .login-container.active .toggle-container {
          transform: translateX(-100%);
          border-radius: 0 150px 100px 0;
     }

     .toggle {
          background-color: #512da8;
          height: 100%;
          background: linear-gradient(to right, #ffb141, #fb8b17);
          color: #333;
          position: relative;
          left: -100%;
          height: 100%;
          width: 200%;
          transform: translateX(0);
          transition: all 0.6s ease-in-out;
     }

     .toggle h1 {
          font-size: 30px;
     }

     .toggle p {
          font-size: 15px;
     }

     .toggle button {
          color: #333;
     }

     .login-container.active .toggle {
          transform: translateX(50%);
     }

     .toggle-panel {
          position: absolute;
          width: 50%;
          height: 100%;
          display: flex;
          align-items: center;
          justify-content: center;
          flex-direction: column;
          padding: 0 30px;
          text-align: center;
          top: 0;
          transform: translateX(0);
          transition: all 0.6s ease-in-out;
     }

     .toggle-left {
          transform: translateX(-200%);
     }

     .login-container.active .toggle-left {
          transform: translateX(0);
     }

     .toggle-right {
          right: 0;
          transform: translateX(0);
     }

     .container.active .toggle-right {
          transform: translateX(200%);
     }

     .text-danger {
          color: red;
          font-size: 12px;
     }

     .text-success {
          color: green;
          font-size: 12px;
     }
</style>
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
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
                    document.getElementById('regForm').submit();
               }
          }

     }

     //function validate using ajax have xmlhttp
     function validate(field, value) {
          var xmlhttp;
          if (window.XMLHttpRequest) {
               xmlhttp = new XMLHttpRequest();
          } else {
               xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }

          xmlhttp.onreadystatechange = function() {
               if (xmlhttp.readyState != 4 && xmlhttp.status == 200) {
                    document.getElementById(field).innerHTML = "Validating..";
               } else if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById(field).innerHTML = xmlhttp.responseText;
               }

          };

          xmlhttp.open(
               "GET",
               "validation.php?field=" + field + "&value=" + value,
               true
          );
          xmlhttp.send();
     }
</script>