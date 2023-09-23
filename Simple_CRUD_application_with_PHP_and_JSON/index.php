<?php
require_once "users/users.php";
$users = getUsers();
include_once('partials/header.php');
?>
<div class="container">
    <p>
        <a href="create.php" class="btn btn-success">Create new user</a>
    </p>
    <table class="table">
        <thead>
            <tr>
                <th>image</th>
                <th>name</th>
                <th>username</th>
                <th>email</th>
                <th>phone</th>
                <th>website</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td>
                        <?php if(isset($user['extension'])): ?>
                            <img height="100px" src="users/images/<?=$user['id']?>.<?=$user['extension']?>" alt="">
                        <?php endif; ?>
                    </td>
                    <td>
                        <?= $user['name'] ?>
                    </td>
                    <td>
                        <?= $user['username'] ?>
                    </td>
                    <td>
                        <?= $user['email'] ?>
                    </td>
                    <td>
                        <?= $user['phone'] ?>
                    </td>
                    <td>
                        <a href="http://<?= $user['website'] ?>" target="_blank">
                            <?= $user['website'] ?>
                        </a>
                    </td>
                    <td>
                        <a href="view.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-outline-info">View</a>
                        <a href="update.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-outline-secondary">Update</a>
                        <a href="delete.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-outline-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include_once('partials/footer.php'); ?>