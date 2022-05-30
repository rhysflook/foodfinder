<?php
namespace foodFinder;
include "./navBar.php"; 
include './getConnection.php';
include "./getScripts.php";
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
$google_id = explode( 'code=', $_SERVER['REQUEST_URI'] )[1];
$user_id = $_SESSION['id'];

$sql = getConnection();
$result = sendRequest(
    "SELECT * FROM reviews WHERE user_id = ? AND google_id = ?",
    ['is', $user_id, $google_id]
);

$results = $result->fetch_all();
$reviews = sendRequest(
  "SELECT * FROM reviews WHERE google_id = ?",
  ['s', $google_id]
);

$reviews = $reviews->fetch_all();

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/details.css">
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="../css/menu.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DotGothic16&family=Kosugi+Maru&family=Rampart+One&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="deets">
    <?php echo getMenuBar(isset($_SESSION['id']))?> 
             <div class="details-section">
               <div class="title-section">
                    <div id="title" class="title">
                   </div>
                   <div class="photos-outer">

                     <div class="photos" id="photos"></div>
                   </div>
                 </div>
           <div class="usr-reviews">
           <div class="reviews" id="reviews"><h3>Google reviews</h3></div>
           <div class="reviews" id="site-reviews"><h3>Bariumasou reviews</h3>
           <?php if (count($reviews) == 0):?>
            <p id="no-r">No reviews to show!</p>
          <?php endif;?>
           <?php foreach($reviews as $key=>$value): ?>
           <div class="user-review">
             <p class="author"> <?php echo $value[2]." -- ".$value[6]; ?> / 5</p>
             <p class="review-content">
               <?php echo $value[4]?>
             </p>
           </div>
           <?php endforeach; ?>
         </div>
           <?php if (count($results) === 0): ?>
           <div id="review-area" class="review-area">
               <textarea id="review-content" placeholder="レビューを書く"></textarea>
               <input type="radio" name="rating" value="1">1
               <input type="radio" name="rating" value="2">2
               <input type="radio" name="rating" value="3">3
               <input type="radio" name="rating" value="4">4
               <input type="radio" name="rating" value="5">5
               <button id="add-review">Confirm</button>
             </div>
             <?php endif; ?>
         </div>
         </div>
    </div>
 
    <?php echo getScripts('details') ?>
    <script type="module" src="../src/review.js"></script>
  </body>
</html>
