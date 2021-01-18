
<?php
session_start();

if(isset($_SESSION['log']) != 1){
    header('location:index.php');
}


if(isset($_SESSION['deptRow']) == 'Hardware Component'){
//header('');
    $_POST['hardPost'] = 'Hardware Component';

}
$hard = $_POST['hardPost'];

require 'config.php';

$deptCalled = 'Hardware Component';

$deptCalled = $_SESSION['deptValue'];

$sql = "SELECT * FROM `asset_list` WHERE STATUS != 'Out of stock' && ASSET_TYPE = 'Hardware Component'";
	$query = mysqli_query($conn,$sql);

	$num_rows = mysqli_num_rows($query);
	
$ql = "SELECT * FROM `asset_list` WHERE STATUS = 'Out of stock' && ASSET_TYPE LIKE 'Hardware Component'";
	$qry = mysqli_query($conn,$ql);

	$numrows = mysqli_num_rows($qry);
	
$sq = "SELECT * FROM `asset_list` WHERE ASSET_TYPE LIKE '$hard'";
	$qy = mysqli_query($conn,$sq);

	$total_rows = mysqli_num_rows($qy);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GSAIMS | Dashboard</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="https://unpkg.com/bootstrap-table@1.18.1/dist/bootstrap-table.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b8fbf31c66.js" crossorigin="anonymous"></script>
    <script src="js/jquery.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-primary shadow fixed-top p-3" style="font-family: Georgia,serif;">
    <div class="container">
        <div class="title">
            <h3 style="color: #f8f8f8">GSAIMS</h3>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="dashboard.php"><i id="fa-columns" class="fas fa-chart-line fa-lg fa-fw ">
                    </i>
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="new.php"><i id="fa-folder-plus" class="fas fa-folder-plus fa-lg fa-fw"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="report.php"><i id="fa-layer-group" class="fas fa-layer-group fa-lg fa-fw"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="php/logout.php"><i id="fa-sign-out-alt" class="fas fa-sign-out-alt fa-lg fa-fw"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<section class="container">
    <div class="row card-group">
        <div class="col-lg-4 col-md-6 col-sm-12 card shadow rounded">
            <div class="row">
                <div class="col-6">
                    <img src="img/png/box.png" style="height: 70%; width: 70%; margin-top: 10px;">
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <p class="figures"><?php echo $num_rows;?></p>
                        <p class="message ">IN STOCK</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12 card shadow">
            <div class="row">
                <div class="col-6">
                    <img src="img/png/out-of-stock.png" style="height: 70%; width: 70%; margin-top: 10px;">
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <p class="figures"><?php echo $numrows;?></p>
                        <p class="message ">OUT OF STOCK</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 card shadow">
            <div class="row">
                <div class="col-6">
                    <img src="img/png/medical-records.png" style="height: 70%; width: 70%; margin-top: 10px;">
                </div>
                <div class="text-right">
                    <p class="figures"><?php echo $total_rows;?></p>
                    <p class="message ">ALL ENTRIES</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container mt-5">
    <div class="row">
        <div class="col-lg-7 col-md-12 col-sm-12">
            <dl>
                <dt style="font-family: Helvetica,serif">
                    Status of Inventory (Pictorial View)
                </dt>
                <dd class="percentage percentage-11"><span class="text">New Goods</span></dd>
                <dd class="percentage percentage-46"><span class="text">Damaged Goods</span></dd>
                <dd class="percentage percentage-5"><span class="text">To Be Repaired</span></dd>
                <dd class="percentage percentage-2"><span class="text">To Be Installed</span></dd>
                <dd class="percentage percentage-2"><span class="text">Reserved Goods</span></dd>
                <dd class="percentage percentage-16"><span class="text">Out of Stock</span></dd>
            </dl>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 card shadow" style="margin-left: 50px">
            <div>
                <table class="table">
                    <caption style="font-family: Helvetica,serif">LATEST ENTRY </caption>
                    <thead>
                    <tr>
                        <th scope="row">ID</th>
                        <td>NAME</td>
                        <td>DATE</td>
                    </tr>
                    </thead>
                    <tbody>
        <?php
		$quel = "SELECT * FROM `user_log` ORDER BY `DATE` DESC LIMIT 2";
			$d_query = mysqli_query($conn,$quel);
			
			while ($row = mysqli_fetch_array($d_query,MYSQLI_ASSOC)){
		?>
                    <tr>
                        <th scope="row"><?php echo $row['ID'];?></th>
                        <td><?php echo $row['USER_ID'];?></td>
                        <td><?php echo $row['DATE'];?></td>
                    </tr>
					<?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="table">
            <table
                    id="table"
                    data-toggle="table"
                    data-height="auto"
                    data-show-columns-toggle-all="true"
                    data-show-fullscreen="true"
                    data-buttons-class="primary">
                <thead>
                <tr>
                    <th data-field="name">Asset Name</th>
                    <th data-field="column1">Asset Location</th>
                    <th data-field="column2">Status</th>
                    <th data-field="price">Latest Update</th>
                    <th data-field="column3">Asset Owner</th>
                    <th data-field="column4">Actions</th>
                </tr>
                </thead>
                <tbody>
				<?php
				$quel = "SELECT * FROM `asset_list` ORDER BY `DATE_LISTED` DESC";
					$d_q = mysqli_query($conn,$quel);
					
					while ($rows = mysqli_fetch_array($d_q,MYSQLI_ASSOC)){
				
				
				?>
                <tr>
                    <th scope="row"><?php echo $rows['ASSET_NAME'];?></th>
                    <td><?php echo $rows['ASSET_LOCATION'];?></td>
                    <td><?php echo $rows['STATUS'];?></td>
                    <td><?php echo $rows['DATE_LISTED'];?></td>
                    <td><?php echo $rows['ASSET_OWNER'];?></td>
                    <td>
                        <div class="row">
                            <div class="col-6">
                                <a href="new.php?edit=<?php echo $rows['ASSET_ID'];?>">
                                  <i class="far fa-edit text-center" style="color:#0275d8"></i>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="report.php?edit=<?php echo $rows['ASSET_ID'];?>">
                                    <i  class="far fa-eye align-items-center text-center" style="color: #d9534f"></i>
                                </a>
                            </div>
                        </div>
                    </td>

                </tr>
                
				<?php
					}
				?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.1/dist/bootstrap-table.min.js"></script>
</body>
</html>