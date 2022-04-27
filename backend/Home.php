 

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/style_Home.css" media="screen and (min-width:1000px)">
		<link rel="stylesheet" href="css/mobile_Home.css" media="screen and (max-width:999px)">
		<title>FF</title>
	


	</head>
	<body>
<script>
	<!--document.oncontextmenu = function() { alert("右クリック禁止"); return false; }-->
</script>


	<!-- baseページです -->
	<div id="top">
		<div id="header_left">
			<h1><a href="Home.php"><img src="images/uma_logo.png" alt="ウマ娘"></a></h1>
		</div>
		<div id="header_right">
			<h1>FF</h1>
		</div>

	</div>
		<div id="blank">
			<h1></h1>
		</div>
		<div id="container">
			<h1>Home</h1>

			<nav>
				<ul>
					<li id="nav_Game"><a href="Game.php">Game</a></li>
					<li id="nav_Animation"><a href="Animation.php">Animation</a></li>
					<li id="nav_Event"><a href="Event.php">Event</a></li>
					<li id="nav_Products"><a href="Products.php">Products</a></li>
					<li id="nav_community"><a href="community.php">community</a></li>
					<li id="nav_PrivacyPolicy"><a href="PrivacyPolicy.php">Privacy<br>Policy</a></li>
				</ul>
			</nav>

			<div id="Home">

				<div class="mbox02">
					<!--<div class="imagearea_bar">
						<h2>Menu</h2>
					</div>-->
						<!--<div class="menu_area">
							<figure>
								<video src="video/Girls_Legend_U_0.mp4" controls></video>
								<figcaption>********************</figcaption>
							</figure>
							<figure>
								<video src="video/winning_the_soul_0.mp4" controls></video>
								<figcaption>********************</figcaption>
							</figure>
							<figure>
								<video src="video/komorebino_yell_0.mp4" controls></video>
								<figcaption>********************</figcaption>
							</figure>
							<figure>
								<video src="video/uma_pyoi_0.mp4" controls></video>
								<figcaption>********************</figcaption>
							</figure>
								<video src="video/game_PV.mp4" controls></video>
								<figcaption>********************</figcaption>
							</figure>
						</div>-->
				</div>
			</div>

			
    <script src="jquery-3.6.0.min.js"></script>
    <script>
        $(function(){
            let imageArea = [];
            $("#imageArea img").each(function(index,element){
                $("#paging").append("<span data-img='"+ $(element).attr("src")+ "'></span>");
                imageArea[index] = element;
            });
            $("#paging span:first-child").addClass("active");
            $("#next").click(function(){
                $("#imageArea:not(:animated)").animate({"margin-left":-650 + "px"},700,function(){
                    $("#imageArea").append($("#imageArea img:first-child"));
                    $("#imageArea").css("margin-left",0);
                $("#paging span").removeClass("active");
                $("#paging span[data-img='" + $("#imageArea img:first-child").attr("src") + "']").addClass("active");

                });
            });
            $("#prev").click(function(){
                $("#imageArea:not(:animated)").css("margin-left",-650 + "px");
                $("#imageArea:not(:animated)").prepend($("#imageArea img:last-child"));
                $("#imageArea:not(:animated)").animate({"margin-left":0},700,function(){
                    $("#paging span").removeClass("active");
                    $("#paging span[data-img='" + $("#imageArea img:first-child").attr("src") + "']").addClass("active");
                });
            });
            $("#paging span").click(function(){
                // console.log(imageArea);

                let max = imageArea.length;
                let index =$(this).index() == 0 ? max - 1 : $(this).index() -1 ;
                console.log(index);
                $("#imageArea").html("");
                for( let i = index ; i < max + index ; i++ ){
                    $("#imageArea").append(imageArea[i % max]);
                }
                $("#next").click();
            });
            let timer = setInterval(function(){
                $("#next").click();
            },2000);
            $("#slider").mouseover(function(){
                clearInterval(timer);
                $("#navigation span").css("display","block");
            }).mouseout(function(){
                timer = setInterval(function(){
                $("#next").click();
            },2000);
            $("#navigation span").hide();
            });
        });
    </script>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        #imageArea{
            display: flex;
            width: 10000px;
        }
        #slider{
            width: 650px;
            overflow: hidden;
            margin: 0 auto;
            position: relative;
        }
        #navigation span{
            position: absolute;
            top: calc( 50% - 30px );
            display: block;
            width: 60px;
            background-color: rgba(0, 0, 0, 0.5);
            color: aliceblue;
            font-size: 55px;
            text-align: center;
            line-height: 70px;
            height: 75px;
            cursor: pointer;
            display: none;
            user-select: none;
        }
        #next{
            right: 0;
        }
        #paging span{
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 10px;
            margin: 5px;
            cursor: pointer;
            background-color: rgba(0, 0, 0, 0.5);
            border: 2px solid #fff;
            box-sizing: border-box; /*そのままの大きさを保つ*/
        }
        #paging{
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            text-align: center;
        }
        #paging span.active{
            background-color: rgb(255, 174, 0);
        }
    </style>
</head>
<body>
    <div id="slider">
        <div id="imageArea">
            <img src="slider_img01.jpg" width="650" height="450">
            <img src="slider_img02.jpg" width="650" height="450">
            <img src="slider_img03.jpg" width="650" height="450">
            <img src="slider_img04.jpg" width="650" height="450">
            <img src="slider_img05.jpg" width="650" height="450">
            <img src="slider_img06.jpg" width="650" height="450">
            <img src="slider_img07.jpg" width="650" height="450">

		</div>
        <div id="navigation">
            <span id="next">&gt;</span>
            <span id="prev">&lt;</span>
        </div> 
        <div id="paging">

        </div>   
    </div>
</body>

				<div class="mbox01">
					<h2>Information</h2>
					<ul>
						<li>新着情報1</li>
						<li>新着情報2</li>
						<li>新着情報3</li>
						<li>新着情報4</li>
					</ul>
				</div>
		<div>
			<form action="logout.php" method="post">
					<input id="logout_btn" type="submit" value="ログアウト">
			</form>
		</div>



			<footer>
				<p>(C) Cygames, Inc.</p>
			</footer>
		</div>


	</body>
</html>
