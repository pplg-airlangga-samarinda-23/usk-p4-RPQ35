<?php
require_once(dirname(__DIR__, 1) . '/database/db-con.php');

$data=db_con->prepare("SELECT * FROM `user`");
$data->execute();
$data=$data->fetchAll(PDO::FETCH_ASSOC);


require_once(dirname(__DIR__, 1) . '/user/display/index.php');