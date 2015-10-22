<?php 
	
	/*
		Yorum Sistemi -> Mysql Bağlantısı
		21-10-2015 -> 12:21
		TOLGA TURAN
	*/
ob_start();

	$host   		= "localhost";
	$dbismi 		= "defter"; 
	$dbkullanici 	= "root"; 
	$dbsifre 		= ""; 
	try{
		$db = new PDO("mysql:host={$host};dbname={$dbismi}", $dbkullanici, $dbsifre, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
	} catch (PDOException $e){
		return 'Baglanti hatasi '. $e->getMessage();
	}	

?>

