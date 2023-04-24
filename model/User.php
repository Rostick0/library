<?

class User
{
    public static function get_by_id($user_id)
    {
        global $mysqli;

        $user_id = (int) $user_id;

        return $mysqli->query("SELECT * FROM `user` WHERE `user_id`='$user_id'");
    }

    public static function get_by_email($email)
    {
        global $mysqli;

        $email = protect_data($email);

        return $mysqli->query("SELECT * FROM `user` WHERE `email`='$email'");
    }
    public static function create($name, $surname, $patronymic, $avatar, $telephone, $email, $password, $birth)
    {
        global $mysqli;

        $name = "'$name'";
        $surname = can_null($surname);
        $patronymic = can_null($patronymic);
        $avatar = can_null($avatar);
        $telephone = can_null($telephone);
        $email = "'$email'";
        $password = "'$password'";
        $birth = can_null($birth);

        $query = $mysqli->query("INSERT INTO `user`(`name`, `surname`, `patronymic`, `avatar`, `telephone`, `email`, `password`, `birth`) 
        VALUES 
        ($name,$surname,$patronymic,$avatar,$telephone,$email,$password,$birth)");

        if (!$query) return var_dump($mysqli->errno);

        return mysqli_insert_id($mysqli);
    }

    public static function update($user_id, $name, $surname, $patronymic, $avatar, $telephone, $email, $password, $birth)
    {
        global $mysqli;

        $sql = '';

        $name = "'$name'";
        $surname = can_null($surname);
        $patronymic = can_null($patronymic);
        $avatar = can_null($avatar);
        $telephone = can_null($telephone);
        $email = "'$email'";
        $birth = can_null($birth);

        if ($avatar !== "NULL") $sql .= "`avatar`=$avatar,";
        if ($password) $sql .= "`password`='$password',";

        return $mysqli->query("UPDATE `user` 
        SET `name`=$name,`surname`=$surname,`patronymic`=$patronymic,$sql`telephone`=$telephone,`email`=$email,`birth`=$birth 
        WHERE `user_id`='$user_id'");
    }
}
