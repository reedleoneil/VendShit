<?php include("config.php");?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Vending Machine UI 1.0">
    <meta name="author" content="LeoNeilReed">

    <title>Vending Machine UI 1.0</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/heroic-features.css" rel="stylesheet">
	
    <!--Vendo CSS-->
    <link href="css/vendo.css" rel="stylesheet">

    <!--Video.js CSS-->
    <link href="video-js-5.2.0/video-js.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--Video.js-->
    <script src="video-js-5.2.0/video.js"></script>   

    <!--idle.js-->
    <script src="idle.js"></script>

</head>

<style>
.tooltip > .tooltip-inner {
    background-color: black; 
    color: white; 
    border: 2px solid yellow;
    padding: 15px;
    font-size: 15px;
    text-shadow: 0 0 5px #fff, 0 0 10px #fff, 0 0 15px #fff, 0 0 20px #FFDD1B, 0 0 35px #FFDD1B, 0 0 40px #FFDD1B, 0 0 50px #FFDD1B, 0 0 75px #FFDD1B;
}

.tooltip.bottom > .tooltip-arrow {
    border-bottom: 5px solid #FFDD1B;
}
</style>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand neon_violet" style="color:white;" href="#">OTC Medicine Vendo</a>
            </div>
				<ul class="nav navbar-nav navbar-right">
				<li style="font-size:18px;"><a href="#" class="neon_yellow" style="color:white;" data-toggle="tooltip">Credits: &#8369; <span id="credit"></span>.00</a></li>
				</ul>
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container" id="items">
        <!-- Page Features -->
        <div class="row text-center">
			
			<?php 
				$r=1;
				$results = $mysqli->query("SELECT * FROM products WHERE deleted ='0'");
				if ($results) { 
					while($obj = $results->fetch_object()){
						if($r==1){
							$neon_color = "neon_blue";
							$button_color = "#337ab7";
						}elseif($r==2){
							$neon_color = "neon_green";
							$button_color = "#5CB858";
						}elseif($r==3){
							$neon_color = "neon_orange";
							$button_color = "#f0ad4e";
						}elseif($r==4){
							$neon_color = "neon_red";
							$button_color = "#d9534f";
						}else{
							//meaning $r == 5
							$neon_color = "neon_blue";
							$button_color = "#337ab7";
							$r=1;
						}
						
						//items
						echo "<div class='col-md-3 col-sm-6 hero-feature'>
						<div class='thumbnail'>
						<img src='images/".$obj->brand_name.".jpg'>
						<div class='caption'>
						<h3 class='".$neon_color."'>".$obj->brand_name."</h3>";
						if($obj->stock >= 1){
							echo "<p id='".$obj->product_id."_price' class='".$neon_color."'>&#8369; ".strval(number_format($obj->price, 2))."</p>";
						}else{
							echo "<p id='".$obj->product_id."_price' class='".$neon_color."'>OUT OF STOCK</p>";
						}
						echo "<p>";
						if($obj->stock >= 1)
						echo "<a href='#' id='".$obj->product_id."_".$obj->price."_".$obj->slot."' class='btn btn-primary buy_button' style='background-color: ".$button_color."; border-color: white;'>Buy Now!</a> "; 
						echo "<button id='".$obj->product_id."_more_info' type='button' class='btn btn-default more_info' data-toggle='modal' data-target='#".$obj->product_id."_modal'>More Info</button>
						</p>
						</div>
						</div>
						</div>";
						
						$r++;
					}
				}
			?>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

			<?php 
				$r=1;
				$results = $mysqli->query("SELECT * FROM products WHERE deleted ='0'");
				if ($results) { 
					while($obj = $results->fetch_object()){
						if($r==1){
							$neon_color = "neon_blue";
							$button_color = "#337ab7";
						}elseif($r==2){
							$neon_color = "neon_green";
							$button_color = "#5CB858";
						}elseif($r==3){
							$neon_color = "neon_orange";
							$button_color = "#f0ad4e";
						}elseif($r==4){
							$neon_color = "neon_red";
							$button_color = "#d9534f";
						}else{
							//meaning $r == 5
							$neon_color = "neon_blue";
							$button_color = "#337ab7";
							$r=1;
						}

						//modal
						echo "<div id='".$obj->product_id."_modal' class='modal fade info_modal' role='dialog'>
						<div class='modal-dialog'>

						<!-- Modal content-->
						<div class='modal-content'>
							<div class='modal-header' style='background-color: ".$button_color.";'>
								<button type='button' class='close' data-dismiss='modal'>&times;</button>
								<h4 class='modal-title' style='text-align:center;'>".$obj->brand_name."</h>
							</div>
							<div class='modal-body'>";

$results1 = $mysqli->query("SELECT * FROM settings WHERE setting ='more_info'");
$obj1 = $results1->fetch_object();

//video add class="video-js" for theme
echo "<video class='video-js1' id='".$obj->product_id."_video' preload='auto' style='width: 100%;"; 

if($obj1->value == "info")
echo "display:none;"; 

echo "' data-setup='{}'>
    <source src='videos/".$obj->brand_name.".mp4' type='video/mp4'>
</video>";

if($obj1->value == "info"){
echo "<pre>";
echo file_get_contents("info/".$obj->brand_name.".txt");
echo "</pre>";
}

							echo "</div>
							<div class='modal-footer' style='background-color: ".$button_color.";'>
								<button id='".$obj->product_id."_close_info' type='button' class='btn btn-default close_info' data-dismiss='modal'>Close</button>
							</div>
						</div>

						</div>
						</div>";
						
						$r++;
					}
				}
			?>

