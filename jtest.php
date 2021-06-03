<script src="//code.jquery.com/jquery.min.js"></script>
<script>

$(function() {

		timer = setInterval( function () {

			$.ajax ({
				"url" : "http://www.everyboardy.com/realtime/clicks.php",
				cache : false,
				success : function (html) { 
					console.log(html);
					$("#clicks").text(html);
				}
			});

/*
			$.ajax({
				url: "http://www.everyboardy.com/realtime/clicks.php",
			}).done(function(data) {
				console.log(data);
				document.write(data);
			});
*/
		/*
			$.get("http://www.everyboardy.com/realtime/clicks.php", function(data){
				console.log(data);
				document.write(data);
			});
		*/

	}, 1000); 
});

</script>

<body>
	<div style="border:1px solid #dedede; width:600px; height:250px; line-height:250px; color:#666;font-size:100px; text-align:center;" id="clicks">
	</div>
</body>
