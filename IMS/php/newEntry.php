<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $assetNameInput = $_POST['assetName'];
    $assetBrandInput = $_POST['assetBrand'];
    $assetTypeInput = $_POST['assetType'];
    $purchasedYearInput = $_POST['purchasedYear'];
    $currentDateInput = $_POST['currentDate'];
    $assetStatusInput = $_POST['assetStatus'];
    $serialNumberInput = $_POST['serialNumber'];
    $assetOwnerInput = $_POST['assetOwner'];
    $emborsementInput = $_POST['emborsement'];
    $assetLocationInput = $_POST['assetLocation'];
    $assetGeoInput = $_POST['assetGeo'];


    $con = mysqli_connect("localhost", "root", "", "inventory");//mysqli("localhost","username of database","password of database","database name") establishing a connection
    $sql = "INSERT INTO asset_list (ASSET_NAME,BRAND,ASSET_TYPE,PURCHASE_YEAR,DATE_LISTED,STATUS,SERIAL_NUMBER,ASSET_OWNER,EMBORSEMENT_CODE,ASSET_LOCATION,ASSET_GEO_LOCATION) VALUES ('$assetNameInput','$assetBrandInput','$assetTypeInput','$purchasedYearInput','$currentDateInput','$assetStatusInput','$serialNumberInput','$assetOwnerInput','$emborsementInput','$assetLocationInput','$assetGeoInput')";


    if ($con->query($sql) === TRUE) {
        echo '<script> alert("New Record Added successfully!");</script>';
        header('location:../dashboard.php');
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}
?>

