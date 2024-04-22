$(document).ready(function () {
  var btnLuuThongTin = document.getElementById("btn-LuuThongTin");
  var btnDoiMatKhau = document.getElementById("btn-DoiMatKhau");

  // Đổi mật khẩu
  btnDoiMatKhau.addEventListener("click", function (event) {
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
      success: function (response) {
        switch (response) {
          case "fail": {
            Swal.fire({
              icon: "error",
              title: "Đổi mật khẩu thất bại",
              text: "Lỗi không xác định",
            });
            break;
          }
          case "success": {
            Swal.fire({
              icon: "success",
              title: "Đổi mật khẩu thành công",
              text: "Mật khẩu của bạn đã được thay đổi",
            });
            document.getElementById("current-password").value = "";
            document.getElementById("new-password").value = "";
            document.getElementById("confirm-password").value = "";
            break;
          }
          default: {
            Swal.fire({
              icon: "error",
              title: "Đổi mật khẩu thất bại",
              text: response,
            });
            break;
          }
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  });

  // Lưu thông tin
  btnLuuThongTin.addEventListener("click", function (event) {
    var userId = document.getElementById("user-id").value;
    var userName = document.getElementById("user-name").value;
    $.ajax({
      url: "/the-coffee/profile/editName",
      type: "POST",
      data: {
        userId: userId,
        userName: userName,
      },
      success: function (response) {
        switch (response) {
          case "fail": {
            Swal.fire({
              icon: "error",
              title: "Đổi tên thất bại",
              text: "Lỗi không xác định",
            });
            break;
          }
          case "success": {
            Swal.fire({
              icon: "success",
              title: "Đổi tên thành công",
              text: "Tên của bạn đã được thay đổi",
            });
            document.getElementById("current-password").value = "";
            document.getElementById("new-password").value = "";
            document.getElementById("confirm-password").value = "";
            break;
          }
          default: {
            Swal.fire({
              icon: "error",
              title: "Đổi tên thất bại",
              text: response,
            });
            break;
          }
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  });
});
