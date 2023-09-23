<?php
include_once('partials/header.php');
require_once 'users/users.php';

if (!isset($_GET['id'])) {
    require_once('partials/not_found.php');
}
$userId = $_GET['id'];
$user = getUserById($userId);
if (!$user) {
    require_once('partials/not_found.php');
}

$errors = [
    'name' => '',
    'email' => '',
    'website' => '',
    'phone' => '',
    'username' => ''
];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST;
    $isValid = validateUser($user, $errors);
    if ($isValid) {
        $user['id'] = $userId;
        if (!empty($_FILES['picture']['name'])) {
            $user = uploadImage($_FILES['picture'], $user);
        }
        updateUser($user, $userId);
        header('Location: index.php');
        exit;
    }
}
?>
<?php require_once('_form.php') ?>
<?php include_once('partials/footer.php'); ?>