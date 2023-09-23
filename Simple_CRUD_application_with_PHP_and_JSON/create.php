<?php
include_once('partials/header.php');
require_once 'users/users.php';

$user = [
    'name' => '',
    'email' => '',
    'website' => '',
    'phone' => '',
    'username' => ''
];
$errors = [
    'name' => '',
    'email' => '',
    'website' => '',
    'phone' => '',
    'username' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = array_merge($user, $_POST);

    $isValid=validateUser($user,$errors);
    if ($isValid) {
        $user['id'] = rand(1000000, 2000000);
        if (!empty($_FILES['picture']['name'])) {
            $user = uploadImage($_FILES['picture'], $user);
        }
        createUser($user);
        header('Location: index.php');
        exit;
    }

}
?>
<?php require_once('_form.php') ?>
<?php include_once('partials/footer.php'); ?>