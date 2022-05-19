<!DOCTYPE html>

<?php 
    session_start();

    if (true) {
        try {
            $dsn = "mysql:host=192.168.40.64;dbname=b202213;charset=utf8";
            $u = "user1";
            $p = "pass1";
            $pdo = new PDO( $dsn, $u, $p );
    
            $sql = "SELECT * FROM kiniiri WHERE user_id = :id";
            $st = $pdo->prepare( $sql );
            $st->bindValue( ":id", 5, PDO::PARAM_INT );
            $st->execute();
    
            $result = $st->fetchAll( PDO::FETCH_ASSOC );

            if ( isset($result) ) {
				for( $i = 0 ; $i < 3 ; $i++ ){
					$_SESSION["kiniiri"] = $result;
				}
}
        }
        catch ( Exception $e ) {
            echo "接続できませんでした。";
        }
    }            else {
                header( "Location:login.php" );
                exit();            
            }
?>

<html>
<head>
</head>
<body>
	<?php foreach($_SESSION["kiniiri"] as $key=>$value): ?>
   <div class="shop" id="<?php echo $value['google_id'] ?>">
		<?= $value["google_id"] ?>
	</div>
    <?php endforeach; ?>
	<script type="module" src="../src/kiniiri.js"></script>
	<script
	    id='google'
	    defer
	    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxcVTM6J2AoRuhC6guYnS_B4_jAO78ctI&libraries=places"
	>
	</script>

</body>
</html>


