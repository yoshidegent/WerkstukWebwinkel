<?php
include_once 'DB/Connection/DatabaseFactory.php';

class AdminDao
{
    private static function getVerbinding()
    {
        return DatabaseFactory::getDatabase();
    }

    public static function isAdmin($admin)
    {
        $resultaten = self::getVerbinding()->voerSqlQueryUit("SELECT admin_naam FROM admins");
        $resultaten = $resultaten->fetch_array();
        foreach($resultaten as $element)
        {
            if($element == $admin)
            {
                return true;
            }
        }
        return false;
    }
}
?>