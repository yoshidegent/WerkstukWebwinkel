<html xmlns="http://www.w3.org/1999/html">
<?php
    require 'DataModels/Product.php';

    $unserialized = unserialize($_GET['product']);

    if(!$unserialized)
    {
        header("Location: index.php");
        exit;
    }

    $product = new Product($unserialized->id, $unserialized->naam, $unserialized->prijsExclBtw, $unserialized->imgUrl, $unserialized->beschrijving);

    $prijsExclBtw = number_format($product->prijsExclBtw, 2);
    $prijsInclBtw = number_format($product->prijsInclBtw(), 2);
?>
<head>
    <Title>Mijn webwinkel - <?php echo "$product->naam"; ?></Title>

    <link rel="stylesheet" href="Style/html5reset-1.6.1.css" type="text/css">
    <link rel="stylesheet" href="Style/main.css" type="text/css">
</head>
<body>
<section>
    <?php
        require 'pageHeader.php';
    ?>
    <article id="pageContent">
        <header>
            <h1 style="margin-left:0px; font-size:50px;"><a style="text-decoration:none;" href="index.php">< <?php echo "$product->naam"; ?></a></h1>
        </header>
        <article>
            <table id="productInfoTable">
                <tr>
                    <td id="productImage">
                        <figure>
                            <img src="<?php echo "$product->imgUrl" ?>">
                        </figure>
                    </td>
                    <td id="productValues">
                        <section>
                            <div>
                                <h2>Product ID: </h2>
                                <p><?php echo "$product->id" ?></p>
                            </div>
                            <div>
                                <h2>Prijs zonder BTW: </h2>
                                <p><?php echo "$prijsExclBtw"; ?> EURO</p>
                            </div>
                            <div>
                                <h2>Prijs met BTW: </h2>
                                <p><?php echo "$prijsInclBtw"; ?> EURO</p>
                            </div>
                        </section>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" id="productBeschrijving">
                        <div>
                            <h2>
                                Beschrijving:
                            </h2>
                            <p>
                                <?php
                                echo "$product->beschrijving";
                                ?>
                            </p>
                        </div>
                    </td>
                </tr>
            </table>
        </article>
        <?php
        require_once 'pageFooter.php';
        ?>
    </article>
</section>
</body>
</html>