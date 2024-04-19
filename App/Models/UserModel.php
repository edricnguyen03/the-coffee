<?php
class UserModel
{
    function __construct()
    {
    }
    public function login($username, $password)
    {
        global $db;
        $userArr = $db->get('users');
        foreach ($userArr as $user) {
            if ($user['email'] == $username && $user['password'] != $password) {
                return "wrongPassword";
            }
            if ($user['email'] == $username && $user['password'] == $password) {
                if ($user['status'] == 1) {
                    return $user['id'];
                } else {
                    return "banned";
                }
            }
        }
        return "notFound";
    }

    public function validation($field, $val)
    {

        $password = "";
        $result = '';

        if ($field == 'name_result') {
            //kiem tra do dai ten duoi 4 ki tu
            if (strlen(trim($val)) < 4) {
                $result = 'Tên phải lớn hơn 4 ký tự';
            }

            //kiem tra do dai ten qua 40 ki tu 
            else if (strlen(trim($val)) > 40) {
                $result = 'Tên không được quá 40 ký tự';
            }

            //kiem tra ten co chua ki tu dac biet hoac so khong
            else if (!preg_match("/^[\p{L} ]*$/u", $val) || preg_match("/\d/", $val)) {
                $result = 'Tên không được chứa ký tự đặc biệt hoặc số';
            } else {
                $result = '<label class="text-success">Hợp lệ</label>';
            }
        }

        if ($field == "email_result") {

            //kiem tra email hop le
            if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $val)) {
                $result = 'Email không hợp lệ';
            }

            //kiem tra do dai email
            else if (!preg_match("/^(?=.{1,40}$)([\w\-]+\@[\w\-]+\.[\w\-]+)/", $val)) {
                $result = 'Email dài quá 40 ký tự';
            } else {
                $result = '<label class="text-success">Hợp lệ</label>';
            }
        }

        if ($field == "phone_result") {
            if (!preg_match("/^0(\d{9}|9\d{8})$/", $val)) {
                $result = 'Số điện thoại không hợp lệ';
            } else {
                $result = '<label class="text-success">Hợp lệ</label>';    //return
            }
        }


        if ($field == "password_result") {
            //kiem tra mat khau tu 4 den 10 ki tu
            if (strlen($val) < 4 || strlen($val) > 10) {
                $result = 'Mật khẩu phải từ 4 đến 10 ký tự';
            }
            // kiem tra mat khau co chua khoang trang o 2 dau khong
            else if (trim($val) !== $val) {
                $result = 'Mật khẩu không được chứa khoảng trắng';
            } else {
                $_SESSION['password'] = $val;
                $result = '<label class="text-success">Hợp lệ</label>';
            }
        }

        if ($field == "repassword_result") {
            if ($val != $_SESSION['password']) {
                $result = 'Mật khẩu không khớp';
            } else {
                $result = '<label class="text-success">Hợp lệ</label>';
            }
        }

        return $result;
    }

    public function getUserById($userId)
    {
        global $db;
        $user = $db->get('users', '*', 'id = ' . $userId);
        return $user;
    }

    public function changePassword($userId, $currentPassword, $newPassword)
    {
        global $db;
        try {
            $password = $db->get('users', 'password', 'id = ' . $userId);
            if ($password[0]['password'] != $currentPassword) {
                return "Mật khẩu cũ không đúng";
            }
            if ($currentPassword == $newPassword) {
                return "Mật khẩu mới không được trùng mật khẩu cũ";
            }
            if (strlen($newPassword) < 4 || strlen($newPassword) > 10) {
                return "Mật khẩu mới phải từ 4 đến 10 ký tự";
            }
            if (trim($newPassword) !== $newPassword) {
                return 'Mật khẩu mới không được chứa khoảng trắng';
            }
            if ($db->update('users', ['password' => $newPassword], 'id = ' . $userId)) {
                return "success";
            };
            return "fail";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function editName($userId, $userName){
        try{
            global $db;
            $currentName = $db->get('users', 'name', 'id = ' . $userId);
            if ($currentName[0]['name'] == $userName) {
                return "Tên không được trùng với tên hiện tại";
            }
            if (trim($userName) != $userName) {
                return "Tên không được chứa khoảng trắng ở đầu hoặc cuối chuỗi";
            }
            if (empty($userName)) {
                return "Tên không được để trống";
            }
            if (!preg_match("/^[\p{L} ]*$/u", $userName) || preg_match("/\d/", $userName)) {
                return "Tên không được chứa ký tự đặc biệt hoặc số";
            }
            if (strlen($userName) < 4) {
                return "Tên phải lớn hơn 4 ký tự";
            }
            if (strlen($userName) > 40) {
                return "Tên không được quá 40 ký tự";
            }
            if ($db->update('users', ['name' => $userName], 'id = ' . $userId)) {
                return "success";
            }
            return "fail";
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
    //write a function to create a user and save in database
    public function createUser()
    {
        return true;
    }
}