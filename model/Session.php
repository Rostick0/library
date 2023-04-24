<?

class Session
{
    public static function get($token)
    {
        global $mysqli;

        $token = protect_data($token);

        return $mysqli->query("SELECT * FROM `session` WHERE `token`='$token'");
    }

    public static function create($user_id)
    {
        global $mysqli;

        $token = md5(random_int(100000, 999999) . time());
        $ip = $_SERVER['SERVER_ADDR'];
        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        setcookie("token", $token, time() + 60 * 60 * 24 * 30, '/');

        return $mysqli->query("INSERT INTO `session`(`token`, `ip`, `user_agent`, `user_id`) 
        VALUES 
        ('$token','$ip','$user_agent','$user_id')");
    }
}
