<?

class BookViewController
{
    public static function create($user_id, $book_id)
    {
        if (!$user_id) return;

        $book_view = BookView::get($user_id, $book_id);

        if ($book_view->num_rows > 0) return;

        BookView::create($user_id, $book_id);
    }
}
