<?php
require_once 'users/users.php';
if (!isset($_GET['id'])) {
    require_once('partials/not_found.php');
}
$userId = $_GET['id'];
$user = getUserById($userId);
if (!$user) {
    require_once('partials/not_found.php');
}
deleteUser($userId);
header('Location: index.php');
exit;
?>
