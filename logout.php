<?
require_once('./require.php');

$_SESSION['user'] = null;
setcookie("token", '', time(), '/');

header('Location: /login.php');
