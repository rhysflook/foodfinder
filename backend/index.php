<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/style_index.css" media="screen and (min-width:1000px)">
	<link rel="stylesheet" href="css/mobile_index.css.css" media="screen and (max-width:999px)">
	<title>FF</title>

</head>

<body>
		<div id="blank">
			<h1></h1>
		</div>

<div id="container">


	<h1 id="Heading">Login</h1>
	<hr>
		<div id="login_form">
			<form action="member.php" method="post">
					ログインID：<input type="text" name="login_id"><br>
					パスワード：<input type="password" name="login_pass"><br>
					<input type="submit" value="ログイン">
					<input type="reset" value="クリア">
			</form>
		</div>
</div>
<div>
<footer>
	<p>(C) Cygames, Inc.</p>
</footer>
</div>

</body>
<script>
	document.body.oncontextmenu = function () {return false;}
</script>
</html>
