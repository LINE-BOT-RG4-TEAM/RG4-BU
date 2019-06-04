<?php
  require('../../utils/db_connector.php');

  $pea_code = $_GET['pea_code'];

  $fetch_list_user = "
    SELECT CASE 
            WHEN target_type = 'USER' THEN 'ผู้ใช้'
            WHEN target_type = 'GROUP' THEN 'กลุ่ม'
            ELSE 'OTHERS' END AS target_type
          , target_name
          , access_token
    FROM notify_officers
    WHERE pea_code = '$pea_code';
  ";

  $fetch_list_user_query = $conn->query($fetch_list_user);
  $users_obj = $fetch_list_user_query->fetch_all(MYSQLI_ASSOC);
  echo json_encode($users_obj, JSON_UNESCAPED_UNICODE);