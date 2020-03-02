<?php
  date_default_timezone_set("Asia/Bangkok");
  require('../utils/db_connector.php');

  $caInput = $_POST['caInput'];
  $remove_zero_prefix_ca = substr($caInput, 1);

  $uIdInput = $_POST['uIdInput'];
  $nameInput = $_POST['nameInput'];
  $telInput = $_POST['telInput'];
  $emailInput = $_POST['emailInput'];

  // create current timestamp
  $date = date();
  $current_timestamp = date_format($date,"Y-m-d H:i:s");

  $update_line = "
    UPDATE ca
    SET UserID = ?, FullName = ?, CA_TEL = ?, CA_EMAIL = ?, Register_Timestamp = ?
    WHERE CA = ?
  ";

  $stmt = $conn->prepare($update_line);
  $stmt->bind_param("ssssss", $uIdInput, $nameInput, $telInput, $emailInput, $current_timestamp, $remove_zero_prefix_ca);
  $stmt->execute();
  if($stmt->error) {
    http_response_code(503);
    exit(1);
  }

  http_response_code(200);
  exit(0);