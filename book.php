<?
require_once('./require.php');

$book_id = (int) $_GET['id'];

$book = Book::get_full_by_id($book_id);

if (!$book) {
    // die(header('Location: /catalog.php'));
}

$book = $book->fetch_assoc();

$text = $_POST['comment_text'] ?? '';
$raiting = $_POST['comment_raiting'] ?? '';

$request = [];

if (isset($_POST['comment_create'])) {
    $request = BookCommentController::create($text, $raiting, $book_id, $_SESSION['user']['user_id']);

    if (!$request['type']) {
        $text = '';
        $raiting = '';
    }
}

$comments = BookComment::get($book_id, $_SESSION['user']['user_id'], 10, 0);
$my_comment = BookComment::get_my($book_id, $_SESSION['user']['user_id'])->fetch_assoc();
$comments_count = BookComment::get_count($book_id);
?>

<?= get_head($book['name']); ?>

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
                <a class="a breadcrumbs__link" href="/catalog.php">
                    Каталог
                </a>
            </li>
            <li class="breadcrumbs__item">
                <span class="breadcrumbs__this">
                    <?= $book['name'] ?>
                </span>
            </li>
        </ul>
    </div>
    <section class="product">
        <div class="container">
            <h2 class="product__title"><?= $book['name'] ?></h2>
            <div class="block-style product__content">
                <div class="product__image">
                    <img src="<?= $book['image'] ?>" alt="">
                </div>
                <div class="product__info">
                    <div class="product__info_top">
                        <div>
                            <div class="product__author"><?= $book['author_name'] . ' ' . $book['author_surname'] ?></div>
                            <strong class="product__name"><?= $book['name'] ?></strong>
                            <div class="product__views"><?= str_view_count($book['count_view']); ?></div>
                        </div>
                        <? if ($book['user_have']) : ?>
                            <div>
                                <a class="button product__buy" target="_blank" href="<?= $book['file_link'] ?>">Читать</a>
                            </div>
                        <? else : ?>
                            <div>
                                <button class="button product__buy">Купить</button>
                                <div class="product__price"><?= $book['price'] ?> ₽</div>
                            </div>
                        <? endif ?>
                    </div>
                    <? if ($book['description']) : ?>
                        <div class="product__description">
                            <?= $book['description'] ?>
                        </div>
                    <? endif ?>
                    <ul class="product__info_list">
                        <? if ($book['date']) : ?>
                            <li class="product__info_item product__date">
                                <strong>Дата выхода:</strong>
                                <span><?= $book['date'] ?></span>
                            </li>
                        <? endif ?>
                        <? if ($book['genre']) : ?>
                            <li class="product__info_item product__genre">
                                <strong>Жанр:</strong>
                                <span><?= $book['genre'] ?></span>
                            </li>
                        <? endif ?>
                        <? if ($book['book_type']) : ?>
                            <li class="product__info_item product__type">
                                <strong>Тип:</strong>
                                <span><?= $book['book_type'] ?></span>
                            </li>
                        <? endif ?>
                        <li class="product__info_item product__count-page">
                            <strong>Количество страниц:</strong>
                            <span><?= $book['count_page'] ?></span>
                        </li>
                        <? if ($book['raiting']) : ?>
                            <li class="product__info_item product__raiting">
                                <strong>Рейтинг:</strong>
                                <?= html_raiting($book['raiting'], '/5') ?>
                            </li>
                        <? endif ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="comments">
        <div class="container">
            <? if (!empty($_SESSION['user'])) : ?>
                <? if (empty($my_comment)) : ?>
                    <h2 class="comments__title">Оставьте свой отзыв</h2>
                    <? if ($request['message']) : ?>
                        <p class="message message-center <?= $request['type'] ? '_green-text' : '_red-text' ?>">
                            <strong><?= $request['message'] ?></strong>
                        </p>
                    <? endif; ?>
                    <form class="block-style comments__form" action="#" method="post">
                        <label class="label">
                            <span>Впечатление о книге</span>
                            <textarea class="input comments__textarea" name="comment_text" required><?= $text ?></textarea>
                        </label>
                        <div class="select">
                            <div class="select__switch">
                                <div class="select__input-block">
                                    <input class="select__input input" type="text" name="comment_raiting" value="<?= $raiting ?>" placeholder="Оценка" readonly required>
                                    <div class="select__icon"></div>
                                </div>
                            </div>
                            <ul class="select__list">
                                <li class="select__item">5</li>
                                <li class="select__item">4</li>
                                <li class="select__item">3</li>
                                <li class="select__item">2</li>
                                <li class="select__item">1</li>
                            </ul>
                        </div>
                        <button class="button" name="comment_create">Отправить</button>
                    </form>
                <? else : ?>
                    <h2 class="comments__title">Ваш отзыв</h2>
                    <div class="block-style comments__item comment">
                        <div class="comment__avatar">
                            <div class="comment__image">
                                <img src="/upload/<?= $my_comment['avatar'] ?>" alt="">
                            </div>
                        </div>
                        <div class="comment__info">
                            <div class="comment__info_top">
                                <strong class="comment__user-name"><?= $my_comment['name'] ?></strong>
                                <div class="comment__info_top_right">
                                    <a class="d-flex" href="/update/comment_book.php?id=<?= $my_comment['book_comment_id'] ?>">
                                        <svg class="svg-green-stroke" width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                        </svg>
                                    </a>
                                    <a class="d-flex" href="/delete/comment_book.php?id=<?= $my_comment['book_comment_id'] ?>">
                                        <svg class="svg-red-stroke" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="18" y1="6" x2="6" y2="18" />
                                            <line x1="6" y1="6" x2="18" y2="18" />
                                        </svg>
                                    </a>
                                    <span class="comment__raiting">Оценка: <?= html_raiting($my_comment['raiting'], '', 'comment__mark') ?></span>
                                </div>
                            </div>
                            <div class="comment__text"><?= $my_comment['text'] ?></div>
                            <div class="comment__date"><?= $my_comment['created_date'] ?></div>
                            <? if ($my_comment['created_date'] !== $my_comment['update_date']) : ?>
                                <div class="comment__date">(отредактировано в <?= $my_comment['update_date'] ?>)</div>
                            <? endif ?>
                        </div>
                    </div>
                    <br>
                <? endif ?>
            <? else : ?>
                <h2 class="comments__title"><a class="a" href="/login.php">Ввойдите</a>, чтобы оставить комментарий</h2>
            <? endif ?>
            <? if ($comments_count) : ?>
                <h2 class="comments__title">Комментарии</h2>
                <ul class="comments__list">
                    <? foreach ($comments as $comment) : ?>
                        <li class="block-style comments__item comment">
                            <div class="comment__avatar">
                                <div class="comment__image">
                                    <img src="/upload/<?= $comment['avatar'] ?>" alt="">
                                </div>
                            </div>
                            <div class="comment__info">
                                <div class="comment__info_top">
                                    <strong class="comment__user-name"><?= $comment['name'] ?></strong>
                                    <div class="comment__info_top_right">
                                        <span class="comment__raiting">Оценка: <?= html_raiting($comment['raiting'], '', 'comment__mark') ?></span>
                                    </div>
                                </div>
                                <div class="comment__text"><?= $comment['text'] ?></div>
                                <div class="comment__date"><?= $comment['created_date'] ?></div>
                                <? if ($comment['created_date'] !== $comment['update_date']) : ?>
                                    <div class="comment__date">(отредактировано в <?= $comment['update_date'] ?>)</div>
                                <? endif ?>
                            </div>
                        </li>
                    <? endforeach ?>
                </ul>
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
            <? else : ?>
                <h2 class="comments__title">Комментарии отсутствуют</h2>
            <? endif ?>
        </div>
    </section>
</main>

<?= get_footer(); ?>