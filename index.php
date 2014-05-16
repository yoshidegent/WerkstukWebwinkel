<html xmlns="http://www.w3.org/1999/html">
    <head>
        <Title>Mijn webwinkel - Home</Title>

        <link rel="stylesheet" href="Style/html5reset-1.6.1.css" type="text/css">
        <link rel="stylesheet" href="Style/main.css" type="text/css">
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
                    <table id="productenTable">
                        <tr>

                            <th name="productId">Product ID</td>
                            <th name="productnaam">Productnaam</td>
                            <th name="prijsExclBtw">Prijs Excl. BTW</td>
                            <th name="prijsInclBtw">Prijs Incl. BTW</td>
                            <th name="detailLink">Detaillink</a></td>
                        </tr>
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
                                <td id="productId"><?php echo "$element->id"; ?></td>
                                <td id="productnaam"><?php echo "$element->naam"; ?></td>
                                <td id="prijsExclBtw"><?php echo "$prijsExclBtw"; ?> EUR</td>
                                <td id="prijsInclBtw"><?php echo "$prijsInclBtw"; ?> EUR</td>
                                <input type="hidden" name="product" value="<?php echo htmlspecialchars($serialized, ENT_QUOTES); ?>" />
                                <td id="detailLink"><input type="submit" value="Ga naar details" /></td>
                            </form>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                </article>
                <?php
                require_once 'pageFooter.php';
                ?>
            </article>
        </section>
    </body>
</html>