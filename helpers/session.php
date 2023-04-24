<?

if ($_COOKIE['token'] && empty($_SESSION['user'])) {
    $token = $_COOKIE['token'];
    $user_id = Session::get($token)->fetch_assoc()['user_id'];

    if ($user_id) {
        $_SESSION['user'] = User::get_by_id($user_id)->fetch_assoc();
    }
}