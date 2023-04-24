<?
require_once('./require.php');

if (empty($_SESSION['user'])) {
    die(header('Location: /login.php'));
}

$user = User::get_by_id($_SESSION['user']['user_id'])->fetch_assoc();

$name = $_POST['user_name'] ?? $user['name'] ?? '';
$surname = $_POST['user_surname'] ?? $user['surname'] ?? '';
$patronymic = $_POST['user_patronymic'] ?? $user['patronymic'] ?? '';
$telephone = $_POST['user_telephone'] ?? $user['telephone'] ?? '';
$email = $_POST['user_email'] ?? $user['email'] ?? '';
$password = $_POST['user_password'] ?? '';
$birth = $_POST['user_birth'] ?? $user['birth'] ?? '';
$avatar = $_FILES['user_avatar'];
$password_confirm = $_POST['user_password_confirm'] ?? '';

if (isset($_POST['user_update'])) {
    $request = UserController::update(
        $_SESSION['user']['user_id'],
        $name,
        $surname,
        $patronymic,
        $avatar,
        $telephone,
        $email,
        $password,
        $birth,
        $password_confirm
    );
}

?>

<?= get_head('Редактирование профиля'); ?>

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
                    Редактирование
                </span>
            </li>
        </ul>
    </div>
    <section class="profile">
        <div class="container">
            <h2 class="profile__title"><?= $user['name'] ?></h2>
            <? if ($request['message']) : ?>
                <p class="message message-center <?= $request['type'] ? '_green-text' : '_red-text' ?>">
                    <strong><?= $request['message'] ?></strong>
                </p>
            <? endif; ?>
            <div class="block-style profile__content">
                <div class="profile__avatar">
                    <div class="profile__image">
                        <img src="/upload/<?= $user['avatar'] ?>" alt="">
                    </div>
                </div>
                <form class="profile__info" method="post" enctype="multipart/form-data">
                    <ul class="profile__info_list profile__info_edit-list">
                        <li class="profile__info_item">
                            <label class="label">
                                <span>Имя*:</span>
                                <input class="input profile__input" name="user_name" value="<?= $name ?>" type="text" required>
                            </label>
                        </li>
                        <li class="profile__info_item">
                            <label class="label">
                                <span>Фамилия:</span>
                                <input class="input profile__input" name="user_surname" value="<?= $surname ?>" type="text">
                            </label>
                        </li>
                        <li class="profile__info_item">
                            <label class="label">
                                <span>Отчество:</span>
                                <input class="input profile__input" name="user_patronymic" value="<?= $patronymic ?>" type="text">
                            </label>
                        </li>
                        <li class="profile__info_item">
                            <label class="label">
                                <span>Телефон:</span>
                                <input class="input profile__input" name="user_telephone" value="<?= $telephone ?>" type="tel">
                            </label>
                        </li>
                        <li class="profile__info_item">
                            <label class="label">
                                <span>E-mail*:</span>
                                <input class="input profile__input" name="user_email" value="<?= $email ?>" type="email" required>
                            </label>
                        </li>
                        <li class="profile__info_item">
                            <label class="label">
                                <span>Новый пароль:</span>
                                <input class="input profile__input" name="user_password" value="<?= $password ?>" type="password">
                            </label>
                        </li>
                        <li class="profile__info_item">
                            <label class="label">
                                <span>Дата рождения:</span>
                                <input class="input profile__input" name="user_birth" value="<?= $birth; ?>" type="date">
                            </label>
                        </li>
                        <li class="profile__info_item">
                            <label class="label">
                                <span>Текущий пароль*:</span>
                                <input class="input profile__input" name="user_password_confirm" type="password" required>
                            </label>
                        </li>
                        <li class="profile__info_item">
                            <label class="label">
                                <span>Поменять фото</span>
                                <input class="input profile__input" accept="image/*" name="user_avatar" type="file">
                            </label>
                        </li>
                    </ul>
                    <button class="button profile__edit" name="user_update">Редактировать</button>
                </form>
            </div>
        </div>
    </section>
</main>

<?= get_footer(); ?>