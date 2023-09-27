<?php
/** @var array $sidebar - Меню */
/** @var string $role - Список новостей */
/** @var array $stock - Роль пользователя */
use app\lib\UserOperation;
?>
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


    <div class="cabinet_content">
        <dib class="page-content-inner">
            <h2>Новости</h2>
            <div class="news-block">
                <div class="links_box text-end">
                    <a href="/news/add">Добавить</a>
                </div>
                <?php if (!empty($stock)) : ?>
                    <div class="news-list">
                        <?php foreach ($stock as $item) :?>
                            <div class="news-item">
                                <h3>
                                    <?=$item['title']?>
                                    <?php if ($role === UserOperation::RoleSeller or $role === UserOperation::RoleAdmin) :?>
                                        (<a href="/news/edit?stock_id=<?=$item['id']?>">редактировать</a>
                                        <a href="/news/delete?stock_id=<?=$item['id']?>">Удалить</a>)
                                    <?php endif ?>
                                </h3>
                                <div class="news-short_description"><?=$item['shortDesc']?></div>
                                <div class="news-description"><?=$item['descrip']?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </dib>
    </div>
</div>
</div>
</div>
