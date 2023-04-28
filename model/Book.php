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
                    case when (`book_has_user`.`user_id` = '$user_id')
                        then true
                        else false
                    END
                FROM `book_has_user` WHERE `book_has_user`.`book_id` = '$book_id' AND `book_has_user`.`user_id` = '$user_id') as `user_have`
            FROM `book` 
                LEFT JOIN `author` ON `author`.`author_id` = `book`.`author_id`
                LEFT JOIN `genre` ON `genre`.`genre_id` = `book`.`genre_id`
                LEFT JOIN `publishing` ON `publishing`.`publishing_id` = `book`.`publishing_id`
                LEFT JOIN `book_type` ON `book_type`.`book_type_id` = `book`.`book_type_id`
            WHERE `book_id`='$book_id'"
        );
    }

    public static function get_catalog($genre_id, $price_min, $price_max, $format, $book_name, $limit, $offset)
    {
        global $mysqli;

        $genre_id = (int) $genre_id;
        $price_min = (int) $price_min;
        $price_max = (int) $price_max;
        $limit = (int) $limit;
        $offset = (int) $offset;

        $sql = $sql = Book::conditional_sql($genre_id, $price_min, $price_max, $book_name);

        $query_sql_begin = "SELECT
            `book`.*,
            `author`.`name` as `author_name`, `author`.`surname` as `author_surname`
        FROM `book`
            LEFT JOIN `author` ON `author`.`author_id` = `book`.`author_id`
        $sql";

        $query_sql = '';

        if (empty($format)) {
            $query_sql = $query_sql_begin;
        } else {
            foreach ($format as $format_value) {
                $query_sql .= "UNION $query_sql_begin " . ($sql ? "AND `book`.`book_type_id` = '$format_value'" : "WHERE `book`.`book_type_id` = '$format_value'");
            }

            $query_sql = mb_substr($query_sql, 5);
        }

        $query_sql .= " LIMIT $limit OFFSET $offset";

        return $mysqli->query($query_sql);
    }
    public static function get_catalog_count($genre_id, $price_min, $price_max, $format, $book_name)
    {
        global $mysqli;

        $genre_id = (int) $genre_id;
        $price_min = (int) $price_min;
        $price_max = (int) $price_max;

        $sql = Book::conditional_sql($genre_id, $price_min, $price_max, $book_name);

        $query_sql_begin = "SELECT
            COUNT(*)
        FROM `book`
            LEFT JOIN `author` ON `author`.`author_id` = `book`.`author_id`
        $sql";

        $query_sql = '';

        if (empty($format)) {
            $query_sql = $query_sql_begin;
        } else {
            foreach ($format as $format_value) {
                $query_sql .= "UNION $query_sql_begin " . ($sql ? "AND `book`.`book_type_id` = '$format_value'" : "WHERE `book`.`book_type_id` = '$format_value'");
            }

            $query_sql = mb_substr($query_sql, 5);
        }

        $query = $mysqli->query($query_sql);

        return $query ? $query->fetch_assoc()['COUNT(*)'] : 0;
    }

    private static function conditional_sql($genre_id, $price_min, $price_max, $book_name)
    {
        $sql = "";

        if ($genre_id) $sql .= "`genre_id` = '$genre_id' AND";

        if ($price_min) $sql .= "`price` >= '$price_min' AND";

        if ($price_max) $sql .= "`price` <= '$price_max' AND";

        if ($book_name) $sql .= "`book`.`name` LIKE '%$book_name%' AND";

        if ($sql) $sql = "WHERE " . mb_substr($sql, 0, -4);

        return $sql;
    }

    public static function get_by_user($user_id, $limit, $offset)
    {
        global $mysqli;

        $user_id = (int) $user_id;
        $limit = (int) $limit;
        $offset = (int) $offset;

        return $mysqli->query("SELECT DISTINCT
            `book`.*,
            `author`.`name` as `author_name`, `author`.`surname` as `author_surname`
        FROM `book`
            LEFT JOIN `author` ON `author`.`author_id` = `book`.`author_id`
            INNER JOIN `book_has_user` ON  `book_has_user`.`user_id` = '$user_id'
        LIMIT $limit OFFSET $offset");
    }

    public static function get_count_by_user($user_id)
    {
        global $mysqli;

        return $mysqli->query("SELECT
            COUNT(*)
        FROM `book_has_user`
        WHERE `user_id` = '$user_id'");
    }

    public static function get_order_by($order_by, $limit = 8, $offset = 0)
    {
        global $mysqli;

        $order_by = protect_data($order_by);
        $limit = (int) $limit;
        $offset = (int) $offset;

        return $mysqli->query(
            "SELECT
                `book`.*,
                `author`.`name` as `author_name`, `author`.`surname` as `author_surname`
            FROM `book`
                LEFT JOIN `author` ON `author`.`author_id` = `book`.`author_id`
            ORDER BY `$order_by` DESC LIMIT $limit OFFSET $offset"
        );
    }
}
