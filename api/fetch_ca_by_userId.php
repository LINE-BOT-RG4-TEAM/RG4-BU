

<?php
  require('../utils/db_connector.php');

  $userId = $_GET['userId'];

  $fetch_ca_by_user_id = "
    SELECT CA, FullName, CA_TEL, CA_EMAIL
    FROM ca
    WHERE UserID = '{$userId}'
  ";

  $ca_result = $conn->query($fetch_ca_by_user_id);
  $row_ca = $ca_result->fetch_assoc();

  echo json_encode($row_ca, JSON_UNESCAPED_UNICODE);