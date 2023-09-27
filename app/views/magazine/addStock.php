<?php
/** @var array $sidebar - Меню */
?>
<div class="page">
    <div class="container">
        <div class="cabinet_wrapped">
            <div class="cabinet_sidebar">
                <?php if (!empty($sidebar)) : ?>
                    <div class="menu_box">
                        <ul>
                            <?php foreach ($sidebar as $link) : ?>
                                <li>
                                    <a href="<?= $link['link'] ?>"><?= $link['title'] ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
<div class="container">
    <div class="addStockPage">
        <form method="post" name="addStock">
            <label for="nameStock">Name of stock</label>
            <input type="text" name="nameStock">

            <label for="shortDesc">Short Desc</label>
            <input type="text" name="shortDesc">

            <label for="descrip">Desc</label>
            <input type="text" name="descrip">

            <label for="price">Price</label>
            <input type="text" name="price">

            <input type="submit" value="Create" name="btnAddStock">
        </form>
    </div>
</div>
