<?
require_once(__DIR__ . './../require.php');

$book_comment_id = $_REQUEST['id'];

$query = BookComment::delete($book_comment_id, $_SESSION['user']['user_id']);

if ($query) {
    echo 'Комментарий успешно удален';
}

?>

<meta http-equiv="refresh" content="3;URL='<?= $_SERVER['HTTP_REFERER'] ?>'" />