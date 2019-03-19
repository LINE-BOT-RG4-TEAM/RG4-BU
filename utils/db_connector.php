<?php

  ini_set('display_errors', 1);
	error_reporting(~0);

  $serverName = "172.30.130.167";
  $userName = "dev";
  $userPassword = "dev";
  $dbName = "crm_bu";
  $db_port = '3306';

	$conn = mysqli_connect($serverName, $userName, $userPassword, $dbName, $db_port) or die('Unable to establish a CRM_BU connection');
  $conn->set_charset("utf8");
