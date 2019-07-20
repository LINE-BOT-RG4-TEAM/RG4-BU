<?php
  require('../utils/db_connector.php');

  $caInput = $_POST['caInput'];
  $remove_zero_prefix_ca = substr($caInput, 1);

  $uIdInput = $_POST['uIdInput'];
  $nameInput = $_POST['nameInput'];
  $telInput = $_POST['telInput'];
  $emailInput = $_POST['emailInput'];

  $update_line = "
    UPDATE ca
    SET UserID = ?, FullName = ?, CA_TEL = ?, CA_EMAIL = ?
    WHERE CA = ?
  ";

  $stmt = $conn->prepare($update_line);
  $stmt->bind_param("sssss", $uIdInput, $nameInput, $telInput, $emailInput, $remove_zero_prefix_ca);
  $stmt->execute();
  if($stmt->error) {
    http_response_code(503);
    exit(1);
  }

  http_response_code(200);
  exit(0);