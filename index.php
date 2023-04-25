<?
require_once('./require.php');
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/index.css">
    <title>Библиотека</title>
</head>

<?= get_header(); ?>

<main class="main">
    <div class="greeting">
        <div class="container">
            <div class="block-style greeting__container">
                <div class="greeting__info">
                    <h1 class="greeting__title">Книги на любой вкус и цвет</h1>
                    <div class="greeting__list-title">На нашем сервисом вы получите:</div>
                    <ul class="ul">
                        <li class="li">Более 1000+ книг</li>
                        <li class="li">Доступ 24/7</li>
                        <li class="li">Быстрый поиск</li>
                        <li class="li">Простая регистрация</li>
                    </ul>
                    <div class="greeting__info_bottom">
                        <div>Начните пользоваться прямо сейчас:</div>
                        <a class="button greeting__button" href="/registration.php">Регистрация</a>
                    </div>
                </div>
                <div class="greeting__image">
                    <img src="/img/greeting-liblary.jpg" alt="Библиотека">
                </div>
            </div>
        </div>
    </div>

    <div class="main__catalog">
        <section class="catalog">
            <div class="container">
                <h2 class="catalog__title">Новинки</h2>
                <div class="catalog__container">
                    <div class="catalog__shop">
                        <ul class="main__products">
                            <? foreach (Book::get_order_by('date') as $book) : ?>
                                <li class="block-style main__product catalog-product">
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
            </div>
        </section>
        <section class="catalog">
            <div class="container">
                <h2 class="catalog__title">Популярно</h2>
                <div class="catalog__container">
                    <div class="catalog__shop">
                        <ul class="main__products">
                            <? foreach (Book::get_order_by('count_view') as $book) : ?>
                                <li class="block-style main__product catalog-product">
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
            </div>
        </section>
        <section class="catalog">
            <div class="container">
                <h2 class="catalog__title">Выбор читателей</h2>
                <div class="catalog__container">
                    <div class="catalog__shop">
                        <ul class="main__products">
                            <? foreach (Book::get_order_by('count_reader') as $book) : ?>
                                <li class="block-style main__product catalog-product">
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
            </div>
        </section>
        <section class="catalog">
            <div class="container">
                <h2 class="catalog__title">Самое обсуждаемое</h2>
                <div class="catalog__container">
                    <div class="catalog__shop">
                        <ul class="main__products">
                            <? foreach (Book::get_order_by('count_comment') as $book) : ?>
                                <li class="block-style main__product catalog-product">
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
            </div>
        </section>
    </div>
</main>

<?= get_footer(); ?>