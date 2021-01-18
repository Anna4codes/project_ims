<?php
session_start();
if($_SESSION['log'] != 1){
    header('location:index.php');
} //else{
  //  session_unset();
//}
require 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GSAIMS | Report</title>
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
<section style="margin-top: 5%">
    <div class="app-main">
        <div class="app-main__outer">
            <div class="app-main__inner container-lg">
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div class="page-title-icon">
                                <i class="far fa-folder-open" style="color: #330077"></i>
                                </i>
                            </div>
                            <div style="letter-spacing: 2px">Reporting
                                <div class="page-title-subheading">Search to get an asset's report
                                </div>
                            </div>
                        </div>
                        <div class="page-title-actions">
                            <div class="d-inline-block dropdown">
                                <a href="dashboard.php">
                                    <button type="button" aria-expanded="false" class="btn-shadow btn btn-primary">
                                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                                <i class="fa fa-times fa-w-20"></i></span>
                                        Exit Page
                                    </button>
                                </a>
                            </div>
                        </div>    </div>
                </div>
				<?php
                $strKeyword = null;

				if(isset($_GET['edit'])) {
					$id = $_GET['edit'];
										
					$sql = "SELECT * FROM `asset_list` WHERE ASSET_ID = '$id'";
					$query = mysqli_query($conn,$sql) or die("Error: ".mysqli_error($conn));
					
					
				}else{
					$sql = "SELECT * FROM `asset_list` WHERE CONCAT('STATUS','ASSET_NAME','ASSET_TYPE','BRAND','ASSET_AGE','SERIAL_NUMBER','EMBORSEMENT_CODE','ASSET_LOCATION') LIKE '%".$strKeyword."%'";
					$query = mysqli_query($conn,$sql) or die("Error: ".mysqli_error($conn));
				}
				?>
                <div class="container">
                    <table
                            id="table"
                            data-toggle="table"
                            data-search="true"
                            data-search-highlight="true"
                            data-url="#">
                        <thead>
                        <tr>
                            <th data-field="Asset name">Status</th>
                            <th data-field="name">Asset Name</th>
                            <th data-field="price">Asset Type</th>
							<th data-field="name">Brand</th>
                            <th data-field="price">Asset Age</th>
                            <th data-field="name">Serial Number</th>
                            <th data-field="price">Emborsement</th>
                            <th data-field="price">Asset Location</th>
                        </tr>
                        </thead>
						<tbody>
						<?php
							
							while ($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
							
						?>
						
						<tr>
							<th scope="row"><?php echo $row['STATUS'];?></th>
							<td><?php echo $row['ASSET_NAME'];?></td>
							<td><?php echo $row['ASSET_TYPE'];?></td>
							<td><?php echo $row['BRAND'];?></td>
							<td><?php echo $row['ASSET_AGE'];?></td>
							<td><?php echo $row['SERIAL_NUMBER'];?></td>
							<td><?php echo $row['EMBORSEMENT_CODE'];?></td>
							<td><?php echo $row['ASSET_LOCATION'];?></td>
							

						</tr>
						
						<?php
							}
						?>
						</tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    </div>
</section>

<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.1/dist/bootstrap-table.min.js"></script>
</body>
</html>