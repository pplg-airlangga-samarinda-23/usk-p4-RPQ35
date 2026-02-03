<?php
// if ($_SERVER['REQUEST_METHOD' == "POST"]) {
    require_once(dirname(__DIR__, 1) . '/database/db-con.php');

    $username = $_POST['Username'];
    $password = $_POST['Password'];


    $verify = db_con->prepare('SELECT * FROM `user` WHERE `username`= ?');
    $verify->execute([$username]);
    $verify = $verify->fetch(PDO::FETCH_ASSOC);
    if ($verify && password_verify($password, $verify['password'])) {
        $_SESSION['username'] = $verify['username'];
        $_SESSION['user_id']=$verify['id'];
        $_SESSION['login'] = true;
        $_SESSION['role'] = $verify['role'];
        $_SESSION['success'] = 'Login berhasil sebagai' . $verify['role'];
        
        header('Location:../dashboard/');
    } else {
        $_SESSION['success'] = 'Username atau Password salah';
        $_SESSION['login'] = false;
        header('Location:../login.php');
    }
// }
// else{header('Location:../login.php');}
