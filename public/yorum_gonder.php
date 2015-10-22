<?php 
	
	/*
		Yorum Sistemi -> Yorum Gönderilme Sayfası
		21-10-2015 -> 12:22
		TOLGA TURAN
	*/

// DB Dosyası
require_once 'Db.php';

$yorum = @$_GET['yorum'];
// Yoruma Gönderilen Cevap ;
if(isset($_GET['cevap']) == 'cevap'){
	// Yoruma Cevap Yazma;
	if($_POST){
		// Formdan gelen bilgiler ;
		$yorum_ad 		= $_POST['yorum_ad'];
		$yorum_hangisi 	= $_POST['yorum_hangisi'];
		$yorum 			= $_POST['yorum'];
		$yorum_tarih 	= date('d/m/Y');

		$kaydet 		= $db->prepare("INSERT INTO yorum_alt set 
						  yorum_ad 		= ? ,
						  yorum_hangisi = ? ,
						  yorum_tarih 	= ? ,
						  yorum 		= ? ");
		$kaydet->execute(array($yorum_ad,$yorum_hangisi,$yorum_tarih,$yorum));
		
		// Kayıt Kontrolü ;
		if($kaydet->rowCount()){
			header("Location:index.php");
		}else{
			header("Location:index.php");
		}
	}

}else{

	if($_POST){
		// Formdan gelen bilgiler ;
		$ad 	= $_POST['ad'];
		$yorum 	= $_POST['yorum'];
		$tarih  = date('d/m/Y');

		$kaydet = $db->prepare("INSERT INTO yorumlar set
				  yorum_adsoyad = ? ,
				  yorum_tarih   = ? ,
				  yorum 		= ? ");
		$kaydet->execute(array($ad,$tarih,$yorum));

		// Kayıt Kontrolü ;
		if($kaydet->rowCount()){
			echo '<div style="font-weight:bold;color:green;padding:10px 10px 10px 10px">
			Tebrikler ! Yorumunuz Gönderildi.<br />
			<a href="index.php">Geri Dön</a>
			</div>';
		}else{
			echo '<div style="font-weight:bold;color:red;padding:10px 10px 10px 10px">
			Hata ! Lütfen Daha Sonra Tekrar Deneyiniz.<br />
			<a href="index.php">Geri Dön</a>
			</div>';
		}
	}
}
?>