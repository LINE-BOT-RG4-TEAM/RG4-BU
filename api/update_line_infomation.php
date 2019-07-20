<?php
  require('../utils/db_connector.php');

  // fetch available userid in our database
  $caInput = $_POST['caInput'];
  $remove_zero_prefix_ca = substr($caInput, 1);
  $check_ca = "
    SELECT CA
    FROM `ca`
    WHERE CA = '{$remove_zero_prefix_ca}'
  ";
  $check_results = $conn->query($check_ca);
  if($check_results->num_rows == 0) {
    http_response_code(404);
    exit(1);
  }

  $update_line = "
    UPDATE ca
    SET UserID = ?, FullName = ?, CA_TEL = ?, CA_EMAIL = ?
    WHERE CA = ?
  ";

  $stmt = $conn->prepare($update_line);
  $stmt->bind_param("sssss", $_POST['uIdInput'], 
  $_POST['nameInput'], $_POST['telInput'], $_POST['emailInput'], $remove_zero_prefix_ca);
  $stmt->execute();
  if($stmt->error) {
    http_response_code(503);
    exit(1);
  }

  http_response_code(200);
  exit(0);