<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en_US" xml:lang="en_US">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="en" />
    <meta name="GENERATOR" content="PHPEclipse 1.2.0" />

    <Title>Mijn webwinkel - Home</Title>

    <link rel="stylesheet" href="Style/html5reset-1.6.1.css" type="text/css">
    <link rel="stylesheet" href="Style/main.css" type="text/css">

    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
</head>
<body>
        <section>
            <?php
                require_once 'pageHeader.php';
            ?>
            <article id="pageContent">
                <header>
                    <h1>Home</h1>
                </header>
                <article>
                    <table id="productenTable" class="table">
                        <thead>
                            <tr id="tableHeaderRow">

                                <th name="productId">Product ID</td>
                                <th name="productnaam">Productnaam</td>
                                <th name="prijsExclBtw">Prijs Excl. BTW</td>
                                <th name="prijsInclBtw">Prijs Incl. BTW</td>
                                <th name="detailLink">Detaillink</a></td>
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
                                                        <form action="detail.php" method="get">
                                                            <td id="productId" class="td-nya"><?php echo "$element->id"; ?></td>
                                                            <td id="productnaam" class="td-nya"><?php echo "$element->naam"; ?></td>
                                                            <td id="prijsExclBtw" class="td-nya"><?php echo "$prijsExclBtw"; ?> EUR</td>
                                                            <td id="prijsInclBtw" class="td-nya"><?php echo "$prijsInclBtw"; ?> EUR</td>
                                                            <input type="hidden" name="product" value="<?php echo htmlspecialchars($serialized, ENT_QUOTES); ?>" />
                                                            <td id="detailLink" class="td-nya"><input type="submit" value="Ga naar details" /></td>
                                                        </form>
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
                </article>
                <?php
                require_once 'pageFooter.php';
                ?>
            </article>
        </section>
</body>
</html>