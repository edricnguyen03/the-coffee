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

    public function getById($providerId)
    {
        global $db;
        $provider = $db->get('providers', '*', 'id = ' . $providerId);
        return $provider;
    }

    public function getAllProviders()
    {
        global $db;
        $provider = $db->get('providers');
        return $provider;
    }

    function getProvidersName($ProviderId)
    {
        global $db;
        $providers = $db->get('providers', 'name', 'id = ' . $ProviderId);
        return $providers;
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
        $query = $db->query("SELECT MAX(id) as max_id FROM users");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['max_id'];
    }

    public function checkProviderNameExists($name)
    {
        global $db;
        $result = $db->get("providers", "*", "name = '$name'");
        if (count($result) > 0) {
            return true;
        }
        return false;
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

    public function updateProvider($Id, $newProviderData)
    {
        global $db;
        $db->update('providers', $newProviderData, 'id = ' . $Id);
        return true;
    }

    public function deleteProvider($Id)
    {
        global $db;
        $db->delete('providers', 'id = ' . $Id);
        return true;
    }
    public function setProviderStatus($Id, $status)
    {
        global $db;
        $db->update('providers', ['status' => $status], 'id = ' . $Id);
        return true;
    }
}
