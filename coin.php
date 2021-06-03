<?php
 header('Access-Control-Allow-Origin: *');

$today_date=date("Ymd");
$url="https://api.bithumb.com/public/ticker/BTC";
?>
<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<script>

$(function() {

		timer = setInterval( function () {

			$.ajax ({
				"url" : "https://api.bithumb.com/public/ticker/BTC",
				cache : false,
				dataType: 'json',
				success : function (html) { 
					$("#listInfo").text(html.data.closing_price);
				}
			});

			$.ajax ({
				"url" : "https://api.bithumb.com/public/ticker/ETH",
				cache : false,
				dataType: 'json',
				success : function (html) { 
					$("#listInfo2").text(html.data.closing_price);
				}
			});

	}, 1000); 
});

</script>

<div id="listInfo"></div>
<div id="listInfo2"></div>