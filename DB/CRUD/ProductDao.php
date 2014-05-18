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

    public static function update($product)
    {
        return self::getVerbinding()->voerSqlQueryUit
            ("UPDATE producten SET product_naam=?, prijs_excl_btw=?, img_url=?, beschrijving=? WHERE product_id=?",
                array($product->naam, $product->prijsExclBtw, $product->imgUrl, $product->beschrijving, $product->id));
    }

    public static function insert($product)
    {
        return self::getVerbinding()->voerSqlQueryUit
            ("INSERT INTO producten(product_naam, prijs_excl_btw, img_url, beschrijving) VALUES(?, ?, ?, ?)",
                array($product->naam, $product->prijsExclBtw, $product->imgUrl, $product->beschrijving));
    }

    public static function deleteById($productId)
    {
        return self::getVerbinding()->voerSqlQueryUit("Delete FROM producten WHERE product_id=?", array($productId));
    }

    public static function delete($product)
    {
        return self::deleteById($product->id);
    }
}