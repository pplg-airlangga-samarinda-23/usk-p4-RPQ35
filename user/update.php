<?php
$tujuan = trim($_SERVER['REQUEST_URI'], 'update.php');

require_once(dirname(__DIR__, 1) . '/database/db-con.php');

if (isset($_POST['username']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['Id']) && isset($_POST['role'])) {
    $Update = db_con->prepare('UPDATE `user` SET `username`=:username ,`password`=:passwords ,`role`=:roles  WHERE `id`=:id');
    $Update->execute([
        'username' => $_POST['username'],
        'passwords' => $_POST['password'],
        'roles' => $_POST['role'],
        'id' => $_POST['Id'],
    ]);
    $_SESSION['success'] = 'Berhasil Update data';
} else {
    $_SESSION['success'] = 'gagal Update data';
}
header('Location:' . $tujuan);
