<?php
  require('../utils/db_connector.php');
  $userId = $_GET['userId'];

  $fetch_status = "
    SELECT UserID
    FROM ca
    WHERE UserID = ?
  ";

  $stmt = $conn->prepare($fetch_status);
  $stmt->bind_param("s", $userId);
  $stmt->execute();
  $stmt->store_result();
  if($stmt->error) {
    // http_response_code(503);
    echo json_encode(['status'=>'503']);
    exit(1);
  }

  if($stmt->num_rows > 0) {
    // http_response_code(200);
    echo json_encode(['status'=>'200']);
    exit(0);
  } else {
    // http_response_code(404);
    echo json_encode(['status'=>'404']);
    exit(1);
  }