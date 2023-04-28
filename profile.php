<?
require_once('./require.php');

$user_id = (int) $_REQUEST['id'];
$user = User::get_by_id($user_id)->fetch_assoc();

$page_number = get_page_counter($_REQUEST['page'], 20);
$books = Book::get_by_user($user_id, 20, $page_number);
$book_count = Book::get_count_by_user($user_id);
$count_pages = count_pages($book_count, 20);

var_dump($books->num_rows);
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
                    <div class="profile__image">
                        <? if ($user['avatar'] && file_exists('/upload/' . $user['avatar'])) : ?>
                            <img src="<?= '/upload/' . $user['avatar'] ?>" alt="<?= $user['name'] . ' ' . $user['surname'] ?>" loading="lazy">
                        <? else : ?>
                            <img src="<?= '/img/default_avatar.png' ?>" alt="Аватарка" loading="lazy">
                        <? endif ?>
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
            <? if ($book_count > 0) : ?>
                <h2 class="catalog__title">Мои книги</h2>
                <div class="catalog__container">
                    <ul class="catalog__products">
                        <? foreach ($books as $book) : ?>
                            <li class="block-style catalog__product catalog-product">
                                <a class="catalog-product__image" href="/book.php?id=<?= $book['book_id'] ?>">
                                    <img src="<?= $book['image'] ?>" alt="<?= $book['name'] ?>">
                                </a>
                                <div class="catalog-product__info">
                                    <div class="catalog-product__author"><?= $book['author_name'] . ' ' . $book['author_surname'] ?></div>
                                    <strong class="catalog-product__title"><?= $book['name'] ?></strong>
                                    <div class="catalog-product__views"><?= str_view_count($book['count_view']) ?></div>
                                    <div class="catalog-product__price"><?= $book['price'] ?> ₽</div>
                                </div>
                            </li>
                        <? endforeach ?>
                    </ul>
                </div>
            <? endif; ?>
            <?= get_pagination($page_number, $count_pages); ?>
        </div>
    </section>
</main>

<?= get_footer(); ?>