<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
define('startsect', ob_start());

// var_dump($_SESSION);

function section($title = 'Perpustakaan', $permision = null)
{
    if ($permision && !($permision == $_SESSION['role'])) {
        header('Location:../Forbidden');
    } else {
        $content = ob_get_clean();
        include('template/body.view.php');
    }
};

$curent_url = $_SERVER['REQUEST_URI'];
// echo($curent_url);
