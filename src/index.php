<?php

include_once 'bootstrap.php';

$database = new Database();
$database->connect();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('inc/header.php'); ?>
</head>

<body class="">
    <?php include_once('inc/body.php'); ?>
    <?php include_once('inc/footer.php'); ?>
</body>
</html>

<link href="css/style.css" rel="stylesheet">