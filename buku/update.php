<?php
$tujuan = trim($_SERVER['REQUEST_URI'], 'update.php');

require_once(dirname(__DIR__, 1) . '/database/db-con.php');

if (isset($_POST['Judul']) && isset($_POST['Pengarang']) && isset($_POST['deskripsi']) && isset($_POST['Id'])) {
    $Update = $db_con->prepare('UPDATE `book` SET `judul`=:judul ,`pengarang`=:pengarang ,`deskripsi`=:deskripsi WHERE `id`=:id');
    $Update->execute([
        'judul' => $_POST['Judul'],
        'pengarang' => $_POST['Pengarang'],
        'deskripsi' => $_POST['deskripsi'],
        'id' => $_POST['Id'],
    ]);
    $_SESSION['success'] = 'Berhasil Update data';
} else {
    $_SESSION['success'] = 'gagal Update data';
}
header('Location:' . $tujuan);
