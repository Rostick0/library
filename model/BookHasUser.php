<?

class BookHasUser
{
    public static function create($user_id, $book_id, $end_rental)
    {
        global $mysqli;

        return $mysqli->query("INSERT INTO `book_has_user`(`user_id`, `book_id`, `start_rental`, `end_rental`) VALUES ('$user_id','$book_id',NOW(),DATE_ADD(NOW(), INTERVAL $end_rental DAY))");
    }

    public static function check_current($user_id, $book_id) {
        global $mysqli;

        $user_id = (int) $user_id;
        $book_id = (int) $book_id;

        return $mysqli->query("SELECT COUNT(*) FROM `book_has_user` WHERE `end_rental` >= NOW() AND `user_id`='$user_id' AND `book_id`='$book_id'")->fetch_assoc()['COUNT(*)'];
    }
}

// INSERT INTO `book_has_user` (`book_has_user_id`, `user_id`, `book_id`, `start_rental`, `end_rental`) VALUES (NULL, '1', '1', NOW(), DATE_ADD(NOW() , INTERVAL 30 DAY))