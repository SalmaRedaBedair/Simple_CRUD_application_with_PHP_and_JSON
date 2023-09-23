<?php

function getUsers()
{
    $users = json_decode(file_get_contents(__DIR__ . '/users.json'), true);
    return $users;
}
function getUserById($id)
{
    $users = getUsers();
    foreach ($users as $user) {
        if ($user['id'] == $id) {
            return $user;
        }
    }
    return null;
}
function createUser($data)
{
    $users = getUsers();
    $users[] = $data;
    putJson($users);
}
function updateUser($data, $id)
{
    $users = getUsers();
    foreach ($users as $i => $user) {
        if ($user['id'] == $id) {
            $users[$i] = array_merge($user, $data);
            // we use merge so it will merge them and if there was same attribute with diffrent data it will take value in $data
        }
    }
    file_put_contents(__DIR__ . '/users.json', json_encode($users, JSON_PRETTY_PRINT));
}
function deleteUser($id)
{
    $users = getUsers();
    foreach ($users as $i => $user) {
        if ($user['id'] == $id) {
            if(isset($user['extension'])&&!empty($user['extension']))
            {
                $extension=$user['extension'];
                unlink(__DIR__."/images/$id.$extension");
            }
            unset($users[$i]);
        }
    }
    file_put_contents(__DIR__ . '/users.json', json_encode($users, JSON_PRETTY_PRINT));
}
function uploadImage($file, $user)
{
    if (isset($_FILES['picture']) && $_FILES['picture']['name']) {
        if (!is_dir(__DIR__ . "/images")) {
            mkdir(__DIR__ . "/images");
        }
        $fileName = $file['name'];
        $dotPosition = strpos($fileName, '.');
        $extension = substr($fileName, $dotPosition + 1);

        $userId = $user['id'];
        move_uploaded_file($file['tmp_name'], __DIR__ . "/images/$userId.$extension");

        $user['extension'] = $extension;
        return $user;
    }
}
function putJson($users)
{
    file_put_contents(__DIR__ . '/users.json', json_encode($users, JSON_PRETTY_PRINT));
}
function validateUser($user, &$errors)
{
    $user = array_map(function($element) {
        $trimmed = trim($element);
        $cleaned =htmlspecialchars($trimmed);
        return $cleaned;
    }, $user);
    $isValid = true;
    if (!$user['name']) {
        $isValid = false;
        $errors['name'] = 'Name is mandatory';
    }
    if (!$user['username'] || strlen($user['username']) < 6 || strlen($user['username']) > 16) {
        $isValid = false;
        $errors['username'] = 'Username is required and it must be more than 6 and less then 16 character';
    }
    if (!$user['email'] && !filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
        $isValid = false;
        $errors['email'] = 'This must be a valid email address';
    }

    if (!filter_var($user['phone'], FILTER_VALIDATE_INT)) {
        $isValid = false;
        $errors['phone'] = 'This must be a valid phone number';
    }
    if (!filter_var($user['website'], FILTER_VALIDATE_URL)) {
        $isValid = false;
        $errors['website'] = 'This must be a valid website link';
    }

    return $isValid;
}