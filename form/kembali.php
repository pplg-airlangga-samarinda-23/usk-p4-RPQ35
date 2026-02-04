<?php
require_once(dirname(__DIR__, 1) . '/database/db-con.php');

$data = $db_con->prepare("SELECT 
                p.id_peminjaman,
                u.username AS username_peminjam,
                b.judul AS judul_buku,
                b.id AS id_buku,
                p.tgl_pinjam,
                p.tgl_kembali,
                dp.tgl_dikembalikan,
                p.status,
                dp.denda
            FROM peminjaman p
            JOIN user u ON p.id_user = u.id
            JOIN detail_peminjaman dp ON p.id_peminjaman = dp.id_peminjaman
            JOIN book b ON dp.id_buku = b.id
            WHERE `status`!='kembali'
            ORDER BY p.tgl_pinjam DESC;");
$data->execute();
$data = $data->fetchAll(PDO::FETCH_ASSOC);



require_once(__DIR__ . "/display/kembali.view.php");
