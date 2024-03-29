<div class="container" id="container">
     <div class="form-container sign-up">
          <form>
               <h1>Tạo Tài Khoản</h1>
               <input type="text" placeholder="Tên">
               <input type="email" placeholder="Email">
               <input type="number" placeholder="Số điện thoại">
               <input type="password" placeholder="Mật khẩu">
               <input type="password" placeholder="Nhập lại mật khẩu">
               <button>Đăng Kí</button>
          </form>
     </div>
     <div class="form-container sign-in">
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
                    <button class="hidden" id="login">Đăng nhập</button>
               </div>
               <div class="toggle-panel toggle-right">
                    <h1>Chào mừng trở lại !</h1>
                    <p>Đăng nhập để tiếp tục</p>
                    <button class="hidden" id="register">Đăng kí</button>
               </div>
          </div>
     </div>
</div>
<style>
     @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

     * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
          font-family: 'Montserrat', sans-serif;
     }

     body {
          background-color: #c9d6ff;
          background: linear-gradient(to right, #e2e2e2, #c9d6ff);
          display: flex;
          align-items: center;
          justify-content: center;
          flex-direction: column;
          height: 100vh;
     }

     .container {
          background-color: #fff;
          border-radius: 30px;
          box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
          position: relative;
          overflow: hidden;
          width: 768px;
          max-width: 100%;
          min-height: 480px;
     }

     .container p {
          font-size: 14px;
          line-height: 20px;
          letter-spacing: 0.3px;
          margin: 20px 0;
     }

     .container span {
          font-size: 12px;
     }

     .container a {
          color: #333;
          font-size: 13px;
          text-decoration: none;
          margin: 15px 0 10px;
     }

     .container button {
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

     .container button.hidden {
          background-color: transparent;
          border-color: #333;
     }

     .container form {
          background-color: #fff;
          display: flex;
          align-items: center;
          justify-content: center;
          flex-direction: column;
          padding: 0 40px;
          height: 100%;
     }

     .container input {
          background-color: #eee;
          border: none;
          margin: 8px 0;
          padding: 10px 15px;
          font-size: 13px;
          border-radius: 8px;
          width: 100%;
          outline: none;
     }

     .form-container {
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

     .container.active .sign-in {
          transform: translateX(100%);
     }

     .sign-up {
          left: 0;
          width: 50%;
          opacity: 0;
          z-index: 1;
     }

     .container.active .sign-up {
          transform: translateX(100%);
          opacity: 1;
          z-index: 5;
          animation: move 0.6s;
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

     .container.active .toggle-container {
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

     .container.active .toggle {
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

     .container.active .toggle-left {
          transform: translateX(0);
     }

     .toggle-right {
          right: 0;
          transform: translateX(0);
     }

     .container.active .toggle-right {
          transform: translateX(200%);
     }
</style>
<script>
     const container = document.getElementById('container');
     const registerBtn = document.getElementById('register');
     const loginBtn = document.getElementById('login');

     registerBtn.addEventListener('click', () => {
          container.classList.add("active");
     });

     loginBtn.addEventListener('click', () => {
          container.classList.remove("active");
     });
</script>