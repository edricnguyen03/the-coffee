<?php
class ProviderModel
{
    function __construct()
    {
    }
    public function getProviderById($providerId)
    {
        global $db;
        $provider = $db->get('providers', '*', 'id = ' . $providerId);
        return $provider;
    }

    public function getAllProviders()
    {
        global $db;
        $providers = $db->get('providers');
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
    public function insertProvider($data)
    {
        global $db;
        $db->insert('providers', $data);
        return true;
    }

    public function updateProvider($providerId, $newData)
    {
        global $db;
        $db->update('providers', $newData, 'id = ' . $providerId);
        return true;
    }

    public function deleteProvider($providerId)
    {
        global $db;
        $db->delete('providers', 'id = ' . $providerId);
        return true;
    }
}