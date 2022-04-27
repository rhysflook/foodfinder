<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
		<link rel="stylesheet" href="css/style_registration.css" media="screen and (min-width:1000px)">
		<link rel="stylesheet" href="css/mobile_registration.css" media="screen and (max-width:999px)">
    <title>registration</title>
</head>

<body>
	<div id="blank">
		<h1></h1>
	</div>

<div id="container">

	<h1 id="Heading">registration</h1>

    <hr>
    <?php
    if (isset($_POST["user_id"])) {
        try {
            $dsn = "mysql:host=127.0.0.1;dbname=db3;charset=utf8";
            $u = "user1";
            $p = "pass1";
            $pdo = new PDO($dsn, $u, $p);

            $sql = "SELECT * FROM users WHERE id = :id";
            $st = $pdo->prepare($sql);
            $st->bindValue(":id", $_POST["user_id"], PDO::PARAM_STR);
            $st->execute();

            $result = $st->fetch(PDO::FETCH_ASSOC);
            if ($result) {
				echo"error";
            } else {

                $sql = "INSERT INTO users VALUES(:id,:pass,:name)";
                $st = $pdo->prepare($sql);
                $st->bindValue(":id", $_POST["user_id"], PDO::PARAM_STR);
                $hash = password_hash($_POST["user_pass"], PASSWORD_DEFAULT);
                $st->bindValue(":pass", $hash, PDO::PARAM_STR);
                $st->bindValue(":name", $_POST["user_name"], PDO::PARAM_STR);
                if ($st->execute()) {
				echo "<p id='completion'>登録されました。</p>";

	?>
				<div id="go_to_Home">
					<form action="Home.php" method="post">
					<input type="submit" value="Home"><br>
				</div>
	<?php
                } else {
                    echo "登録できませんでした。";
                }
            }
        } catch (Exception $e) {
            echo "接続できませんでした。";
        }
    } else {
    ?>
		<div id="input_box">
        <form method="post">
            ログイン名：<input type="text" name="user_id"><br>
            パスワード：<input type="text" name="user_pass"><br>
            名　　　前：<input type="text" name="user_name"><br>
            <input type="submit" value="登録"><br>
        
		<?php
    }
        ?>
        </form>
        <hr>

</div>
		<div>
			<footer>
				<p>(C) Cygames, Inc.</p>
			</footer>
		</div>
</body>

</html>