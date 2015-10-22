/*
*	@Yorum Java Dosyası
*/
$(function(){
	$("#yorumYap textarea").click(function(){
		$(this).animate({height: "60px"}, 350);
		$("#yGonder").fadeIn();
	});	
	$("#yGonder span").click(function(){
		$("#yorumYap textarea").animate({height: "15px"}, 350);
		$("#yGonder").hide();
	});	
	$(".yorum").hover(function(){
		$(".cevapla", this).show();
	}, function(){
		$(".cevapla", this).hide();
	});
	$(".cevapla").click(function(){
		var kim = $(this).next("strong").text();
		$(this).parent().next(".yorumaYorumYap").slideDown();
		$(this).parent().next(".yorumaYorumYap").find("textarea").val(kim + ", ");
	});	
	$(".yyyGizli span").click(function(){
		$(this).parent().parent().slideUp();
	});	
	$(".alt_yorum:even").css("background-color","#f1f1f1");

	// Yorum Gönderme 
	$("#gonder").click(function(){
		var degerler = $("#yorumG").serialize();
		 $.ajax({
            type: 	"post",
            url: 	"yorum_gonder.php",
            data : 	 degerler,
            success : function(cevap){
               $('#sonuc').html(cevap);
            }
        });
	});

	/*
		Yorum Listesi Sayfalaması;
	*/

	// Toplam Veri Listesi
	var toplamLi = $(".yorum").size();
	// Gözükecek  Listeleme Sayı
	var veriSayisi = 7;
	// Uygula
	$(".yorum:gt(" + (veriSayisi-1) + ")").hide();
	// Sayfa Sayısını Yuvarla
	var sayfaSayisi = Math.ceil(toplamLi / veriSayisi);
   // Sayfa Linkleri
	for (var i = 1; i <= sayfaSayisi; i++) {
		$(".dahaFazlasi").append('<a href="javascript:void(0)">' + i );
	}
	// Sayfalama numaralara Tıklandığında Gitme
	$(".dahaFazlasi a,i").on("click", function () {
		var indis = $(this).index() + 1;
		var gt = veriSayisi * indis;
		$(".yorum").hide();
		for (i = gt - veriSayisi; i < gt; i++) {
			$(".yorum:eq(" + i + ")").fadeIn("slow");
		}
	});

});