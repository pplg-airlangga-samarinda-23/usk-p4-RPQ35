<?php
require_once(dirname(__DIR__, 1) . '/database/db-con.php');




if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['Judul']) && isset($_POST['Pengarang']) && isset($_POST['deskripsi']) && isset($_POST['stok'])) {
    // echo"A";
    $Judul = $_POST['Judul'];
    $Pengarang = $_POST['Pengarang'];
    $Deskripsi = $_POST['deskripsi'];
    $stok = $_POST['stok'];

    $check = $db_con->prepare("SELECT * FROM `book` WHERE `judul`=:judul AND `pengarang`=:pengarang ");
    $check->execute([
        'judul' => $Judul,
        'pengarang' => $Pengarang,
    ]);
    $check = $check->fetch(PDO::FETCH_ASSOC);
    if ($check) {
        $_SESSION['success'] = 'gagal menambahkan, data sudah ada';
        // echo"C";
        // exit;
    } else {
        $create = $db_con->prepare("INSERT INTO `book`(`judul`,`pengarang`,`deskripsi`,`stok`)  Value(?,?,?,?)");
        $hasil = $create->execute([
            $Judul,
            $Pengarang,
            $Deskripsi,
            $stok,
        ]);

        if ($hasil) {
            // done
            $_SESSION['success'] = 'berhasil menambahkan';
        } else {
            $_SESSION['success'] = 'gagal menambahkan';
        }
    }
}
// echo"G";
require_once(__DIR__ . '/display/create.php');
