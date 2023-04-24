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
                            <li class="block-style main__product catalog-product">
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
                            <li class="block-style main__product catalog-product">
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
                </div>
            </div>
        </section>
        <section class="catalog">
            <div class="container">
                <h2 class="catalog__title">Популярно</h2>
                <div class="catalog__container">
                    <div class="catalog__shop">
                        <ul class="main__products">
                            <li class="block-style main__product catalog-product">
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
                            <li class="block-style main__product catalog-product">
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
                </div>
            </div>
        </section>
        <section class="catalog">
            <div class="container">
                <h2 class="catalog__title">Выбор читателей</h2>
                <div class="catalog__container">
                    <div class="catalog__shop">
                        <ul class="main__products">
                            <li class="block-style main__product catalog-product">
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
                            <li class="block-style main__product catalog-product">
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
                </div>
            </div>
        </section>
        <section class="catalog">
            <div class="container">
                <h2 class="catalog__title">Самое обсуждаемое</h2>
                <div class="catalog__container">
                    <div class="catalog__shop">
                        <ul class="main__products">
                            <li class="block-style main__product catalog-product">
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
                            <li class="block-style main__product catalog-product">
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
                </div>
            </div>
        </section>
    </div>
</main>

<?= get_footer(); ?>