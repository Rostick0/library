<?

class BookComment
{
    public static function get_by_id($book_comment_id)
    {
        global $mysqli;

        $book_comment_id = (int) $book_comment_id;

        return $mysqli->query(
            "SELECT
                `book_comment`.*,
                `user`.`avatar`, `user`.`name`
            FROM `book_comment`
                LEFT JOIN `user` ON `user`.`user_id` = `book_comment`.`user_id`
            WHERE `book_comment`.`book_comment_id`='$book_comment_id'"
        );
    }

    public static function get($book_id, $user_id, $limit, $offset)
    {
        global $mysqli;

        $book_id = (int) $book_id;
        $user_id = (int) $user_id;
        $limit = (int) $limit;
        $offset = (int) $offset;

        return $mysqli->query(
            "SELECT
                `book_comment`.*,
                `user`.`avatar`, `user`.`name`
            FROM `book_comment`
                LEFT JOIN `user` ON `user`.`user_id` = `book_comment`.`user_id`
            WHERE `book_comment`.`book_id`='$book_id' AND `user`.`user_id` != '$user_id' LIMIT $limit OFFSET $offset"
        );
    }

    public static function get_my($book_id, $user_id)
    {
        global $mysqli;

        $book_id = (int) $book_id;
        $user_id = (int) $user_id;

        return $mysqli->query(
            "SELECT
                `book_comment`.*,
                `user`.`avatar`, `user`.`name`
            FROM `book_comment`
                LEFT JOIN `user` ON `user`.`user_id` = `book_comment`.`user_id`
            WHERE `book_comment`.`book_id`='$book_id' AND `user`.`user_id` = '$user_id'"
        );
    }

    public static function get_count($book_id)
    {
        global $mysqli;

        return $mysqli->query("SELECT COUNT(*) FROM `book_comment` WHERE `book_id`='$book_id'")->fetch_assoc()['COUNT(*)'];
    }

    public static function create($text, $raiting, $book_id, $user_id)
    {
        global $mysqli;

        return $mysqli->query("INSERT INTO `book_comment` (`text`, `raiting`, `book_id`, `user_id`) 
        VALUES 
        ('$text','$raiting','$book_id','$user_id')");
    }

    public static function update($book_comment_id, $text, $raiting, $user_id)
    {
        global $mysqli;

        return $mysqli->query("UPDATE `book_comment` SET `text`='$text',`raiting`='$raiting',`update_date`=CURRENT_TIMESTAMP 
        WHERE `book_comment_id`='$book_comment_id' AND `user_id`='$user_id';");
    }

    public static function delete($book_comment_id, $user_id)
    {
        global $mysqli;

        $book_comment_id = (int) $book_comment_id;
        $user_id = (int) $user_id;

        return $mysqli->query("DELETE FROM `book_comment` WHERE `book_comment_id`='$book_comment_id' AND `user_id`='$user_id'");
    }
}
