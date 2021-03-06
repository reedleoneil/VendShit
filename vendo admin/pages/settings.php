<?php 
include("config.php");

if(isset($_POST['edit_setting']))
{
	$setting= $_POST['setting'];
	$value= $_POST['value'];
	$mysqli->query("UPDATE settings SET value ='{$value}' WHERE setting='{$setting}'");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Notifications</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Vending Machine Admin 1.0</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
						<li>
                            <a href="products.php"><i class="fa fa-medkit fa-fw"></i> Products</a>
                        </li>
						<li>
                            <a href="transactions.php"><i class="fa fa-shopping-cart fa-fw"></i> Transactions</a>
                        </li>
						<li>
                            <a href="income.php"><i class="fa fa-money fa-fw"></i> Income</a>
                        </li>
						<li>
                            <a href="notifications.php"><i class="fa fa-bell"></i> Notifications</a>
                        </li>
						<li>
                            <a href="settings.php"><i class="fa fa-cogs fa-fw"></i> Settings</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Settings</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Settings
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Setting</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$results = $mysqli->query("SELECT * FROM settings");
if ($results) { 
	while($obj = $results->fetch_object()){
		echo "<tr>";
		echo "<td><a href='#' class='editSetting' data-toggle='modal' data-target='#edit_setting'>".$obj->setting."</a></td>";
		echo "<td class='edit_setting_value'>".$obj->value."</td>";
		echo "</tr>";
    }    
}
?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
            </div>
            <!-- /.row -->
  
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
	
	<!--Add Edit Setting-->
<form class="form-horizontal" role="form" method="post" action="">
	  <div class="modal fade" id="edit_setting" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Setting</h4>
        </div>
        <div class="modal-body">
    <div class="form-group" style="display:none;">
      <label class="control-label col-sm-3">Setting:</label>
      <div class="col-sm-9">  
        <input type="text" class="form-control" id="edit_setting_setting" placeholder="Setting" name="setting">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" id="setting">Value:</label>
      <div class="col-sm-9" id="input_value">  
        <input type="text" class="form-control" id="edit_setting_value" placeholder="Value" name="value">
      </div>
    </div>
        </div>
        <div class="modal-footer">
		  <button type="submit" class="btn btn-default" name="edit_setting">Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</form>

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });

    $(".editSetting").click(function() {
	var $row = $(this).closest("tr");    // Find the row
	var $setting = $(this).closest(".editSetting").text();
	var $value = $row.find(".edit_setting_value").text(); 

	if($setting == "more_info"){
		$("#input_value").html("<select class='form-control' id='edit_setting_value' name='value'>"
    					+ "<option>info</option>"
    				  	+ "<option>video</option>"
  					+ "</select>"
		);
	}else if($setting == "stocks_critical_level"){
		$("#input_value").html('<input type="text" class="form-control" id="edit_setting_value" placeholder="Value" name="value">');
	}if($setting == "advertisments"){
		$("#input_value").html("<select class='form-control' id='edit_setting_value' name='value'>"
    					+ "<option>video</option>"
    				  	+ "<option>social media feed</option>"
  					+ "</select>"
		);
	}
		//alert($("#input_value").html());

	$("#setting").text($setting);
	$("#edit_setting_setting").val($setting);
	$("#edit_setting_value").val($value);
	//alert($id + " " +$brand_name + " " + $generic_name + " " + $stock + " " + $price);
    });
    </script>

</body>

</html>
