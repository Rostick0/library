<?

class BookHasUserController
{
    public static function create($user_id, $book_id, $end_rental)
    {
        $user_id = (int) $user_id;
        $book_id = (int) $book_id;
        $end_rental = $end_rental ? (int) $end_rental : 7;

        if (BookHasUser::check_current($user_id, $book_id)) return;

        return BookHasUser::create($user_id, $book_id, $end_rental);
    }
}

// INSERT INTO `book_has_user` (`book_has_user_id`, `user_id`, `book_id`, `start_rental`, `end_rental`) VALUES (NULL, '1', '1', NOW(), DATE_ADD(NOW() , INTERVAL 30 DAY))