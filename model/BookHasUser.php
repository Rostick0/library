<?

class BookHasUser
{
    public static function create($user_id, $book_id)
    {
        global $mysqli;

        $user_id = (int) $user_id;
        $book_id = (int) $book_id;

        return $mysqli->query("INSERT INTO `book_has_user`(`user_id`, `book_id`) VALUES ('$user_id','$book_id')");
    }
}
