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
<script src="/the-coffee/resources/js/profile.js"></script>