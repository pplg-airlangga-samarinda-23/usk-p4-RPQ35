<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require_once(dirname(__DIR__, 1) . '/database/db-con.php');

    function getback()
    {
        $_SESSION['success'] = 'gagal menambahkan akun';
        header('Location:../register.php');
    }

    $username = $_POST['Username'];
    $password = $_POST['Password'];
    $confirmPass = $_POST['Confirm_Password'];

    if ($password == $confirmPass) {

        $check = $db_con->prepare('SELECT * FROM `user` WHERE `username`=? LIMIT 1');
        $check->execute([$username]);
        $check = $check->fetch(PDO::FETCH_ASSOC);
        if (!$check) {
            $create = $db_con->prepare('INSERT INTO `user` VALUE(null,:username,:passwords,:roles)');
            $create->execute([
                'username' => $username,
                'passwords' => password_hash($password, PASSWORD_DEFAULT),
                'roles' => 'anggota',
            ]);
            echo ('y');
            if ($create) {
                $_SESSION['username'] = $username;
                $_SESSION['login'] = true;
                $_SESSION['role'] = 'anggota';
                $_SESSION['success'] = 'Login berhasil sebagai anggota';
                echo ('y');
                header('Location:../dashboar_anggota.php');
            } else {
                getback();
            }
        } elseif (password_verify($password, $check['password'])) {
            $_SESSION['success'] = 'anda sudah memiliki akun ,Login berhasil sebagai ' . $check['role'];
            $_SESSION['role'] = $verify['role'];
            $_SESSION['user_id'] = $verify['id'];
            header('Location:../dashboar');
        } else {
            getback();
        }
    } else {
        getback();
    }
}
header('Location:../login.php');
