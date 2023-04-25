<?

class BookView {
    public static function get($user_id, $book_id) {
        global $mysqli;

        $user_id = (int) $user_id;
        $book_id = (int) $book_id;

        return $mysqli->query("SELECT * FROM `book_view` WHERE `user_id`='$user_id' AND `book_id`='$book_id'");
    }

    public static function create($user_id, $book_id) {
        global $mysqli;

        $user_id = (int) $user_id;
        $book_id = (int) $book_id;

        return $mysqli->query("INSERT INTO `book_view`(`user_id`, `book_id`) VALUES ('$user_id','$book_id')");
    }
}