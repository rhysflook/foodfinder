<!DOCTYPE html>
<html>
  <head>
    <title>Details</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,500;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
  </head>
  <body>
    <div class="container">
      <div class="left-side">
        <div class="title" id="title"></div>
        <div class="reviews" id="reviews"></div>
      </div>
      <div class="right-side">
        <div class="photos" id="photos"></div>
      </div>
    </div>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="module" src="../src/details.js"></script>
    <script
        id='google'
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxcVTM6J2AoRuhC6guYnS_B4_jAO78ctI&libraries=places"
        defer
        >
    </script>
  </body>
</html>
