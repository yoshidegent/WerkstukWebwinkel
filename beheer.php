<?php

require_once 'DB/CRUD/AdminDao.php';
$admin = $_POST["naam"];

var_dump($admin);

if(!AdminDao::isAdmin($admin))
{
    echo "<script type='text/javascript'>alert('You are not an admin!');</script>";
    //header("Location: index.php");
    //exit;
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
    <script src="Js/beheerPopup.js" type="text/javascript"></script>
</head>
<body>
<a href="index.php" id="afmeldBtn">Afmelden</a>
<section>
    <?php
    require_once 'pageHeader.php';
    ?>
    <article id="pageContent">
        <header>
            <h1>Welkom <?php echo $admin ?>, u bent een admin.</h1>
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
                                                <form action="detail.php" method="get">
                                                    <input type="hidden" name="product" value="<?php echo htmlspecialchars($serialized, ENT_QUOTES); ?>" />
                                                    <input type="submit" value="Pas aan" />
                                                </form>
                                                <form action="detail.php" method="get">
                                                    <input type="hidden" name="product" value="<?php echo htmlspecialchars($serialized, ENT_QUOTES); ?>" />
                                                    <input type="submit" value="Verwijder" />
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
            <form action="bewerk.php" style="text-align:right; padding:5%; padding-top:20px;">
                <input id="voegProductToeBtn" type="submit" value="Voeg een product toe" />
            </form>
        </article>
    </article>
</section>
</body>
</html>