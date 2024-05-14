<!DOCTYPE html>
<html>

<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">

    <style>
        .wrapper {
            background: linear-gradient(to right, #ffad3d, #fb8d17);
        }

        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(to right, #ffad3d, #fb8d17);
        }

        .btn {
            background: #ffad3d;
            color: black;
        }
    </style>
</head>

<body>
    <!-- Password Reset 1 - Bootstrap Brain Component -->
    <div class="bg-light py-3 py-md-5 wrapper h-100">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-12 col-md-11 col-lg-8 col-xl-7 col-xxl-6">
                    <div class="bg-white p-4 p-md-5 rounded shadow-sm">
                        <div class="row gy-3 mb-5">
                            <div class="col-12">
                                <div class="text-center">
                                    <img src=".\resources\images\header-logo.png" alt="Logo" style="object-fit: cover; width: 30%">
                                </div>
                            </div>
                            <div class="col-12">
                                <h2 class="fs-6 fw-normal text-center text-secondary m-0 px-md-5">Vui lòng nhập địa chỉ email đã đăng kí tài khoản</h2>
                            </div>
                        </div>
                        <div class="row gy-3 gy-md-4 overflow-hidden" id="content">
                            <div class="col-12">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                        </svg>
                                    </span>
                                    <input type="email" class="form-control" name="email" id="email" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-grid text-center">
                                    <button class="btn btn-lg" id="btnGuiMaXacNhan">Gửi mã xác nhận</button>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="otp" class="form-label">OTP <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield-lock" viewBox="0 0 16 16">
                                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V5h1a1 1 0 0 1 1 1v1.5a4.5 4.5 0 0 1-9 0V6a1 1 0 0 1 1-1h1V3.5A2.5 2.5 0 0 1 8 1zm-1 5h2a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1zm1 1a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z" />
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control" name="otp" id="otp" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-grid text-center">
                                    <button class="btn btn-lg" id="btnDatLaiMatKhau">Đặt lại mật khẩu</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var email;
        $('#btnGuiMaXacNhan').click(function() {
            var email = $('#email').val();
            if (email == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Thất bại',
                    text: 'Vui lòng nhập email!',
                });
            } else {
                $.ajax({
                    url: '/the-coffee/ForgotPassword/guiMa',
                    type: 'POST',
                    data: {
                        email: email
                    },
                    success: function(response) {
                        if (response.trim() == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Thành công',
                                text: 'Mã xác nhận đã được gửi đến email của bạn!',
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Thất bại',
                                text: response,
                            });
                        }
                    }
                });
            }
        });

        $('#btnDatLaiMatKhau').click(function() {
            email = $('#email').val();
            var otp = $('#otp').val();
            if (email == '' || otp == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Thất bại',
                    text: 'Vui lòng nhập đầy đủ thông tin!',
                });
            } else {
                $.ajax({
                    url: '/the-coffee/ForgotPassword/datLaiMatKhau',
                    type: 'POST',
                    data: {
                        email: email,
                        otp: otp
                    },
                    success: function(response) {

                        if (response.trim() == 'success') {
                            let content = document.getElementById('content');
                            content.innerHTML = '<h5 class="card-title py-4 text-center">Đổi mật khẩu</h5>' +
                                '<div class="form-group py-2">' +
                                '<label for="newPassword">Mật khẩu mới:</label>' +
                                '<input type="password" class="form-control" id="new-password" required>' +
                                '</div>' +
                                '<div class="form-group py-2">' +
                                '<label for="confirmPassword">Xác nhận mật khẩu mới:</label>' +
                                '<input type="password" class="form-control" id="confirm-password" required>' +
                                '</div>' +
                                '<div class="form-group py-2 text-center">' +
                                '<button type="button" id="btn-DoiMatKhau" class="btn-LuuThongTin btn px-3 py-2" style="border-radius: 5px;">Đổi mật khẩu</button>' +
                                '</div>';
                            var btnDoiMatKhau = document.getElementById('btn-DoiMatKhau');
                            if (btnDoiMatKhau != null) {
                                btnDoiMatKhau.addEventListener("click", function(event) {
                                    var newPassword = document.getElementById("new-password").value;
                                    var confirmPassword = document.getElementById("confirm-password").value;
                                    if (newPassword.trim() == "" || confirmPassword.trim() == "") {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Không được bỏ trống các ô",
                                            text: "Vui lòng nhập đầy đủ 2 ô mật khẩu",
                                        });
                                        return;
                                    }
                                    if (newPassword != confirmPassword) {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Mật khẩu không khớp",
                                            text: "Vui lòng nhập lại mật khẩu",
                                        });
                                        return;
                                    }
                                    if (newPassword.trim().length < 4 || newPassword.trim().length > 10) {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Mật khẩu phải có ít nhất 4 ký tự và tối đa là 10 ký tự",
                                            text: "Vui lòng nhập lại mật khẩu",
                                        });
                                        return;
                                    }
                                    $.ajax({
                                        url: '/the-coffee/ForgotPassword/doiMatKhau',
                                        type: 'POST',
                                        data: {
                                            email: email,
                                            password: newPassword.trim(),
                                        },
                                        success: function(response) {
                                            if (response.trim() == 'success') {
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Thành công',
                                                    text: 'Đổi mật khẩu thành công',
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        window.location.href = '/the-coffee';
                                                    }
                                                });
                                            } else {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Thất bại',
                                                    text: response,
                                                });
                                            }
                                        }
                                    });
                                });
                            }

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Thất bại',
                                text: response,
                            });
                        }

                    }
                });
            }

        });

    });
</script>