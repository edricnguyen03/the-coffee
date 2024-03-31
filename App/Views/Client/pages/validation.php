<?php
$val = $_GET['value'];
$field = $_GET['field'];
$password = "";

if ($field == 'name_result') {
    if (strlen($val) < 4) {
        echo 'Tên phải lớn hơn 4 ký tự';
    } else {
        echo '<label class = "text-success">Hợp lệ</label>';
    }
}

if ($field == "email_result") {
    if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $val)) {
        echo 'Email không hợp lệ';
    } else {
        echo '<label class = "text-success">Hợp lệ</label>';
    }
}

if ($field == "phone_result") {
    if (!preg_match("/^0(\d{9}|9\d{8})$/", $val)) {
        echo 'Số điện thoại không hợp lệ';
    } else {
        echo '<label class = "text-success">Hợp lệ</label>';
    }
}

session_start();

if ($field == "password_result") {
    if (strlen($val) < 4) {
        echo 'Mật khẩu phải lớn hơn 4 ký tự';
    } else {
        $_SESSION['password'] = $val;
        echo '<label class="text-success">Hợp lệ</label>';
    }
}

if ($field == "repassword_result") {
    if ($val != $_SESSION['password']) {
        echo 'Mật khẩu không khớp';
    } else {
        echo '<label class="text-success">Hợp lệ</label>';
    }
}

echo "<script>alert('Đăng ký thành công')</script>";
echo "<script>window.location = 'login-regis.php'</script>";
