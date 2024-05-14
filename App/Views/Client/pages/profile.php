<div class="container my-5">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="card h-100">
        <div class="card-header py-2 profile-header text-center">
          <h3 class="card-title">Thông tin cá nhân</h3>
        </div>
        <div class="card-body">
          <input type="hidden" id="user-id" value="<?php echo $user['id']; ?>">
          <div class="form-group py-2">
            <label for="name">Họ và tên:</label>
            <input type="text" class="form-control" id="user-name" value="<?php echo $user['name']; ?>">
          </div>
          <div class="form-group py-2">
            <label for="email">Email: </label>
            <input type="email" class="form-control" id="user-email" value="<?php echo $user['email']; ?>" disabled>
          </div>
          <div class="form-group py-2 text-center">
            <button type="button" id="btn-LuuThongTin" class="btn-LuuThongTin px-3 py-2" style="border-radius: 5px;">Lưu thông tin</button>
          </div>
          <hr>
          <h5 class="card-title py-4">Đổi mật khẩu</h5>
          <div class="form-group py-2">
            <label for="currentPassword">Mật khẩu hiện tại:</label>
            <input type="password" class="form-control" id="current-password" required>
          </div>
          <div class="form-group py-2">
            <label for="newPassword">Mật khẩu mới:</label>
            <input type="password" class="form-control" id="new-password" required>
          </div>
          <div class="form-group py-2">
            <label for="confirmPassword">Xác nhận mật khẩu mới:</label>
            <input type="password" class="form-control" id="confirm-password" required>
          </div>
          <div class="form-group py-2 text-center">
            <button type="button" id="btn-DoiMatKhau" class="btn-LuuThongTin px-3 py-2" style="border-radius: 5px;">Đổi mật khẩu</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  .form-control {
    color: #333;
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
  }

  .btn-LuuThongTin {
    color: #000000;
    background-color: #ffad3d;
    border: none;
  }

  .btn-LuuThongTin:hover {
    background-color: #fb8d17;
    border-color: #fb8d17;
  }

  .profile-header {
    background: linear-gradient(to right, #ffad3d, #fb8d17);
    color: #000000;
  }
</style>
<!-- <script src="/the-coffee/resources/js/profile.js"></script> -->
<script>
  $(document).ready(function() {
    var btnLuuThongTin = document.getElementById("btn-LuuThongTin");
    var btnDoiMatKhau = document.getElementById("btn-DoiMatKhau");

    // Đổi mật khẩu
    btnDoiMatKhau.addEventListener("click", function(event) {
      var userId = document.getElementById("user-id").value;
      var currentPassword = document.getElementById("current-password").value;
      var newPassword = document.getElementById("new-password").value;
      var confirmPassword = document.getElementById("confirm-password").value;
      if (currentPassword == "" || newPassword == "" || confirmPassword == "") {
        Swal.fire({
          icon: "error",
          title: "Không được bỏ trống các ô",
          text: "Vui lòng nhập đầy đủ 3 ô mật khẩu",
        });
        return;
      }
      if (newPassword != confirmPassword) {
        Swal.fire({
          icon: "error",
          title: "Mật khẩu không trùng khớp",
          text: "Vui lòng nhập mật khẩu mới và nhập lại mật khẩu mới giống nhau",
        });
        return;
      }
      $.ajax({
        url: "/the-coffee/profile/changePassword",
        type: "POST",
        data: {
          userId: userId,
          currentPassword: currentPassword,
          newPassword: newPassword,
        },
        success: function(response) {
          response = response.trim();
          if (response.includes("success")) {
            Swal.fire({
              icon: "success",
              title: "Đổi mật khẩu thành công",
              text: "Mật khẩu của bạn đã được thay đổi, bạn sẽ được chuyển hướng về trang đăng nhập",
              didClose: function() {
                window.location.href = "/the-coffee/Login_Regis/Logout";
              }
            });
            document.getElementById("current-password").value = "";
            document.getElementById("new-password").value = "";
            document.getElementById("confirm-password").value = "";
            return;
          }
          if (response.includes("fail")) {
            Swal.fire({
              icon: "error",
              title: "Đổi mật khẩu thất bại",
              text: "Lỗi không xác định",
            });
            return;
          }
          Swal.fire({
            icon: "error",
            title: "Đổi mật khẩu thất bại",
            text: response,
          });
          // switch (response) {
          //   case "fail": {
          //     Swal.fire({
          //       icon: "error",
          //       title: "Đổi mật khẩu thất bại",
          //       text: "Lỗi không xác định",
          //     });
          //     break;
          //   }
          //   case "success": {
          //     Swal.fire({
          //       icon: "success",
          //       title: "Đổi mật khẩu thành công",
          //       text: "Mật khẩu của bạn đã được thay đổi",
          //     });
          //     document.getElementById("current-password").value = "";
          //     document.getElementById("new-password").value = "";
          //     document.getElementById("confirm-password").value = "";
          //     break;
          //   }
          //   default: {
          //     Swal.fire({
          //       icon: "error",
          //       title: "Đổi mật khẩu thất bại",
          //       text: response,
          //     });
          //     break;
          //   }
          // }
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
        },
      });
    });

    // Lưu thông tin
    btnLuuThongTin.addEventListener("click", function(event) {
      var userId = document.getElementById("user-id").value;
      var userName = document.getElementById("user-name").value;
      $.ajax({
        url: "/the-coffee/profile/editName",
        type: "POST",
        data: {
          userId: userId,
          userName: userName,
        },
        success: function(response) {
          if (response.includes("success")) {
            Swal.fire({
              icon: "success",
              title: "Đổi tên thành công",
              text: "Tên của bạn đã được thay đổi",
              didClose: function() {
                window.location.reload();
              }
            });
            $_SESSION['login']['username'] = userName;

            return;
          }
          if (response.includes("fail")) {
            Swal.fire({
              icon: "error",
              title: "Đổi tên thất bại",
              text: "Lỗi không xác định",
            });
            return;
          }
          Swal.fire({
            icon: "error",
            title: "Đổi tên thất bại",
            text: response,
          });
          // switch (response) {
          //   case "fail": {
          //     Swal.fire({
          //       icon: "error",
          //       title: "Đổi tên thất bại",
          //       text: "Lỗi không xác định",
          //     });
          //     break;
          //   }
          //   case "success": {
          //     Swal.fire({
          //       icon: "success",
          //       title: "Đổi tên thành công",
          //       text: "Tên của bạn đã được thay đổi",
          //     });
          //     document.getElementById("current-password").value = "";
          //     document.getElementById("new-password").value = "";
          //     document.getElementById("confirm-password").value = "";
          //     break;
          //   }
          //   default: {
          //     Swal.fire({
          //       icon: "error",
          //       title: "Đổi tên thất bại",
          //       text: response,
          //     });
          //     break;
          //   }
          // }
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
        },
      });
    });
  });
</script>