<?php
session_start();

if(isset($_SESSION['log']) != 1 ){
  header('location:index.php');
}

$serverName = "localhost";
$userName = "root";
$userPassword = "";
$dbName = "inventory";

$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);




ini_set('display_errors', 1);
error_reporting(~0);

$strKeyword = null;

if(isset($_POST["txtKeyword"]))
{
    $strKeyword = $_POST["txtKeyword"];
}
if(isset($_GET["txtKeyword"]))
{
    $strKeyword = $_GET["txtKeyword"];
}


if(isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $sql = "SELECT * FROM `asset_list` WHERE ASSET_ID = '$id'";
    $query = mysqli_query($conn,$sql) or die("Error: ".mysqli_error($conn));


}elseif(isset($_POST['searchSubmit'])){
    $sql = "SELECT * FROM `asset_list` WHERE CONCAT('STATUS','ASSET_NAME','ASSET_TYPE','BRAND','ASSET_AGE','SERIAL_NUMBER','EMBORSEMENT_CODE','ASSET_LOCATION') LIKE '%".$strKeyword."%'";
    $query = mysqli_query($conn,$sql) or die("Error: ".mysqli_error($conn));
}
if(isset($_POST["submit1"])){ // && !empty($_POST["id"])
    $sid = $_POST["id"];
    $name = $_POST['assetName2'];
    $type = $_POST['customSelect'];
    $year = $_POST['purchaseYear2'];
    $date = $_POST['currentDate2'];
    $status = $_POST['customSelect1'];
    $serial = $_POST['serialNumber2'];
    $owner = $_POST['assetOwner2'];
    $emborsement = $_POST['emborsement2'];
    $location = $_POST['assetLocation2'];
    $geolocation = $_POST['assetGeo2'];


    $ql = "UPDATE `asset_list` SET ASSET_NAME='$name', ASSET_TYPE='$type', ASSET_TYPE='$year', 
				DATE_LISTED='$date', STATUS='$status', SERIAL_NUMBER='$serial', ASSET_OWNER='$owner', 
				EMBORSEMENT_CODE='$emborsement', ASSET_LOCATION='$location', ASSET_GEO_LOCATION='$geolocation' WHERE ASSET_ID='$sid'";


    if(mysqli_query($conn,$ql)){
        echo '<script> alert("Record updated successfully!");</script>';
        header('location: dashboard.php');
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GSAIMS | Entry</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/new.css">
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
                    <a class="nav-link" href="index.php"><i id="fa-sign-out-alt" class="fas fa-sign-out-alt fa-lg fa-fw"></i></a>
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
                            <i class="far fa-keyboard" style="color: #330077"></i>
                            </i>
                        </div>
                        <div style="letter-spacing: 2px">Inventory Entry
                            <div class="page-title-subheading">Choose between the new and the update entry tabs
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
            <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav mb-4">
            <li class="nav-item">
                <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">
                    <span>New Entry</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1">
                    <span>Update Entry</span>
                </a>
            </li>
        </ul>
            <div class="tab-content">
                <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                    <div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title">New Entry Fields</h5>
                            <form action="php/newEntry.php" method="post">
                                <div class="form">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="assetName">Asset Name</label>
                                            <input type="text" class="form-control" id="assetName" name="assetName" placeholder="e.g. GSAIT-LT003-G11">
                                        </div>
                                        <div class="col-6">
                                            <label for="assetType">Asset Brand and Type</label>
                                            <div class="input-group">
                                                <input id="assetBrand" name="assetBrand" type="text" class="form-control" placeholder="e.g. Dell Inspiron">
                                                <div class="input-group-append">
                                                    <select type="select" id="exampleCustomSelect" name="assetType" class="custom-select" style="background-color:#3f6ad8; color: #f8f8f8" >
                                                        <option value="">Asset Type</option>
                                                        <option>Hardware Component</option>
                                                        <option>Networking Tools and Equipment</option>
                                                        <option>Internet Related Components</option>
                                                        <div ></div>
                                                        <option>General Tools and Equipment</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form mt-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="purchaseYear">Purchase Year</label>
                                            <input type="date" class="form-control" id="purchasedYear" name="purchasedYear" placeholder="2005-06-25">
                                        </div>
                                        <div class="col-6">
                                            <label for="currentDate">Current Date</label>
                                            <input type="date" class="form-control" id="currentDate" name="currentDate" value="1980-08-26" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form mt-3">
                                    <div class="row">
                                        <div class="col-7">
                                            <label for="status">Asset Status</label>
                                            <select type="select" id="status" name="assetStatus" class="custom-select">
                                                <option value="">Choose Status</option>
                                                <option>New</option>
                                                <option>To be installed</option>
                                                <option>To be repaired</option>
                                                <option>Out of stock</option>
                                                <option>Reserved</option>
                                            </select>
                                        </div>
                                        <div class="col-5">
                                            <label for="serialNumber">Serial Number</label>
                                            <input type="text" class="form-control" id="serialNumber" name="serialNumber" placeholder="e.g. G6TYF47DKPHD">
                                        </div>
                                    </div>
                                </div>
                                <div class="form mt-3">
                                    <div class="row">
                                        <div class="col-7">
                                            <label for="assetOwner">Asset Owner</label>
                                            <input type="text" class="form-control" id="assetOwner" name="assetOwner" placeholder="Harriet Adjei-Owusu">
                                        </div>
                                        <div class="col-5">
                                            <label for="emborsement">Emborsement</label>
                                            <input type="text" class="form-control" id="emborsement" name="emborsement" placeholder="e.g. GSA/IT/COE2938">
                                        </div>

                                    </div>
                                </div>
                                <div class="form mt-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <label for="assetLocation">Asset Location</label>
                                            <input type="text" class="form-control" id="assetLocation" name="assetLocation" placeholder="e.g. S16 Admin Block, Head Office">
                                        </div>
                                        <div class="col-4">
                                            <label for="assetGeo">Asset Geolocation</label>
                                            <input type="text" class="form-control" id="assetGeo" name="assetGeo" placeholder="e.g. Shiashie, Accra, Greater Accra">
                                        </div>

                                    </div>
                                </div>


                            <div class="mt-5 text-center">
                                <a href="new.php">
                                    <button type="button" aria-expanded="false" class="btn-shadow btn btn-primary">
                                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                                <i class="fa fa-sync-alt fa-w-20"></i></span>
                                        Reset Entry
                                    </button>
                                </a>


                                    <button type="submit" aria-expanded="false" class="btn-shadow btn btn-primary">
                                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                                <i class="fa fa-save fa-w-20"></i></span>
                                        Save Entry
                                    </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--BEGIN FROM THIS SIDE-->
                <div class="tab-pane tabs-animation" id="tab-content-1" role="tabpanel">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <h5 class="card-title">Update Entry Fields</h5>
                                </div>
                                <div class="col-6">
                                    <form class="search-wrapper" style="float: right">
                                        <div class="input-holder" role="search" action="<?=$_SERVER['SCRIPT_NAME'];?>" method="post">
                                                <input type="search" class="search-input" placeholder="Type to search" name='txtKeyword'>
                                                <button class="search-icon" name="searchSubmit" type="submit"><span></span></button>
                                        </div>
                                        <button class="close"></button>
                                    </div>
                                </div>
                            </div>
                            <form method='post' action='new.php'>
                                <?php

                                while ($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){

                                ?>
                                <div class="form">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="assetName2">Asset Name</label>
                                            <input type="text" class="form-control" name="assetName2" id="assetName2" value="<?php echo $row['ASSET_NAME'];?>">
                                        </div>
                                        <div class="col-6">
                                            <label for="assetType2">Asset Brand and Type</label>
                                            <div class="input-group">
                                                <input id="assetType2" type="text" class="form-control" placeholder="Dell Inspiron" value="<?php echo $row['BRAND']?>">
                                                <div class="input-group-append">
                                                    <select type="select" id="exampleCustomSelect1" name="customSelect" class="custom-select" style="background-color:#3f6ad8; color: #f8f8f8" >
                                                        <option value=""><?php echo $row['ASSET_TYPE'];?></option>
                                                        <option value="Asset Type">Asset Type</option>
                                                        <option value="Hardware Component">Hardware Component</option>
                                                        <option value="Networking Tools and Equipment">Networking Tools and Equipment</option>
                                                        <option value="Internet Related Components">Internet Related Components</option>
                                                        <option value="General Tools and Equipment">General Tools and Equipment</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form mt-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="purchaseYear2">Purchase Year</label>
                                            <input type="text" class="form-control" id="purchaseYear2" name="purchaseYear2" value="<?php echo $row['PURCHASE_YEAR'];?>">
                                        </div>
                                        <div class="col-6">
                                            <label for="currentDate2">Current Date</label>
                                            <input type="date" class="form-control" id="currentDate2" name="currentDate2" value="<?php echo $row['DATE_LISTED'];?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form mt-3">
                                    <div class="row">
                                        <div class="col-7">
                                            <label for="status">Asset Status</label>
                                            <select type="select" id="status1" name="customSelect1" class="custom-select">
                                                <option value=""><?php echo $row['STATUS'];?></option>
                                                <option value="New">New</option>
                                                <option value="To be installed">To be installed</option>
                                                <option value="To be repaired">To be repaired</option>
                                                <option value="Out of stock">Out of stock</option>
                                                <option value="Reserved">Reserved</option>
                                            </select>
                                        </div>
                                        <div class="col-5">
                                            <label for="serialNumber2">Serial Number</label>
                                            <input type="text" class="form-control" id="serialNumber2" name="serialNumber2" value="<?php echo $row['SERIAL_NUMBER'];?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form mt-3">
                                    <div class="row">
                                        <div class="col-7">
                                            <label for="assetOwner2">Asset Owner</label>
                                            <input type="text" class="form-control" id="assetOwner2" name="assetOwner2" value="<?php echo $row['ASSET_OWNER'];?>">
                                        </div>
                                        <div class="col-5">
                                            <label for="emborsement2">Emborsement</label>
                                            <input type="text" class="form-control" id="emborsement2" name="emborsement2" value="<?php echo $row['EMBORSEMENT_CODE'];?>">
                                        </div>

                                    </div>
                                </div>
                                <div class="form mt-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <label for="assetLocation2">Asset Location</label>
                                            <input type="text" class="form-control" id="assetLocation2" name="assetLocation2" value="<?php echo $row['ASSET_LOCATION'];?>">
                                        </div>
                                        <div class="col-4">
                                            <label for="assetGeo2">Asset Geolocation</label>
                                            <input type="text" class="form-control" id="assetGeo2" name="assetGeo2" value="<?php echo $row['ASSET_GEO_LOCATION'];?>">
                                        </div>

                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                                <?php
                                }
                                ?>
                                <div class="mt-5 text-center">
                                    <a href="new.php">
                                        <button type="button" aria-expanded="false" class="btn-shadow btn btn-primary">
                                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                                <i class="fa fa-sync-alt fa-w-20"></i></span>
                                            Reset Entry To Original
                                        </button>
                                    </a>


                                    <button type="submit" aria-expanded="false" class="btn-shadow btn btn-primary" name='submit1'>
                                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                                <i class="fa fa-save fa-w-20"></i></span>
                                        Update Entry
                                    </button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</section>

<script>
    let currentDate2 = new Date().toISOString().substr(0, 10);
    document.querySelector("#currentDate2").value = currentDate2;
</script>
<script>
    let currentDate = new Date().toISOString().substr(0, 10);
    document.querySelector("#currentDate").value = currentDate;
</script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
</body>
</html>