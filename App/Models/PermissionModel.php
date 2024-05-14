<?php
class PermissionModel
{
    function __construct()
    {
    }
    public function getPermissionById($permissionId)
    {
        global $db;
        $permission = $db->get('permissions', '*', 'id = ' . $permissionId);
        return $permission;
    }

    public function getAllPermissions()
    {
        global $db;
        $permissions = $db->get('permissions');
        return $permissions;
    }
    public function getMaxId()
    {
        global $db;
        $query = $db->query("SELECT MAX(id) as max_id FROM permissions");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['max_id'];
    }
    public function insertPermission($data)
    {
        global $db;
        $db->insert('permissions', $data);
        return true;
    }
    public function updatePermission($permissionId, $newData)
    {
        global $db;
        $db->update('permissions', $newData, 'id = ' . $permissionId);
        return true;
    }

    public function deletePermission($permissionId)
    {
        global $db;
        $db->delete('permissions', 'id = ' . $permissionId);
        return true;
    }
}
