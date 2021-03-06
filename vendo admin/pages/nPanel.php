<?php
include("config.php");

function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}
function endsWith($haystack, $needle) {
    // search forward starting from end minus needle length characters
    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
}

function getIcon($notification) {
    	if(startsWith($notification, "Dispensing Item:")){
			return "<i class='fa fa-level-down fa-fw'></i> ";
	}elseif(startsWith($notification, "Updating Credit:")){
			return "<i class='fa fa-btc fa-fw'></i> "; 
	}elseif(startsWith($notification, "New Transaction:")){
			return "<i class='fa fa-shopping-cart fa-fw'></i> "; 
	}elseif(startsWith($notification, "Updating Income:")){
			return "<i class='fa fa-money fa-fw'></i> "; 
	}elseif(startsWith($notification, "Updating Stock:")){
			return "<i class='fa fa-line-chart fa-fw'></i> "; 
	}elseif(startsWith($notification, "Checking Stock:")){
			return "<i class='fa fa-bar-chart fa-fw'></i> "; 
	}elseif(startsWith($notification, "Printing Receipt:")){
			return "<i class='fa fa-print fa-fw'></i> "; 
	}elseif(startsWith($notification, "Alert: Sending SMS")){
			return "<i class='fa fa-mobile-phone fa-fw'></i> "; 
	}elseif(startsWith($notification, "Web Application")){
			return "<i class='fa fa-desktop fa-fw'></i> "; 
	}
}

$results1 = $mysqli->query("SELECT * FROM notifications ORDER BY notification_id DESC LIMIT 10");
if ($results1) { 
	while($obj1 = $results1->fetch_object()){
		echo "<a href='#' class='list-group-item'>";
		echo getIcon($obj1->notification);
		echo $obj1->notification;
		echo "<span class='pull-right text-muted small'><em>".$obj1->date_time."</em></span></a>";
    }    
}

/*
Coin Inserted
Server Started
Server Error

*/
?>
