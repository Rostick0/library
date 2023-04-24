<?

class BookType {
    public static function get() {
        global $mysqli;

        return $mysqli->query("SELECT * FROM `book_type`");
    }
}