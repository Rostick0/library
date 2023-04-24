<?
require_once('./require.php');

$genres = Genre::get();
$book_types = BookType::get();

$genre = $_REQUEST['genre'];
$genre = $genre ? Genre::get_by_name(protect_data($genre)) : '';
if ($genre) $genre = $genre->fetch_assoc()['genre_id'];

$sort = $_REQUEST['sort'];

$price_min = $_REQUEST['price_min'];
$price_max = $_REQUEST['price_max'];

$books = Book::get_catalog($genre, $price_min, $price_max, 20, 0);
var_dump($books);
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
                                    <input class="select__input" type="text" name="genre" placeholder="Жанр" readonly>
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
                                <input class="input-second input__filter" name="price_min" min="0" type="number" placeholder="От">
                                <input class="input-second input__filter" name="price_max" min="1" type="number" placeholder="До">
                            </div>
                        </div>

                        <div class="block-style catalog__aside_filter type">
                            <div class="filter__title">Формат</div>
                            <ul class="filter__list">
                                <? foreach ($book_types as $book_type) : ?>
                                    <li class="filter__item">
                                        <label class="checkbox">
                                            <input class="checkbox__input" type="checkbox" hidden>
                                            <span class="checkbox__icon"></span>
                                            <span><?= $book_type['name'] ?></span>
                                        </label>
                                    </li>
                                <? endforeach ?>
                            </ul>
                        </div>
                        <button class="button catalog__aside_button">Поиск</button>
                    </form>
                </aside>
                <div class="catalog__shop">
                    <div class="catalog__switch"></div>
                    <div class="block-style catalog__sort">
                        <strong class="catalog__sort_title">Сортировать по:</strong>
                        <ul class="catalog__sort_list">
                            <li class="catalog__sort_item">
                                <a class="a" href="">Рейтингу</a>
                            </li>
                            <li class="catalog__sort_item">
                                <a class="a" href="">Количеству просмотров</a>
                            </li>
                            <li class="catalog__sort_item">
                                <a class="a" href="">Цене</a>
                            </li>
                        </ul>
                    </div>
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