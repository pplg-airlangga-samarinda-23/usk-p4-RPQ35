<?php
require_once(dirname(__DIR__, 1) . '../database/db-con.php');

$denda=$_POST['denda'];
$ids=$_POST['ids'];

$update=db_con->prepare(" UPDATE `detail_peminjaman` SET `denda`=:denda WHERE `id`=:ids");
$update->execute([
    'denda'=>$denda,
    'ids'=>$ids,
]);


header("Location:".trim($_SERVER['REQUEST_URI'],'update.php'));