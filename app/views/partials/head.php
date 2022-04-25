<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="AndreZ ToolBox. Stories, songs, apps...">
    <meta name="author" content="Andrea Zaccara">

    <title><?= isset($page) ? $page : "Home" ?> | Toolbox</title>

    <link rel="icon" type="image/x-icon" href="favicon.ico">

    <link rel="stylesheet" href="/<?= BASE_PATH ?>public/css/bootstrap.min.css">
    <link rel="stylesheet" href="/<?= BASE_PATH ?>public/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="/<?= BASE_PATH ?>public/css/style.css">
    <link rel="stylesheet" href="/<?= BASE_PATH ?>public/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="/<?= BASE_PATH ?>public/css/dataTables.bootstrap4.min.css">

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <script src="/<?= BASE_PATH ?>public/js/jquery-3.4.1.min.js"></script>
        <script src="/<?= BASE_PATH ?>public/js/bootstrap.bundle.min.js"></script>
        <script src="/<?= BASE_PATH ?>public/js/jquery.easing.min.js"></script>
        <script src="/<?= BASE_PATH ?>public/js/jquery.dataTables.min.js"></script>
        <script src="/<?= BASE_PATH ?>public/js/dataTables.bootstrap4.min.js"></script>

        <?php require('nav.php'); ?>