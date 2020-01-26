<?php
  session_start();
  define('LINE_GET_PROFILE_URI', 'https://api.line.me/v2/bot/profile/');
  require('../../utils/db_connector.php');

  // get current pea_code 
  $pea_code = $_SESSION['pea_code'];
  $pea_branch_criteria = "";
  if(substr($pea_code, 1, 5) == "00000"){
    $pea_district = substr($pea_code, 0, 1);
    $pea_branch_criteria = "ca.PEA_CODE like '{$pea_district}%'";
  }else{
    $pea_branch_criteria = "ca.PEA_CODE = '$pea_code'";
  }

  // get branch params
  $mode = $_GET['office_type'];

  $fetch_register_user = "
    SELECT ca.CA, FullName, CA_TEL, CA_EMAIL, bp.CUSTOMER_NAME, ca.UserID
    FROM heroku_3bd2ba953f29004.ca
      JOIN bp ON ca.BP = bp.BP
    WHERE LENGTH(ca.UserID) > 0 AND ca.PEA_CODE = '{$pea_code}';
  ";

  $fetch_register_user_query = $conn->query($fetch_register_user);
  $user_obj = $fetch_register_user_query->fetch_all(MYSQLI_ASSOC);
  // echo json_encode($user_obj, JSON_UNESCAPED_UNICODE);

  $new_user_list = array();
  foreach($user_obj as $user) {
      $userId = $user['UserID'];
      $profile_obj = getProfileByUserId($userId);
      $user["displayName"] = $profile_obj["displayName"];
      $user["pictureUrl"] = $profile_obj["pictureUrl"];
      $new_user_list[] = $user;
  }
  echo json_encode($new_user_list, JSON_UNESCAPED_UNICODE);

  function getProfileByUserId($userId){
  
      $headers = [
          'Authorization: Bearer ' . getenv("LINE_CHANNEL_ACCESS_TOKEN")
      ];

      try {
          $ch = curl_init();
      
          curl_setopt($ch, CURLOPT_URL, LINE_GET_PROFILE_URI.$userId);
          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      
          $res = curl_exec($ch);
          curl_close($ch);
      
          $json = json_decode($res, true);
          return $json;
      } catch (Exception $e) {
          http_response_code(404);
      }
  }