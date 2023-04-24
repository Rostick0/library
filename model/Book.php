<?

class Book
{
    public static function get_full_by_id($book_id)
    {
        global $mysqli;

        $user_id = (int) $_SESSION['user']['user_id'];

        return $mysqli->query(
            "SELECT
                `book`.*,
                `author`.`name` as `author_name`, `author`.`surname` as `author_surname`,
                `genre`.`name` as `genre`,
                `publishing`.`name` as `publishing_name`,
                `book_type`.`name` as `book_type`,
                (SELECT
                    case when `book_has_user`.`user_id` = '$user_id'
                        then true
                        else false
                    END
                FROM `book_has_user`) as `user_have`
            FROM `book` 
                LEFT JOIN `author` ON `author`.`author_id` = `book`.`author_id`
                LEFT JOIN `genre` ON `genre`.`genre_id` = `book`.`genre_id`
                LEFT JOIN `publishing` ON `publishing`.`publishing_id` = `book`.`publishing_id`
                LEFT JOIN `book_type` ON `book_type`.`book_type_id` = `book`.`book_type_id`
            WHERE `book_id`='$book_id'"
        );
    }

    public static function get_catalog($genre_id, $price_min, $price_max, $limit, $offset)
    {
        global $mysqli;

        $genre_id = (int) $genre_id;
        $price_min = (int) $price_min;
        $price_max = (int) $price_max;
        $limit = (int) $limit;
        $offset = (int) $offset;

        $sql = "";

        if ($genre_id) $sql .= "`genre_id` = '$genre_id' AND";

        if ($price_min) $sql .= "`price` >= '$price_min' AND";

        if ($price_max) $sql .= "`price` <= '$price_max' AND";

        if ($sql) $sql = "WHERE " . mb_substr($sql, 0, -4);

        return $mysqli->query(
            "SELECT
                `book`.*,
                `author`.`name` as `author_name`, `author`.`surname` as `author_surname`
            FROM `book`
                LEFT JOIN `author` ON `author`.`author_id` = `book`.`author_id`
            $sql
            LIMIT $limit OFFSET $offset"
        );
    }
}
