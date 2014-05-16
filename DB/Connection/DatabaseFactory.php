<?php
//In deze klasse moet je in principe alleen de connectiegegevens voor jou mysql server aanpassen.
include_once 'DB/Connection/Database.php';

class DatabaseFactory {

    //Singleton
    private static $verbinding;

    public static function getDatabase() {

        if (self::$verbinding == null) {
            $mijnComputernaam = "iwtsl.ehb.be";
            $mijnGebruikersnaam = "wda038";
            $mijnWachtwoord = "41286759";
            $mijnDatabase = "wda038";
            self::$verbinding = new Database($mijnComputernaam, $mijnGebruikersnaam, $mijnWachtwoord, $mijnDatabase);
        }
        return self::$verbinding;
    }

}
?>