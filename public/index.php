<?php 
	
	/*
		Yorum Sistemi -> İndex Sayfası
		21-10-2015 -> 12:22
		TOLGA TURAN
	*/
// Mysql Bağlantısı
require_once 'Db.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>Ziyaretçi Yorum Sistemi</title>
	<link rel="stylesheet" href="style/custom.css" type="text/css" />
	<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="js/jquery.tipsy.js"></script>
	<script type="text/javascript" src="js/site.js"></script>
</head>
<body>

<!-- Genel Alan -->
<div id="genel">
	<!-- Yorum alanı Sol -->
	<div id="sol">
		<!-- Yorum Yap Formu -->
		<div id="yorumYap">
			<?php 
			// Toplam Yorum Sayısını Bulma ;
			$toplam = $db->query('SELECT * FROM yorumlar');
			$rows   = $toplam->rowCount();
			?>
			<h3>Tüm Yorumlar (<?php echo $rows; ?>)</h3>
			<div class="clear"></div>
			<div id="sonuc"></div>
			<form action="" method="post" id="yorumG"  onsubmit="return false">
			<textarea name="ad" placeholder="Adınızı Yazın ..."></textarea>
			<textarea name="yorum" placeholder="Yorum Yazın ..."></textarea>
			<div id="yGonder">
				<input type="submit" id="gonder" class="btn" value="Yorumu Gönder" />
				<span>İptal Et</span>
			</div>
			</form>
			<div class="clear"></div>
		</div>
		<!--#Yorum Yap Formu -->

		<div class="clear"></div>

		<!-- Yorumlar -->
		<div id="yorumlar">
			<?php 
				// Yorum Listeleme ;
				$yorum_liste = $db->query("SELECT * FROM yorumlar order by yorum_id DESC" , PDO::FETCH_ASSOC);
				foreach ($yorum_liste as $yorum_row) {
				$yorum_id = $yorum_row['yorum_id'];					
			?>
			<!-- Yorum -->
			<div class="yorum">
				<div class="yorumSag">
					<div class="cevapla">
						Cevapla
					</div>
					<strong>@<?php echo $yorum_row['yorum_adsoyad']; ?></strong>
					<div class="clear"></div>
					<p ><?php echo $yorum_row['yorum'] ?></p>
				</div>
				<div class="yorumaYorumYap">
					<form action="yorum_gonder.php?yorum&cevap" method="post" id="altYorum" >
					<input type="hidden" name="yorum_hangisi" value="<?php echo $yorum_id; ?>" />
					<input type="text" name="yorum_ad" class="ad" placeholder="Adınızı Yazın ..." />
					<textarea name="yorum" rows="0" cols="0"></textarea>
					<div class="clear"></div>
					<div class="yyyGizli">
						<input type="submit" id="gonderAlt" class="btn" value="Gönder" />
						<span>İptal Et</span>
					</div>
					</form>
				</div>
				<?php 
					// Yoruma Verilen Cevaplar ;
					$yorum_cevap = $db->query("SELECT * FROM yorum_alt WHERE yorum_hangisi=$yorum_id ", PDO::FETCH_ASSOC);
					foreach ($yorum_cevap as $key => $yorum_cevap_row) { ?>
					<!-- Alt Yorumlar -->
					<div id="altYorumlar">
					
						<div class="alt_yorum">
							<strong>@<?php echo $yorum_cevap_row['yorum_ad']; ?></strong>
							<div class="clear"></div>
							<p><?php echo $yorum_cevap_row['yorum']; ?></p>
						</div>
					</div>
					<!--#Alt Yorumlar -->	

				<?php }?>
			</div>
			<!--#Yorum -->
			<?php 
				} 
				// Yorum Yoksa Yok Yazdıralım ;
				$yorumlar = $db->query('SELECT * FROM yorumlar');
				$yorumm   = $yorumlar->rowCount();
				if($yorumm == 0){
					echo '<div style="padding:10px 10px 10px 10px;border:1px solid #ddd;margin-bottom:10px;background-color:lightpink;color:green;font-weight:bold">
						Hiç Yorum Yazılmamış. İlk Yorumu Yapmak İstemez misiniz ?
					</div>';
				}
			?>
				<!-- Sayfalama -->
				<div class="clear"></div>
				<div class="dahaFazlasi"></div>
				<!--#Sayfalama -->
		</div>
		<!--#Yorumlar -->
	</div>
	<!--#Yorum alanı Sol -->
</div>
<!--#Genel Alan -->

</body>
</html>