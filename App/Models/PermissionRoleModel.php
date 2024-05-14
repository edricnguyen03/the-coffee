<?php
class PermissionRoleModel
{
    function __construct()
    {
    }
    public function getPermissionById($permissionId)
    {
        global $db;
        $permission_role = $db->get('permission_role', '*', 'id = ' . $permissionId);
        return $permission_role;
    }

    public function getPermissionsByRoleId($roleId)
    {
        global $db;
        $permission_role = $db->get('permission_role', '*', 'role_id = ' . $roleId);
        return $permission_role;
    }

    public function getAllPermissionRole()
    {
        global $db;
        $permission_role = $db->get('permission_role');
        return $permission_role;
    }
    public function getMaxId()
    {
        global $db;
        $query = $db->query("SELECT MAX(id) as max_id FROM permission_role");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['max_id'];
    }
    public function insertPermissionRole($data)
    {
        global $db;
        $db->insert('permission_role', $data);
        return true;
    }

    public function updatePermissionRole($roleId, $newData)
    {
        global $db;
        $db->update('permission_role', $newData, 'role_id = ' . $roleId,);
        return true;
    }

    public function deletePermissionsByRoleId($roleId)
    {
        global $db;
        $db->delete('permission_role', 'role_id = ' . $roleId);
        return true;
    }
}
