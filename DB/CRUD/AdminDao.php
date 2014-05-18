<?php
include_once 'DB/Connection/DatabaseFactory.php';

class AdminDao
{
    private static function getVerbinding()
    {
        return DatabaseFactory::getDatabase();
    }

    public static function getAll()
    {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT adminnaam FROM admins");
        $resultatenArray = array();

        for ($index = 0; $index < $resultaat->num_rows; $index++)
        {
            $resultatenArray[$index] = $resultaat->fetch_array();
        }

        return $resultatenArray;
    }

    public static function isAdmin($admin)
    {
        $resultaten = self::getAll();

        foreach($resultaten as $element)
        {
            if($element['adminnaam'] == $admin)
            {
                return true;
            }
        }
        return false;
    }
}
?>