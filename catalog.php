<?
require_once('./require.php');

$genres = Genre::get();
$book_types = BookType::get();

$genre = $_REQUEST['genre'];
$genre_id = $genre ? Genre::get_by_name(protect_data($genre)) : '';
if ($genre_id) $genre_id = $genre_id->fetch_assoc()['genre_id'];

$format = array_map('intval', $_REQUEST['format'] ?? []);
$price_min = $_REQUEST['price_min'];
$price_max = $_REQUEST['price_max'];

$page_number = get_page_counter($_REQUEST['page'], 20);
$books = Book::get_catalog($genre, $price_min, $price_max, $format, 20, $page_number);
$book_count = Book::get_catalog_count($genre, $price_min, $price_max, $format);
$count_pages = count_pages($book_count, 20);
?>

<?= get_head('Каталог книг'); ?>

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
                    Каталог
                </span>
            </li>
        </ul>
    </div>
    <section class="catalog">
        <div class="container">
            <h2 class="catalog__title">Каталог</h2>
            <div class="catalog__container">
                <aside class="catalog__aside">
                    <form class="catalog__aside_form" action="#" method="get">
                        <div class="select">
                            <div class="select__switch">
                                <!-- <div class="select__title">Жанр</div> -->
                                <div class="select__input-block">
                                    <input class="select__input" type="text" name="genre" placeholder="Жанр" value="<?= $genre ?>" readonly>
                                    <div class="select__icon"></div>
                                </div>
                            </div>
                            <ul class="select__list">
                                <? foreach ($genres as $genre) : ?>
                                    <li class="select__item"><?= $genre['name'] ?></li>
                                <? endforeach ?>
                            </ul>
                        </div>
                        <div class="block-style catalog__aside_filter price">
                            <div class="filter__title">Цена</div>
                            <div class="filter__inputs">
                                <input class="input-second input__filter" name="price_min" min="0" value="<?= $price_min ?>" type="number" placeholder="От">
                                <input class="input-second input__filter" name="price_max" min="1" value="<?= $price_max ?>" type="number" placeholder="До">
                            </div>
                        </div>
                        <div class="block-style catalog__aside_filter type">
                            <div class="filter__title">Формат</div>
                            <ul class="filter__list">
                                <? foreach ($book_types as $book_type) : ?>
                                    <li class="filter__item">
                                        <label class="checkbox">
                                            <input class="checkbox__input" name="format[]" value="<?= $book_type['book_type_id'] ?>" type="checkbox" <?= array_search($book_type['book_type_id'], $format) !== false ? 'checked' : '' ?> hidden>
                                            <span class="checkbox__icon"></span>
                                            <span><?= $book_type['name'] ?></span>
                                        </label>
                                    </li>
                                <? endforeach ?>
                            </ul>
                        </div>
                        <button class="button catalog__aside_button">Поиск</button>
                        <a class="button catalog__aside_button" href="<?= strtok($_SERVER["REQUEST_URI"], '?') ?>">Сброс</a>
                    </form>
                </aside>
                <div class="catalog__shop">
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
                                    <div class="catalog-product__info_bottom">
                                        <a class="button" href="/book.php?id=<?= $book['book_id'] ?>">Подробнее</a>
                                    </div>
                                </div>
                            </li>
                        <? endforeach ?>
                    </ul>
                </div>
            </div>
            <?= get_pagination($page_number, $count_pages); ?>
        </div>
    </section>
</main>

<?= get_footer(); ?>