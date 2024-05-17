<?php
Class Auth{
    //id của các permission
    public static $permissionUser = 1;
    public static $permissionCategory = 2;
    public static $permissionProduct = 3;
    public static $permissionOrder = 4;
    public static $permissionRole = 5;
    public static $permissionDashboard = 6;
    public static $permissionProvider = 7;
    public static $permissionReceipt = 8;
    public static $permissionPermission = 9;

    //tổng số permission
    public static $numberOfPermission = 9;

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
        for ($i = 1; $i <= Auth::$numberOfPermission; $i++) {
            if (Auth::checkPermission($userId,$i) == true) {
                return true;
            }
        }
        return false;
    }
}