<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ログイン</title>
</head>
<body>
<h1>ログイン</h1>
<hr>
<form action="member.php" method="post">
ログインID：<input type="text" name="login_id"><br>
パスワード：<input type="password" name="login_pass">　<input type="reset" value="クリア"><br>
<input type="submit" value="ログイン">
</form>
</body>
</html>
