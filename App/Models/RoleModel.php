<?php
class RoleModel
{
    function __construct()
    {
    }
    public function getRoleById($roleId)
    {
        global $db;
        $role = $db->get('roles', '*', 'id = ' . $roleId);
        return $role;
    }

    public function getAllRoles()
    {
        global $db;
        $roles = $db->get('roles');
        return $roles;
    }
    public function getMaxId()
    {
        global $db;
        $query = $db->query("SELECT MAX(id) as max_id FROM roles");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['max_id'];
    }
    public function insertRole($data)
    {
        global $db;
        $db->insert('roles', $data);
        return true;
    }

    public function updateRole($RoleId, $newData)
    {
        global $db;
        $db->update('roles', $newData, 'id = ' . $RoleId);
        return true;
    }

    public function deleteRole($RoleId)
    {
        global $db;
        $db->delete('roles', 'id = ' . $RoleId);
        return true;
    }
}
