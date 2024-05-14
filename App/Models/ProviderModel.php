<?php
class ProviderModel
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
    
    public function getProviderById($providerId)
    {
        global $db;
        $providerName = $db->get('providers', 'name', 'id = ' . $providerId);
        return $providerName;
    }

    public function getAllProviders()
    {
        global $db;
        $provider = $db->get('providers');
        return $provider;
    }

    function getProvidersName($ProviderId) {
        global $db;
        $providers = $db->get('providers', 'name' ,'id = ' . $ProviderId);
        return $providers;
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
    public function createProvider()
    {
        return true;
    }

    public function insertProvider($data)
    {
        global $db;
        $db->insert('users', $data);
        return true;
    }

    public function updateProvider($userId, $newUserData)
    {
        global $db;
        $db->update('users', $newUserData, 'id = ' . $userId);
        return true;
    }

    public function deleteProvider($userId)
    {
        global $db;
        $db->delete('users', 'id = ' . $userId);
        return true;
    }
}
