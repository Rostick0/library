<?

class UserController
{
    public static function create($name, $surname, $patronymic, $avatar, $telephone, $email, $password, $birth)
    {
        $name = protect_data($name);
        $surname = protect_data($surname);
        $patronymic = protect_data($patronymic);
        $telephone = protect_data($telephone);
        $email = protect_data($email);
        $password = trim($password);
        $birth = validate_date($birth, 'Y-m-d') ? $birth : null;

        $check_valid = UserController::check_valid($name, $email);

        if (!$check_valid['type']) return $check_valid;

        if (mb_strlen($password) < 8) return set_error('Пароль должен быть не менее 8 символов');

        if (User::get_by_email($email)->num_rows > 0) return set_error('Данный аккаунт уже существует');

        $avatar = $avatar['tmp_name'] ? ImageMyLib::uploadImage($avatar) : null;
        $password = password_hash($password, PASSWORD_DEFAULT);

        $user_id = User::create($name, $surname, $patronymic, $avatar, $telephone, $email, $password, $birth);

        if (!$user_id) return set_error('Произошла ошибка при создании');

        Session::create($user_id);

        return [
            'type' => true,
            'message' => 'Ваш аккаунт создан'
        ];
    }

    public static function login($email, $password)
    {
        $email = protect_data($email);
        $password = protect_data($password);

        $user = User::get_by_email($email)->fetch_assoc();

        if (!$user['user_id']) return set_error('Данного пользователя не существует');

        if (!password_verify($password, $user['password'])) return set_error('Неправильный пароль');

        $_SESSION['user'] = $user;

        Session::create($user['user_id']);

        return [
            'type' => true,
            'message' => 'Успешная авторизация'
        ];
    }

    public static function update($user_id, $name, $surname, $patronymic, $avatar, $telephone, $email, $password, $birth, $password_confirm)
    {
        $user_id = (int) $user_id;
        $name = protect_data($name);
        $surname = protect_data($surname);
        $patronymic = protect_data($patronymic);
        $telephone = protect_data($telephone);
        $email = protect_data($email);
        $password = trim($password);
        $birth = validate_date($birth, 'Y-m-d') ? $birth : null;

        $check_valid = UserController::check_valid($name, $email);

        if (!$check_valid['type']) return $check_valid;

        if ($password && mb_strlen($password) < 8) return set_error('Пароль меньше 8 символов');

        $user = User::get_by_id($user_id)->fetch_assoc();

        if ($email !== $user['email'] && User::get_by_email($email)->num_rows > 0) return set_error('Данная почта уже используется');

        if (!password_verify($password_confirm, $user['password'])) return set_error('Неправильный пароль');

        $avatar = $avatar['tmp_name'] ? ImageMyLib::updatePhoto($avatar, $user['avatar']) : null;
        $password = $password ? password_hash($password, PASSWORD_DEFAULT) : null;

        $query = User::update($user_id, $name, $surname, $patronymic, $avatar, $telephone, $email, $password, $birth);

        if (!$query) return set_error('Произошла ошибка при редактировании');

        return [
            'type' => true,
            'message' => 'Ваш аккаунт изменен'
        ];
    }

    private static function check_valid($name, $email)
    {
        if (!$name) return set_error('Отсуствует имя');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return set_error('Неправильная почта');

        return [
            'type' => true
        ];
    }
}
