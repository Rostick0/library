<?

class Genre
{
    public static function get()
    {
        global $mysqli;

        return $mysqli->query("SELECT * FROM `genre`");
    }

    public static function get_by_name($name)
    {
        global $mysqli;

        return $mysqli->query("SELECT * FROM `genre` WHERE `name` = '$name'");
    }
}
