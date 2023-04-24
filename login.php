<?
require_once('./require.php');

if (!empty($_SESSION['user'])) {
    die(header('Location: /profile.php?id=' . $_SESSION['user']['user_id']));
}

$request = [];

if (isset($_POST['logining'])) {
    $email = $_POST['user_email'];
    $password = $_POST['user_password'];

    $request = UserController::login($email, $password);
}
?>

<?= get_head('Вход'); ?>

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
                    Вход
                </span>
            </li>
        </ul>
    </div>
    <section class="auth login">
        <div class="container">
            <h2 class="auth__title">Авторизация</h2>
            <? if ($request['message']) : ?>
                <p class="message message-center <?= $request['type'] ? '_green-text' : '_red-text' ?>">
                    <strong><?= $request['message'] ?></strong>
                </p>
            <? endif; ?>
            <form class="block-style auth__form login__form" action="#" method="post">
                <label class="label">
                    <span>Электронная почта</span>
                    <input class="input" type="email" name="user_email" required>
                </label>
                <label class="label">
                    <span>Пароль</span>
                    <input class="input" type="password" name="user_password" required>
                </label>
                <div class="auth__bottom">
                    <button class="button auth__button login__button" name="logining">Вход</button>
                    <div>Нет аккаунта? <a class="a" href="/registration.php">Создать</a></div>
                </div>
            </form>
        </div>
    </section>
</main>

<?= get_footer(); ?>