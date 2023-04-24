<?

class BookCommentController
{
    public static function create($text, $raiting, $book_id, $user_id)
    {
        $text = protect_data($text);
        $raiting = (float) $raiting;
        $book_id = (int) $book_id;
        $user_id = (int) $user_id;

        $valid = BookCommentController::valid($text, $raiting);

        if (!$valid['type']) return $valid;

        $raiting = BookCommentController::valid_raiting($raiting);

        $query = BookComment::create($text, $raiting, $book_id, $user_id);

        if (!$query) return set_error('Ошибка при создании комментария');

        return [
            'type' => true,
            'message' => 'Комменатрий добавлен'
        ];
    }

    public static function update($book_comment_id, $text, $raiting, $user_id)
    {
        $book_comment_id = (int) $book_comment_id;
        $text = protect_data($text);
        $raiting = (float) $raiting;
        $user_id = (int) $user_id;

        $valid = BookCommentController::valid($text, $raiting);

        if (!$valid['type']) return $valid;

        $raiting = BookCommentController::valid_raiting($raiting);

        $query = BookComment::update($book_comment_id, $text, $raiting, $user_id);

        if (!$query) return set_error('Ошибка при редактировании комментария');

        return [
            'type' => true,
            'message' => 'Комменатрий изменен'
        ];
    }

    private static function valid($text, $raiting)
    {
        if (mb_strlen($text) < 20) return set_error('Текст меньше 20 символов');

        if (!$raiting) return set_error('Поставьте рейтинг');

        return [
            'type' => true
        ];
    }

    private static function valid_raiting($raiting)
    {
        if ($raiting > 5) {
            $raiting = 5;
        } else if ($raiting < 0) {
            $raiting = 0;
        }

        return $raiting;
    }
}
