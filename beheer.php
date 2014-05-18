<?php
require_once 'DB/CRUD/AdminDao.php';
require_once 'DB/CRUD/ProductDao.php';
require_once 'DataModels/Product.php';

$admin = $_POST['naam'];
$isAdmin;
if(!AdminDao::isAdmin($admin))
{
    $isAdmin = false;
}
else
{
    $isAdmin = true;
}

if(isset($_POST['verwijderSubmit']))
{
    $productId = $_POST['productId'];
    verwijder($productId);
}
elseif(isset($_POST['opslaanSubmit']))
{
    $productnaam = $_POST['productnaam'];
    $prijsExclBtw = $_POST['prijsExclBtw'];
    $imgUrl = $_POST['imgUrl'];
    $beschrijving = $_POST['beschrijving'];

    $product = new Product("", $productnaam, $prijsExclBtw, $imgUrl, $beschrijving);
    voegToe($product);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html" lang="en_US" xml:lang="en_US">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="en" />
    <meta name="GENERATOR" content="PHPEclipse 1.2.0" />

    <Title>Mijn webwinkel - Home</Title>

    <link rel="stylesheet" href="Style/html5reset-1.6.1.css" type="text/css">
    <link rel="stylesheet" href="Style/main.css" type="text/css">

    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="Js/popup.js" type="text/javascript"></script>
</head>
<body>

<a href="index.php" id="afmeldBtn">Afmelden</a>

<div class="popup" id="voegToePopup">
    <form id="popupForm" class="popupForm" action="beheer.php" method="post">
        <input type="hidden" name="naam" value="<?php echo $admin ?>" />
        <table>
            <tr>
                <td><label for="productnaamInput">Productnaam: </label></td>
                <td><input id="productnaamInput" type="text" name="productnaam" /></td>
            </tr>
            <tr>
                <td><label for="prijsExclBtwInput">Prijs zonder BTW: </label></td>
                <td><input id="prijsExclBtwInput" type="text" name="prijsExclBtw" /></td>
            </tr>
            <tr>
                <td><label for="imgUrlInput">Afbeelding URL: </label></td>
                <td><input id="imgUrlInput" type="text" name="imgUrl" /></td>
            </tr>
            <tr>
                <td colspan="2"><label id="beschrijvingLbl" for="beschrijvingTA">Beschrijving: </label><br><textarea id="beschrijvingTA" type="text" name="beschrijving"></textarea></td>
            </tr>
        </table>
        <input id="opslaanBtn" type="submit" value="Opslaan" name="opslaanSubmit"/>
    </form>

</div>


<section>
    <?php
    require_once 'pageHeader.php';
    ?>
    <article id="pageContent">
        <header>
            <h1>Welkom <?php echo $admin ?>, u bent <?php if(!$isAdmin){echo "g";}?>een admin.</h1>
        </header>
        <article>
            <table id="productenTable" class="table">
                <thead>
                <tr id="tableHeaderRow">

                    <th name="productId">Product ID</td>
                    <th name="productnaam">Productnaam</td>
                    <th name="prijsExclBtw">Prijs Excl. BTW</td>
                    <th name="prijsInclBtw">Prijs Incl. BTW</td>
                    <th name="detailLink">Admin operaties</a></td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="5">
                        <div class="table-wrap" >
                            <table class="table-dalam">
                                <tbody>
                                <?php
                                require_once 'DB/CRUD/ProductDao.php';

                                $producten = ProductDao::getAll();

                                foreach($producten as $element)
                                {
                                    $prijsExclBtw = number_format($element->prijsExclBtw, 2);
                                    $prijsInclBtw = number_format($element->prijsInclBtw(), 2);
                                    $serialized = serialize($element);
                                    ?>
                                    <tr>
                                            <td id="productId" class="td-nya"><?php echo "$element->id"; ?></td>
                                            <td id="productnaam" class="td-nya"><?php echo "$element->naam"; ?></td>
                                            <td id="prijsExclBtw" class="td-nya"><?php echo "$prijsExclBtw"; ?> EUR</td>
                                            <td id="prijsInclBtw" class="td-nya"><?php echo "$prijsInclBtw"; ?> EUR</td>
                                            <td class="td-nya adminOperatie">
                                                <form action="beheer.php" method="post">
                                                    <input type="hidden" name="naam" value="<?php echo $admin ?>" />
                                                    <input type="hidden" name="productId" value="<?php echo $element->id ?>" />
                                                    <input type="submit" id="verwijderBtn" value="Verwijder" name="verwijderSubmit" <?php if(!$isAdmin){echo "disabled";}?>/>
                                                </form>
                                            </td>
                                    </tr>
                                <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <form style="text-align:right; padding:5%; padding-top:20px;">
                <input id="voegProductToeBtn" type="button" value="Voeg een product toe" name="voegToeSubmit" class="popupBtn" style="cursor:pointer;"/>
            </form>

            <?php
            function verwijder($id)
            {
                ProductDao::deleteById($id);
            }
            ?>

            <?php
            function voegToe($p)
            {
                productDao::insert($p);
            }
            ?>
        </article>
    </article>
</section>
</body>
</html>