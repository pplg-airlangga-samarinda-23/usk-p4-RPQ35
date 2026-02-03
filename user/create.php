<?php
require_once(dirname(__DIR__, 1) . '../database/db-con.php');




if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $username = $_POST['Username'];
    $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
    $role = $_POST['Role'];


    $create = db_con->prepare("INSERT INTO `user`(`username`,`password`,`role`)  Value(?,?,?)");
    $create->execute([
        $username,
        $password,
        $role,
    ]);


    // done
    $_SESSION['success'] = 'berhasil menambahkan';
} else {
    $_SESSION['success'] = 'gagal menambahkan';
}
require_once(__DIR__ . '/display/create.php');
