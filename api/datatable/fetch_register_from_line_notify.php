<?php
  require('../../utils/db_connector.php');

  $pea_code = $_GET['pea_code'];

  $fetch_list_user = "
    SELECT 'ต้องเพิ่มฟิลด์ใน table ชื่อ targetType' AS notifyType
          , 'ต้องเพิ่มฟิลด์ใน table ชื่อ name' AS receviedName
          , CONCAT(LEFT(access_token, 20), '...') AS access_token
    FROM notify_officers
    WHERE pea_code = '$pea_code';
  ";

  $fetch_list_user_query = $conn->query($fetch_list_user);
  $users_obj = $fetch_list_user_query->fetch_all(MYSQLI_ASSOC);
  echo json_encode($users_obj, JSON_UNESCAPED_UNICODE);