<!-- Advertisment Modal -->
<div id="advertismentModal" class="modal fade " role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color:#FFDD1B">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Tap the screen to Buy</h4>
      </div>
      <div class="modal-body">
<?php
$results1 = $mysqli->query("SELECT * FROM settings WHERE setting ='advertisments'");
$obj1 = $results1->fetch_object();
if($obj1->value == "video"){
echo "<video id='ads' class='video-js' style='width: 100%'
  controls preload='auto'
  data-setup='{}'>
 <source src='videos/Advertisment.mp4' type='video/mp4' />
</video>

<script>

	var items = Array(";
$results = $mysqli->query("SELECT * FROM products WHERE deleted ='0'");
if ($results) { 
	while($obj = $results->fetch_object()){
		echo "'".$obj->brand_name."', ";	
	}
}
echo " 'Advertisment');

myPlayer1 = videojs('ads');
	myPlayer1.currentTime(0);
	myPlayer1.play();
	myPlayer1.volume(0);
	var m=1;
	myPlayer1.on('ended', function(){ 
		item = items[m-1];
		myPlayer1.src('videos/' + item + '.mp4');
		myPlayer1.currentTime(0);
		myPlayer1.play();
		max = items.length;
		if(m < max){
			m++;
		}else{
			m=1;
		}
	});

</script>";
}else{
	include("socialfeed.php");
	echo "<video style='display:none;' id='ads' class='video-js' style='width: 100%' controls preload='auto' data-setup='{}'></video>"; //for bug
}
?>
      </div>
      <div class="modal-footer" style="background-color:#FFDD1B">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"></script> 

	<!--Vendo Scripts-->
	<script type="text/javascript">
	notification = "Web Application: Started!";
	$.post("notification.php", {notification:notification}, function(data, status){
		//alert(data);
	});

	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip({title: "Insert Coin", placement: "bottom", trigger:"manual"}); 	
	});

	setTimeout(function(){
		end = 1;
		c = 0;
		setInterval(function(){ 
		if(end == 1){
			end = 0;
			$.post("credit.php", function(data, status){
				if(!isNaN(data)){ //if data is the one we send to arduino ex: printing blah blah blah
        				$("#credit").text(data);
					if(c != data){
						$("[data-toggle='tooltip']").tooltip('hide');

						$("#advertismentModal").trigger( "click" );

						notification = "Updating Credit: &#8369 " + data + ".00";
						$.post("notification.php", {notification:notification}, function(data, status){
							//alert(data);
		        			});
					}
					c = data;
				}
    			})//;
			.done(function(){
					
			})
			.fail(function(){
				//alert("Warning: Someone is hacking into our network!");
				notification = "Web Application: Closed!";
				$.post("notification.php", {notification:notification}, function(data, status){
					//alert(data);
		        	});
			})
			.always(function(){
				end = 1;
			});
		}
		}, 100);
	}, 0);
	
	$(".neon_yellow").click(function(){
		//alert("refunding");
		$.post("refund.php", function(data){
			//alert("refunded");
		});
	});

	$(".buy_button").click(function(){
		str = $(this).attr("id");
		res = str.split("_");
		product_id = res[0];
		price = parseInt(res[1]);
		slot = parseInt(res[2]);
		credit = parseInt($("#credit").text());
		if(credit >= price){
			$("[data-toggle='tooltip']").tooltip('hide');
			$.post("vend.php", {slot:slot, price:price, product_id:product_id}, function(data, status){
				//alert(data);
		        });
		}else{
			$("[data-toggle='tooltip']").tooltip('show');
		}
	});

	$(".more_info").click(function(){
		str = $(this).attr("id");
		res = str.split("_");
		video = res[0];
		video = video + "_video";
		var myPlayer = videojs(video);
		myPlayer.currentTime(0);
		myPlayer.play();
	});

        $(".info_modal").on('hide.bs.modal', function () {
            	str = $(this).attr("id");
		res = str.split("_");
		video = res[0];
		video = video + "_video";
		var myPlayer = videojs(video);
		myPlayer.pause();
		myPlayer.currentTime(0);
	});

	$("#advertismentModal").on('hide.bs.modal', function () {
		var myPlayer = videojs("ads");
		myPlayer.volume(0);
	});

	var awayCallback = function(){
		console.log(new Date().toTimeString() + ": away");
		$(".info_modal").modal("hide");

		$("#advertismentModal").modal("show");
		var myPlayer = videojs("ads");
		myPlayer.volume(1);
		
		notification = "Web Application: Idle";
		$.post("notification.php", {notification:notification}, function(data, status){
			//alert(data);
		});
	};
	var awayBackCallback = function(){
		console.log(new Date().toTimeString() + ": back");
		$("#advertismentModal").modal("hide");

		notification = "Web Application: New Customer";
		$.post("notification.php", {notification:notification}, function(data, status){
			//alert(data);
		});
	};
	var onVisibleCallback = function(){
		console.log(new Date().toTimeString() + ": now looking at page");
	};
	var onHiddenCallback = function(){
		console.log(new Date().toTimeString() + ": not looking at page");
	};
	var idle = new Idle({
		onHidden: onHiddenCallback,
		onVisible: onVisibleCallback,
		onAway: awayCallback,
		onAwayBack: awayBackCallback,
		awayTimeout: 60000
	}).start();

	setInterval(function(){ 
		//alert("ok");
		$("#items").load("items.php");
	},2000);
	</script>

</body>

</html>

