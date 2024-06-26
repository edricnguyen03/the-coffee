<?php
class UserModel
{
    function __construct()
    {
    }
    // public function login($username, $password)
    // {
    //     global $db;
    //     $userArr = $db->get('users');
    //     foreach ($userArr as $user) {
    //         if ($user['email'] == $username && $user['password'] != $password) {
    //             return "wrongPassword";
    //         }
    //         if ($user['email'] == $username && $user['password'] == $password) {
    //             if ($user['status'] == 1) {
    //                 return $user['id'];
    //             } else {
    //                 return "banned";
    //             }
    //         }
    //     }
    //     return "notFound";
    // }

    public function login($username, $password)
    {
        global $db;
        $userArr = $db->get('users');

        foreach ($userArr as $user) {
            if ($user['email'] == $username && password_verify($password, $user['password']) == false) {
                return "wrongPassword";
            }
            if ($user['email'] == $username && password_verify($password, $user['password']) == true) {
                if ($user['status'] == 1) {
                    return $user['id'];
                } else {
                    return "banned";
                }
            }

            // return "success_admin";
        }
        return "notFound";
    }

    public function getRole($userId)
    {
        global $db;
        $role = $db->get('users', 'role_id', 'id = ' . $userId);
        return $role[0]['role_id'];
    }

    public function getUserById($userId)
    {
        global $db;
        $user = $db->get('users', '*', 'id = ' . $userId);
        return $user;
    }

    public function getAllUsers()
    {
        global $db;
        $users = $db->get('users');
        return $users;
    }

    public function getMaxId()
    {
        global $db;
        $query = $db->query("SELECT MAX(id) as max_id FROM users");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['max_id'];
    }

    public function updatePassword($userId, $newPassword)
    {
        global $db;
        try {
            if ($db->update('users', ['password' => password_hash($newPassword, PASSWORD_DEFAULT)], 'id = ' . $userId)) {
                return "success";
            };
            return "fail";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function changePassword($userId, $currentPassword, $newPassword)
    {
        global $db;
        try {
            $password = $db->get('users', 'password', 'id = ' . $userId);
            if (password_verify($currentPassword, $password[0]['password']) == false) {
                return "Mật khẩu cũ không đúng";
            }
            if ($currentPassword == $newPassword) {
                return "Mật khẩu mới không được trùng mật khẩu cũ";
            }
            if (strlen($newPassword) < 4 || strlen($newPassword) > 10) {
                return "Mật khẩu mới phải từ 4 đến 10 ký tự";
            }
            if (strpos($newPassword, ' ') !== false) {
                return 'Mật khẩu mới không được chứa khoảng trắng';
            }
            if ($db->update('users', ['password' => password_hash($newPassword, PASSWORD_DEFAULT)], 'id = ' . $userId)) {
                return "success";
            };
            return "fail";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function editName($userId, $userName)
    {
        try {
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
                $_SESSION['login']['username'] = $userName;
                return "success";
            }
            return "fail";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function insertUser($data)
    {
        global $db;
        $db->insert('users', $data);
        return true;
    }

    public function updateUser($userId, $newUserData)
    {
        global $db;
        $db->update('users', $newUserData, 'id = ' . $userId);
        return true;
    }

    public function deleteUser($userId)
    {
        global $db;
        $db->delete('users', 'id = ' . $userId);
        return true;
    }
    public function getUserByEmail($email)
    {
        global $db;
        $user = $db->get('users', '*', "email = '$email'");
        return $user;
    }
    public function setUserStatus($userId, $status)
    {
        global $db;
        $result = $db->update("users", ["status" => $status], "id = $userId");
        return $result;
    }
    public function checkRoleInUser($roleId)
    {
        global $db;
        $result = $db->get('users', 'id', 'role_id = ' . $roleId);
        if (count($result) > 0) {
            return true;
        }
        return false;
    }
}
