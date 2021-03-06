<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и
        горнолыжное снаряжение.</p>
    <ul class="promo__list">
        <!--заполните этот список из массива категорий-->
        <?php foreach ($categories as $category): ?>
            <li class="promo__item promo__item--boards">
                <a class="promo__link" href="pages/all-lots.html"><?= $category['categories_name']; ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">
        <!--заполните этот список из массива с товарами-->
        <?php
        foreach ($lots as $promo): ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?= htmlspecialchars($promo['url_image']); ?>" width="350" height="260" alt="">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?= htmlspecialchars($promo['categories_name']); ?></span>
                    <h3 class="lot__title">
                        <a class="text-link" href="lot.php?id=<?= $promo['id'] ?>"><?= htmlspecialchars($promo['name']); ?></a>
                    </h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                                    <span class="lot__amount">
                                        <?= formatted_price($promo['start_price']); ?>
                                    </span>
                            <span class="lot__cost">цена<b class="rub">р</b></span>
                        </div>
                        <div class="lot__timer timer">
                            <?= $formatted_time; ?>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</section>