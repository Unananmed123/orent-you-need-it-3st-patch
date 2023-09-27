<?php
/** @var array $sidebar - Меню */
?>

<div class="cabinet_sidebar">
    <?php if (!empty($sidebar)) : ?>
        <div class="menu_box">
            <ul>
                <?php foreach ($sidebar as $link) : ?>
                    <li>
                        <a class='link' href="<?= $link['link'] ?>"><?= $link['title'] ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>
