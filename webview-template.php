<?php
// Webview base template

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

switch($_SERVER['REQUEST_METHOD']){
	case 'GET':
		$_request = &$_GET;
	break;
	case 'POST':
		$_request = &$_POST;
	break;
	default:
		$_request = &$_GET;
}

// grab the messenger ID from the POST/GET from ChatFuel
$msgrID    = (!empty($_request['messenger_user_id']))? $_request['messenger_user_id'] : '';
$goToBlock = (!empty($_request['goToBlock']))? $_request['goToBlock'] : '';
?>
<!doctype html>
<html lang="fr">
<head>
<title>Webview Template</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- bootstrap styles -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css">

<style>
.footer {
	margin-top: 25px;
	padding: 15px;
	position: fixed;
	bottom: 0;
	width: 100%;
}
#done-btn {
	cursor: pointer;
}
</style>
</head>
<body>
<!-- messenger extensions sdk -->
<script type="text/javascript">
(function(d, s, id){
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.com/en_US/messenger.Extensions.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'Messenger'));
</script>
<!-- /messenger extensions sdk -->

<div class="container">

	<h4 class="text-center">MY GERO</h4>

	<div class="col">
		<p>
			contenus de ma page
		</p>
	</div>

	<form>
		<input type="hidden" name="messenger_user_id" value="<?php echo $msgrID; ?>">
		<input type="hidden" name="goToBlock" value="<?php echo $goToBlock; ?>">
		<input type="hidden" name="SomeCustomField1" value="Anything You Want">
		<input type="hidden" name="SomeCustomField2" value="Anything You Want">
	</form>


</div>
<footer class="footer">
	<button type="submit" id="done-btn" class="btn btn-primary btn-block">OK</button>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	$("#done-btn").on("click", function(e) {
		e.preventDefault();
		// if you want to pass data BACK to ChatFuel,
		// then uncomment this and post the data
		// to broadcast-from-webview.php
		/*
		$.ajax({
			type: 'POST',
			url: 'broadcast-from-webview.php',
			data: $('form').serialize(),
			dataType: 'json',
			success: function(data) {
				MessengerExtensions.requestCloseBrowser();
			}
		});
		*/
		// If you want to just close the webview,
		// then leave this uncommented
		MessengerExtensions.requestCloseBrowser();
	});
});
</script>
</body>
</html>