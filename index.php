<?php session_start(); ?>
<?php require('./utils/array_utils.php'); ?>
<?php require('./utils/db_connector.php'); ?>
<?php 
  // check user session
  if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header("Location: login.php");
  }
  
  // check timeout session
  $login_session_duration = 60 * 10;
  $current_time = time();
  $loggedint_time = $_SESSION["loggedin_time"];
  if($current_time - $loggedint_time > $login_session_duration){
    header("Location: logout.php");
    exit(0);
  }

  // check 'action' from get params
  if(!array_key_exists("action", $_GET)){
    header("Location: index.php?action=home");
    exit(0);
  }

  // update time session
  $_SESSION["loggedin_time"] = time();

  // get action value from action key in $_GET
  $action = $_GET['action'];
?>
<?php require('./partials/header.php'); ?>
<?php 
  // filter only php extension
  $filter_file_name = array_filter(scandir("./"), "filter_php_file");

  $page_php_path = "{$action}.php";
  if(in_array($page_php_path, $filter_file_name, true))
    include($page_php_path);
  else
    include("404.php");
  
  // include essentails scripts 
  require("./partials/scripts.php");

  // include script control withit page
  $page_script_path = "scripts/{$action}.js";
  if(file_exists($page_script_path)){
    echo "<script>";
    include($page_script_path);
    echo "</script>";
  }
  
?>
<?php require("./partials/footer.php"); ?>