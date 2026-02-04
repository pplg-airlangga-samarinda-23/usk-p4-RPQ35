<?php
require_once(dirname(__DIR__, 1) . '/database/db-con.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // 1. Ambil data dari POST/SESSION
    $buku = $_POST['book_id'];
    $user = $_SESSION['user_id'];
    $tgl_pinjam = (new DateTime())->format("Y-m-d");
    $tgl_kembali = (new DateTime())->modify("+7 days")->format("Y-m-d");

    try {
        $db_con->beginTransaction();

        // --- LANGKAH 1: Cek Stok Terlebih Dahulu ---
        $checkStok = $db_con->prepare("SELECT stok FROM book WHERE id = :id_buku FOR UPDATE");
        $checkStok->execute(['id_buku' => $buku]);
        $dataBuku = $checkStok->fetch(PDO::FETCH_ASSOC);

        if (!$dataBuku || $dataBuku['stok'] <= 0) {
            throw new Exception("Maaf, stok buku ini sedang habis!");
        }

        // --- LANGKAH 2: Kurangi Stok di Tabel Book ---
        $updateStok = $db_con->prepare("UPDATE book SET stok = stok - 1 WHERE id = :id_buku");
        $updateStok->execute(['id_buku' => $buku]);

        // --- LANGKAH 3: Insert ke Tabel Peminjaman ---
        $create = $db_con->prepare("INSERT INTO `peminjaman` (`id_user`, `tgl_pinjam`, `tgl_kembali`, `status`) 
                                VALUES (:user, :pinjam, :kembali, :statuse)");
        $create->execute([
            'user'    => $user,
            'pinjam'  => $tgl_pinjam,
            'kembali' => $tgl_kembali,
            'statuse' => 'dipinjam',
        ]);

        $id_peminjaman_baru = $db_con->lastInsertId();

        // --- LANGKAH 4: Insert ke Tabel Detail Peminjaman ---
        $todata = $db_con->prepare("INSERT INTO `detail_peminjaman` (`id_peminjaman`, `id_buku`, `tgl_dikembalikan`, `denda`) 
                                VALUES (:peminjam, :buku, :tgl, :denda)");
        $todata->execute([
            'peminjam' => $id_peminjaman_baru,
            'buku'     => $buku,
            'tgl'      => null,
            'denda'    => 0,
        ]);

        $db_con->commit();
        echo "Peminjaman berhasil dan stok telah diperbarui!";
    } catch (Exception $e) {
        $db_con->rollBack();
        echo "Gagal: " . $e->getMessage();
    }
}
