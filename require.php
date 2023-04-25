<?

session_start();

require_once(__DIR__ . './include/connect.php');

require_once(__DIR__ . './helpers/utils.php');
require_once(__DIR__ . './helpers/database.php');
require_once(__DIR__ . './helpers/image.php');

require_once(__DIR__ . './model/Session.php');
require_once(__DIR__ . './model/User.php');
require_once(__DIR__ . './model/Book.php');
require_once(__DIR__ . './model/BookComment.php');
require_once(__DIR__ . './model/BookHasUser.php');
require_once(__DIR__ . './model/BookType.php');
require_once(__DIR__ . './model/Genre.php');
require_once(__DIR__ . './model/BookView.php');

require_once(__DIR__ . './controller/User.php');
require_once(__DIR__ . './controller/BookComment.php');
require_once(__DIR__ . './controller/BookView.php');

require_once(__DIR__ . './helpers/session.php');

require_once(__DIR__ . './components/head.php');
require_once(__DIR__ . './components/header.php');
require_once(__DIR__ . './components/footer.php');
require_once(__DIR__ . './components/pagination.php');
