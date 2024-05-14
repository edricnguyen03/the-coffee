<?php
class ReceiptModel
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

    public function getReceiptById($receiptId)
    {
        global $db;
        $receipts = $db->get('receipts', '*', 'id = ' . $receiptId);
        return $receipts;
    }

    public function getReceiptNameById($receiptId)
    {
        global $db;
        $receiptName = $db->get('receipts', 'name', 'id = ' . $receiptId);
        return $receiptName;
    }

    public function getReceiptTotalById($receiptId)
    {
        global $db;
        $receiptName = $db->get('receipts', 'total', 'id = ' . $receiptId);
        return $receiptName;
    }

    public function getProviderIdById($receiptId)
    {
        global $db;
        $receiptId = $db->get('receipts', 'provider_id', 'id = ' . $receiptId);
        return $receiptId;
    }

    public function getAllReceipts()
    {
        global $db;
        $receipts = $db->get('receipts');
        return $receipts;
    }
    
    public function getMaxId()
    {
        global $db;
        $query = $db->query("SELECT MAX(id) as max_id FROM receipts");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['max_id'];
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
                return "success";
            }
            return "fail";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    //write a function to create a user and save in database
    public function createReceipt()
    {
        return true;
    }

    public function insertReceipt($data)
    {
        global $db;
        $db->insert('receipts', $data);
        return true;
    }

    public function updateReceipt($receiptId, $newReceiptData)
    {
        global $db;
        $db->update('receipts', $newReceiptData, 'id = ' . $receiptId);
        return true;
    }

    public function deleteReceipt($receiptId)
    {
        global $db;
        $db->delete('receipts', 'id = ' . $receiptId);
        return true;
    }
}
