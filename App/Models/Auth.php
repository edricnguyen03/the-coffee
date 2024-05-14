<?php
Class Auth{
    public static function checkPermission($userId, $permissionId)
    {
        global $db;
        $role_id = $db->get('users', 'role_id', 'id = ' . $userId)[0]['role_id'];
        $allPermissions = $db->get('permission_role', 'permission_id', 'role_id = ' . $role_id);
        foreach ($allPermissions as $permission) {
            if ($permission['permission_id'] == $permissionId) {
                return true;
            }
        }
        return false;
    }

    public static function hasAdminPermission($userId)
    {
         $numberOfPermission = 9;
        for ($i = 1; $i <= $numberOfPermission; $i++) {
            if (Auth::checkPermission($userId,$i) == true) {
                return true;
            }
        }
        return false;
    }
}