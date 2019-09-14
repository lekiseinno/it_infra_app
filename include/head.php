<!DOCTYPE>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Data Approved</title>
	
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    
    <!-- Custom styles for this template-->
  	<link href="asset/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="asset/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- select2 -->
    <link href="asset/css/select2.min.css" rel="stylesheet">

	<!-- script $post -->
    <script src="asset/js/jquery-3.1.1.min.js"></script>
<style type="text/css">
	.gray-bg{
    	background-color: #f3f3f4;
    	min-height: 100vh;
	}
</style>
<?php 
    session_start();
    if(@$_SESSION['username'] == ""){?>
        <script>    
        window.location="login.html";
        </script>
    <?exit();}?>
</head>