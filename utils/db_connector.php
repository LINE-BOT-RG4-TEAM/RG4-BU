<?php

  ini_set('display_errors', 1);
	error_reporting(~0);

  $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

  $server = $url["host"];
  $username = $url["user"];
  $password = $url["pass"];
  $db = substr($url["path"], 1);

  /*$server = 'us-cdbr-iron-east-03.cleardb.net';
  $username = 'b1e0f1bc1c0da3';
  $password = 'e615ba2a';
  $db = 'heroku_bb297299e03d2d3';*/

  $conn = new mysqli($server, $username, $password, $db);

	// $conn = mysqli_connect($serverName, $userName, $userPassword, $dbName, $db_port) or die('Unable to establish a CRM_BU connection');
  $conn->set_charset("utf8");
