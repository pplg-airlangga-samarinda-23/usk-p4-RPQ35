<?php

session_start();

require_once(__DIR__."/".$_SESSION['role']."/index.php");

echo(__DIR__."/".$_SESSION['role']."/index.php");

var_dump($_SESSION);