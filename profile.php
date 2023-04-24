<?
require_once('./require.php');

$user_id = (int) $_REQUEST['id'];
$user = User::get_by_id($user_id)->fetch_assoc();
?>

<?= get_head('Профиль'); ?>

<?= get_header(); ?>

<main class="main">
    <div class="container">
        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a class="a breadcrumbs__link" href="/">
                    Главная
                </a>
            </li>
            <li class="breadcrumbs__item">
                <span class="breadcrumbs__this">
                    Профиль
                </span>
            </li>
        </ul>
    </div>
    <section class="profile">
        <div class="container">
            <h2 class="profile__title"><?= $user['name'] ?></h2>
            <div class="block-style profile__content">
                <div class="profile__avatar">
                    <!-- <img src="https://sun1-99.userapi.com/s/v1/ig2/f_jQA15dKwId1pJbLBPEhYwtEfI9UZVD2fLL8ZAf2CKrKOlBV4xstcmoACh_3hsIZ3eP1ujCc_MLn31sRODUQT2K.jpg?size=200x200&quality=95&crop=122,260,404,404&ava=1" alt=""> -->
                    <div class="profile__image">
                        <img src="<?= '/upload/' . $user['avatar'] ?>" alt="" loading="lazy">
                    </div>
                </div>
                <div class="profile__info">
                    <ul class="profile__info_list">
                        <li class="profile__info_item">
                            <strong>Имя:</strong>
                            <span><?= $user['name'] ?></span>
                        </li>
                        <? if ($user['surname']) : ?>
                            <li class="profile__info_item">
                                <strong>Фамилия:</strong>
                                <span><?= $user['surname'] ?></span>
                            </li>
                        <? endif; ?>
                        <? if ($user['patronymic']) : ?>
                            <li class="profile__info_item">
                                <strong>Отчество:</strong>
                                <span><?= $user['patronymic'] ?></span>
                            </li>
                        <? endif; ?>
                        <? if ($user['telephone']) : ?>
                            <li class="profile__info_item">
                                <strong>Телефон:</strong>
                                <span><?= $user['telephone'] ?></span>
                            </li>
                        <? endif; ?>
                        <li class="profile__info_item">
                            <strong>E-mail:</strong>
                            <span><?= $user['email'] ?></span>
                        </li>
                        <? if ($user['birth']) : ?>
                            <li class="profile__info_item">
                                <strong>Дата рождения:</strong>
                                <span><?= $user['birth'] ?></span>
                            </li>
                        <? endif; ?>
                    </ul>
                    <div class="profile__info_bottom">
                        <a class="button profile__edit" href="/profile-edit.php">Редактировать</a>
                        <a class="_red-text" href="/logout.php">Выйти</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="catalog">
        <div class="container">
            <h2 class="catalog__title">Мои книги</h2>
            <div class="catalog__container">
                <ul class="catalog__products">
                    <li class="block-style catalog__product catalog-product">
                        <div class="catalog-product__image">
                            <img src="https://sun6-21.userapi.com/impg/wN6SFFR4fZVqdvt3ztmF54GoZ3v1YNMVj3aLuw/tyQmDKVkM3Q.jpg?size=83x130&quality=96&sign=80a582ad117518a988db2b2552f440a8&c_uniq_tag=3GlGXkCLhUdVQ3m-DXw4tMRrrhoS55svZYy2APZvudU&type=album" alt="">
                        </div>
                        <div class="catalog-product__info">
                            <div class="catalog-product__author">Лев Толстой</div>
                            <strong class="catalog-product__title">Война и Мир</strong>
                            <div class="catalog-product__views">30K просмотров</div>
                            <div class="catalog-product__price">30 000 ₽</div>
                        </div>
                    </li>
                    <li class="block-style catalog__product catalog-product">
                        <div class="catalog-product__image">
                            <img src="https://tse3.mm.bing.net/th?id=OIP.sNpF_q79DgckAIL2eQrQiQHaLh&pid=Api" alt="">
                        </div>
                        <div class="catalog-product__info">
                            <div class="catalog-product__author">Федор Достоевский</div>
                            <strong class="catalog-product__title">Преступление и наказание</strong>
                            <div class="catalog-product__views">985 просмотров</div>
                            <div class="catalog-product__price">30 000 ₽</div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="pagination">
                <ul class="block-style pagination_list">
                    <li class="pagination_item">
                        <a class="a" href="">1</a>
                    </li>
                    <li class="pagination_item">
                        <a class="a" href="">2</a>
                    </li>
                    <li class="pagination_item">
                        <a class="a" href="">3</a>
                    </li>
                    <li class="pagination_item">
                        <a class="a" href="">4</a>
                    </li>
                    <li class="pagination_item">
                        <a class="a" href="">5</a>
                    </li>
                    <li class="pagination_item">
                        <span class="a">...</span>
                    </li>
                    <li class="pagination_item">
                        <a class="a" href="">235</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</main>

<?= get_footer(); ?>