<?php
session_start();

$_SESSION['log'] = 1;
header('location:../report.php');
