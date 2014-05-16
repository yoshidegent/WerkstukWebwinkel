<?php
//Kopieer deze template en pas deze aan naargelang de benodigde functionaliteit
include_once 'DataModels/Product.php';
include_once 'DB/Connection/DatabaseFactory.php';

class ProductDao
{
    private static function getVerbinding()
    {
        return DatabaseFactory::getDatabase();
    }

    public static function getAll()
    {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM producten");
        $resultatenArray = array();

        for ($index = 0; $index < $resultaat->num_rows; $index++)
        {
            $databaseRij = $resultaat->fetch_array();
            $nieuw = self::converteerRijNaarObject($databaseRij);
            $resultatenArray[$index] = $nieuw;
        }

        return $resultatenArray;
    }

    protected static function converteerRijNaarObject($databaseRij)
    {
        return new Product($databaseRij['product_id'], $databaseRij['product_naam'], $databaseRij['prijs_excl_btw'], $databaseRij['img_url'], $databaseRij['beschrijving']);
    }

    /*
    public static function getByTitel($titel)
    {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM boeken WHERE titel='?'", array($titel));
        $resultatenArray = array();

        for ($index = 0; $index < $resultaat->num_rows; $index++)
        {
            $databaseRij = $resultaat->fetch_array();
            $nieuw = self::converteerRijNaarObject($databaseRij);
            $resultatenArray[$index] = $nieuw;
        }

        return $resultatenArray;
    }

    public static function getById($id)
    {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM boeken WHERE boekId=?", array($id));
        if ($resultaat->num_rows == 1)
        {
            $databaseRij = $resultaat->fetch_array();
            return self::converteerRijNaarObject($databaseRij);
        }
        else
        {
            //Er is waarschijnlijk iets mis gegaan
            return false;
        }
    }

    public static function insert($boek)
    {
        return self::getVerbinding()->voerSqlQueryUit("INSERT INTO boeken(titel, uitgavedatum, prijs_excl_btw, email_uitgeverij) VALUES ('?','?',?,'?')", array($boek->titel, $boek->uitgavedatum, $boek->prijsExclBtw, $boek->emailUitgeverij));
    }

    public static function deleteById($id)
    {
        return self::getVerbinding()->voerSqlQueryUit("DELETE FROM boeken where boekId=?", array($id));
    }

    public static function delete($boek)
    {
        return self::deleteById($boek->boekId);
    }

    public static function update($boek)
    {
        return self::getVerbinding()->voerSqlQueryUit("UPDATE boeken SET titel='?',uitgavedatum='?', prijs_excl_btw='?', email_uitgeverij='?' WHERE boekId=?", array($boek->titel, $boek->uitgavedatum, $boek->prijsExclBtw, $boek->emailUitgeverij, $boek->boekId));
    }
    */

}