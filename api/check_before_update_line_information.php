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
    echo "ไม่มีผู้ใช้ไฟหมายเลข `{$caInput}` ในระบบค่ะ";
    http_response_code(404);
    exit(1);
  }

  // เช็คว่าหมายเลข CA มีการลงทะเบียนแล้วหรือยัง
  $check_existing_register = "
    SELECT CA, UserID
    FROM `ca`
    WHERE CA = '{$remove_zero_prefix_ca}'
          AND UserID IS NOT NULL
  ";
  $existing_register_results = $conn->query($check_existing_register);
  if($existing_register_results->num_rows > 0){
    echo "หมายเลขผู้ใช้ไฟหมายเลข `{$caInput}` มีผู้ลงทะเบียนเรียบร้อยแล้ว<br/> ท่านต้องการแทนที่ผู้ใช้คนดังกล่าวหรือไม่";
    http_response_code(409);
    exit(1);
  }

  http_response_code(200);
  exit(0);
