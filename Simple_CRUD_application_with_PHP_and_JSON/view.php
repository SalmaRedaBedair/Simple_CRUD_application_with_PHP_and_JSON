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
?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>View user: <b>
                    <?= $user['name'] ?>
                </b></h3>
        </div>
        <div class="card-body">
            <a href="update.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-secondary">Update</a>
            <a href="delete.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
        </div>
        <table class="table">
            <tbody>
                <tr>
                    <th>name</th>
                    <td>
                        <?= $user['name'] ?>
                    </td>
                </tr>
                <tr>
                    <th>username</th>
                    <td>
                        <?= $user['username'] ?>
                    </td>
                </tr>
                <tr>
                    <th>email</th>
                    <td>
                        <?= $user['email'] ?>
                    </td>
                </tr>
                <tr>
                    <th>phone</th>
                    <td>
                        <?= $user['phone'] ?>
                    </td>
                </tr>
                <tr>
                    <th>website</th>
                    <td>
                        <a href="http://<?= $user['website'] ?>" target="_blank">
                            <?= $user['website'] ?>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<?php include_once('partials/footer.php'); ?>