<?
require_once(__DIR__ . './../require.php');

$book_comment_id = $_GET['id'];

$comment = BookComment::get_by_id($book_comment_id)->fetch_assoc();

$request = [];

$text = $_POST['comment_text'] ?? $comment['text'];
$raiting = $_POST['comment_raiting'] ?? $comment['raiting'];

if (isset($_POST['comment_update'])) {
    $request = BookCommentController::update($book_comment_id, $text, $raiting, $_SESSION['user']['user_id']);
}

?>
<?= get_head($book['name']); ?>

<?= get_header(); ?>

<main class="main">
    <section class="comments">
        <div class="container">
            <h2 class="comments__title">Комментарии</h2>
            <div class="block-style comments__item comment">
                <div class="comment__avatar">
                    <div class="comment__image">
                        <img src="/upload/<?= $comment['avatar'] ?>" alt="">
                    </div>
                </div>
                <div class="comment__info">
                    <div class="comment__info_top">
                        <strong class="comment__user-name"><?= $comment['name'] ?></strong>
                        <div class="comment__info_top_right">
                            <span class="comment__raiting">Оценка: <span class="comment__mark _green-text">5</span></span>
                        </div>
                    </div>
                    <div class="comment__text"><?= $comment['text'] ?></div>
                    <div class="comment__date"><?= $comment['created_date'] ?></div>
                    <? if ($comment['created_date'] !== $comment['update_date']) : ?>
                        <div class="comment__date">(отредактировано в <?= $comment['update_date'] ?>)</div>
                    <? endif ?>
                </div>
            </div>
            <br />
            <br />
            <br />
            <h2 class="comments__title">Редактирование комментария</h2>
            <? if ($request['message']) : ?>
                <p class="message message-center <?= $request['type'] ? '_green-text' : '_red-text' ?>">
                    <strong><?= $request['message'] ?></strong>
                </p>
            <? endif; ?>
            <form class="block-style comments__form" action="#" method="post">
                <label class="label">
                    <span>Впечатление о книге</span>
                    <textarea class="input comments__textarea" name="comment_text" required><?= $comment['text'] ?></textarea>
                </label>
                <div class="select">
                    <div class="select__switch">
                        <div class="select__input-block">
                            <input class="select__input input" type="text" name="comment_raiting" value="<?= $comment['raiting'] ?>" placeholder="Оценка" readonly="" required="">
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
                <button class="button" name="comment_update">Изменить</button>
            </form>
        </div>
    </section>
</main>

<?= get_footer(); ?>