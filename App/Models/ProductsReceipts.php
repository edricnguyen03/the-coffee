<?php
class ProductsReceipts
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
    
    public function getPRById($PR)
    {
        global $db;
        $PR = $db->get('product_receipt', '*', 'id = ' . $PR);
        return $PR;
    }

    public function getAllPR()
    {
        global $db;
        $provider = $db->get('providers');
        return $provider;
    }

    function getAllProvidersName() {
        global $db;
        $providers = $db->get('providers', 'name');
        return $providers;
    }
    
    public function getMaxId()
    {
        global $db;
        $query = $db->query("SELECT MAX(id) as max_id FROM users");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['max_id'];
    }

    //write a function to create a user and save in database
    public function createPR()
    {
        return true;
    }

    public function insertPR($data)
    {
        global $db;
        $db->insert('product_receipt', $data);
        return true;
    }

    public function updatePR($userId, $newUserData)
    {
        global $db;
        $db->update('users', $newUserData, 'id = ' . $userId);
        return true;
    }

    public function deletePR($userId)
    {
        global $db;
        $db->delete('users', 'id = ' . $userId);
        return true;
    }
}
