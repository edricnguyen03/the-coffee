<?php
class ProviderModel
{
    function __construct()
    {
    }
    // public function login($username, $password)
    // {
    //     global $db;
    //     $userArr = $db->get('providers');
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

    public function getProviderById($ProviderId)
    {
        global $db;
        $provider = $db->get('providers', '*', 'id = ' . $ProviderId);
        return $provider;
    }

    public function getAllProviders()
    {
        global $db;
        $provider = $db->get('providers');
        return $provider;
    }

    function getAllProvidersName()
    {
        global $db;
        $providers = $db->get('providers', 'name');
        return $providers;
    }

    public function getMaxId()
    {
        global $db;
        $query = $db->query("SELECT MAX(id) as max_id FROM providers");
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
        $db->insert('providers', $data);
        return true;
    }

    public function updateProvider($providerId, $newUserData)
    {
        global $db;
        $db->update('providers', $newUserData, 'id = ' . $providerId);
        return true;
    }

    public function deleteProvider($userId)
    {
        global $db;
        $db->delete('providers', 'id = ' . $userId);
        return true;
    }
    public function setProviderStatus($providerId, $status)
    {
        global $db;
        $result = $db->update("providers", ["status" => $status], "id = $providerId");
        return $result;
    }
}
