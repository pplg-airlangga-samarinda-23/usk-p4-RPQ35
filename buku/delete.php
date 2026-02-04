<?php

require_once(dirname(__DIR__, 1) . '/database/db-con.php');
// var_dump($_POST);
$tujuan = trim($_SERVER['REQUEST_URI'], 'delete.php');

if (isset($_POST['Id'])) {

    $del = $db_con->prepare("DELETE FROM `book` WHERE `id`=:ids");
    $del = $del->execute(['ids' => intval(trim($_POST['Id']))]);
    var_dump($del);

    $_SESSION['success'] = 'berhasil menghapus';
} else {
    $_SESSION['success'] = 'gagal menghapus';
}

header('Location:' . $tujuan);
