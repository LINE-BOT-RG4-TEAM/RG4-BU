<?php
  require('./utils/db_connector.php');
  // echo json_encode($_POST, JSON_UNESCAPED_UNICODE);

  $update_line = "
    UPDATE ca
    SET UserID = ?, FullName = ?, CA_TEL = ?, CA_EMAIL = ?
    WHERE CA = ?
  ";

  $stmt = $conn->prepare($update_line);
  $stmt->bind_param("sssss", $_POST['uIdInput'], 
  $_POST['nameInput'], $_POST['telInput'], $_POST['emailInput'], $_POST['caInput']);
  $stmt->execute();
  if($stmt->error) {
    http_response_code(503);
    exit(1);
  }

  http_response_code(200);
  exit(0);