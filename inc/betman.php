<?php
$now=date("Ymd");
$gameRound=$_GET['gameRound'];
?>
<!DOCTYPE html>
<html>
<head>


<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="<?=$now?>.js"></script>
<script>
	console.log(memoryGameCount);
    var jsonCheck = JSON.stringify(MemorySlipMarkCart);//json으로 바꿈

    var params='at='+jsonCheck+'&gameRound=<?=$gameRound?>';
	console.log(params);
	$.ajax({
			  type: 'post'
			, url: 'jt2.php'
			,data : params
			, dataType : 'html'
			, success: function(data) {
					console.log(data);
			  }
		});	
</script>
</head>
<body>
test
</body>
</html>