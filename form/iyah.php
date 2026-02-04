<?php

require_once(dirname(__DIR__, 1) . '/database/db-con.php');

var_dump($_POST);

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Pastikan transaksi dimulai sebelum menjalankan update
    db_con->beginTransaction();

    try {
        $buku = $_POST['id_buku'];
        $id_pinjam = $_POST['id_peminjaman'];
        $tgl_sekarang = (new DateTime())->format("Y-m-d");

        // 1. Tambah stok buku (Gunakan SET, bukan AT)
        $updateStok = db_con->prepare("UPDATE `book` SET `stok` = `stok` + 1 WHERE `id` = :id_buku");
        $updateStok->execute(['id_buku' => $buku]);

        // 2. Update status peminjaman
        $updateStatus = db_con->prepare("UPDATE `peminjaman` SET `status` = :status WHERE `id_peminjaman` = :ids");
        $updateStatus->execute([
            'status' => 'kembali',
            'ids'    => $id_pinjam,
        ]);

        // 3. Update tanggal dikembalikan di tabel detail (Penting untuk record)
        $updateDetail = db_con->prepare("UPDATE `detail_peminjaman` SET `tgl_dikembalikan` = :tgl WHERE `id_peminjaman` = :ids AND `id_buku` = :id_buku");
        $updateDetail->execute([
            'tgl'     => $tgl_sekarang,
            'ids'     => $id_pinjam,
            'id_buku' => $buku
        ]);

        db_con->commit();
        echo "Buku berhasil dikembalikan!";
    } catch (Exception $e) {
        db_con->rollBack();
        echo "Gagal mengembalikan buku: " . $e->getMessage();
    }
}


header("Location:" . trim($_SERVER['REQUEST_URI'], 'iyah.php') . "kembali.php");
