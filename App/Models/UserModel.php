<?php
class UserModel
{
    function __construct()
    {
    }


    public function validation($field, $val)
    {

        $password = "";

        //nguyen file tao thanh 1 cai ham validation trong model user-model.php

        $result = '';

        if ($field == 'name_result') {
            if (strlen($val) < 4) {        //add trim to remove white space, kiem tra ten co so khon vs ki tu dac biet, toi da 40 ki tu
                $result = 'Tên phải lớn hơn 4 ký tự';
            } else {
                $result = '<label class="text-success">Hợp lệ</label>';
            }
        }

        if ($field == "email_result") {
            if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $val)) {   //kiem tra do dai email
                $result = 'Email không hợp lệ';
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
            if (strlen($val) < 4) {
                $result = 'Mật khẩu phải lớn hơn 4 ký tự';   //kiem tra mat khau tu 4 den 10 ki tu, co dau cach 2 dau khong
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

    public function createUser()
    {
        //create user
        return true;
    }
}
