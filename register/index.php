<?php session_start(); ?>
<link rel="stylesheet" href="../css/default.css" media="screen">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">

 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<script src="../js/boxit.js"></script>

<div class="navbar navbar-inverse">
  <div class="navbar-inner">
    <a class="brand">Habitat Volunteer Registration</a>
  </div>
</div>

<div style="padding-left: 10px;">
    <?php
            //sets all required files
            $act = (isset($_GET['act'])) ? $_GET['act'] : '';
            $msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';
            require_once('class/item.php');
            require_once('class/interest.php');
            require_once ('model/dbio_register.php');
            require_once('class/organization.php');
            $dbio= new DBIO();	
            include 'controller/register.php';
    ?>
</div>