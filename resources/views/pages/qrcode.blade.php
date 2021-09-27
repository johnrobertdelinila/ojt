<!DOCTYPE>
<html>
<style>

@media print {
    @page {
        margin-top: 0;
        margin-bottom: 0;
    }
    body {
        margin-top: .5in;
    }
}

</style>
<head>
	<title>QR CODE GENERATOR</title>
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/qrcode.js"></script>
</head>
<body style="font-family:calibri;">
@foreach($post as $posts)
	<input id="qrtext<?php echo $posts->id ?>" type="hidden" value="{{ $posts->qrcode }}" style="width:80%"/>
	<div style="float:left;margin-right:60px;">
	<div id="qrcode<?php echo $posts->id ?>" style="width:150px; height:150px;"></div>
	<div style="width:150px;font-size:20px;text-align:center;margin-bottom:20px;">
		{{ $posts->qrcode }}<br/>
		{{ $posts->buyer_name }}<br/>
		₱{{ number_format($posts->item_amount,2) }}<br/>
	</div>
	<script type="text/javascript">
		var qrcode = new QRCode(document.getElementById("qrcode<?php echo $posts->id ?>"), {
			width : 150,
			height : 150
		});

		function makeCode () {		
			var elText = document.getElementById("qrtext<?php echo $posts->id ?>");
			if (!elText.value) {
				alert("Input a text");
				elText.focus();
				return;
			}
			qrcode.makeCode(elText.value);
		}

		makeCode();

		$("#qrtext<?php echo $posts->id ?>").
		on("blur", function () {
			makeCode();
		}).
		on("keydown", function (e) {
			if (e.keyCode == 13) {
				makeCode();
			}
		});
	</script>
	</div>
@endforeach
<button id="btn_print" style="width:200px;height:50px;font-size:20px;font-weight:bold;border:1px solid black;cursor:pointer;">PRINT</button>
<script>
		$('#btn_print').on('click',function(event){
			$(this).hide();
			window.print();
			$(this).show();
		});
</script>
</body>