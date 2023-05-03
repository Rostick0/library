<?
require_once('./require.php');

if (!empty($_SESSION['user'])) {
    die(header('Location: /profile.php?id=' . $_SESSION['user']['user_id']));
}

$request = [];

$user_name = $_POST['user_name'] ?? '';
$user_surname = $_POST['user_surname'] ?? '';
$user_patronymic = $_POST['user_patronymic'] ?? '';
$user_avatar = $_FILES['user_avatar'] ?? '';
$user_telephone = $_POST['user_telephone'] ?? '';
$user_email = $_POST['user_email'] ?? '';
$user_password = $_POST['user_password'] ?? '';
$user_birth = $_POST['user_birth'] ?? '';

if (isset($_POST['register'])) {
    $request = UserController::create(
        $user_name,
        $user_surname,
        $user_patronymic,
        $user_avatar,
        $user_telephone,
        $user_email,
        $user_password,
        $user_birth
    );
}

?>

<?= get_head('Регистрация'); ?>

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
                    Регистрация
                </span>
            </li>
        </ul>
    </div>
    <section class="auth registration">
        <div class="container">
            <h2 class="auth__title">Создание аккаунта</h2>
            <? if ($request['message']) : ?>
                <p class="message message-center <?= $request['type'] ? '_green-text' : '_red-text' ?>">
                    <strong><?= $request['message'] ?></strong>
                </p>
            <? endif; ?>
            <form class="block-style auth__form registration__form" action="#" method="post" enctype="multipart/form-data">
                <label class="label registration__label">
                    <span>Имя<strong class="_red-text">*</strong></span>
                    <input class="input" type="text" name="user_name" value="<?= $user_name ?>" required>
                </label>
                <label class="label registration__label">
                    <span>Фамилия</span>
                    <input class="input" type="text" name="user_surname" value="<?= $user_surname ?>">
                </label>
                <label class="label registration__label">
                    <span>Отчество</span>
                    <input class="input" type="text" name="user_patronymic" value="<?= $user_patronymic ?>">
                </label>
                <label class="label registration__label">
                    <span>Дата рождения</span>
                    <input class="input" type="date" name="user_birth">
                </label>
                <label class="label registration__label">
                    <span>Аватар</span>
                    <input class="input" type="file" name="user_avatar" accept="image/*" value="<?= $user_avatar ?>">
                </label>
                <label class="label registration__label">
                    <span>Телефон</span>
                    <input class="input" type="tel" name="user_telephone" value="<?= $user_telephone ?>">
                </label>
                <label class="label registration__label">
                    <span>Электронная почта<strong class="_red-text">*</strong></span>
                    <input class="input" type="email" name="user_email" value="<?= $user_email ?>" required>
                </label>
                <label class="label registration__label">
                    <span>Пароль<strong class="_red-text">*</strong></span>
                    <input class="input" type="password" name="user_password" value="<?= $user_password ?>" required>
                </label>
                <div class="auth__bottom">
                    <button class="button auth__button" name="register">Регистрация</button>
                    <div>Уже есть аккаунт? <a class="a" href="/login.php">Войти</a></div>
                </div>
            </form>
        </div>
    </section>
</main>

<?= get_footer(); ?>