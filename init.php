<?php
session_start();
require_once './vendor/autoload.php';
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ERROR | E_PARSE);
//kết nối csdl
try{
//$db = new PDO('mysql:host=sql304.epizy.com;dbname=epiz_26840056_testdb;charset=utf8', 'epiz_26840056','XtbDRxZI91');
$db = new PDO('mysql:host=localhost;dbname=doanweb1;charset=utf8', 'root','');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
	echo "! Connection failed !" . $e->getMessage();
}

require_once 'functions.php';
require_once 'userfunction.php';
require_once 'adminfunction.php';
$currentUser = GetCurrentUser();
