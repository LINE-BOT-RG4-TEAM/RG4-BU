<?php
  session_start();
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

  $fetch_automatic = "
    SELECT ca.CA
          ,bp.CUSTOMER_NAME
          ,ca.MAX_BILL
          ,ca.kVA_SIZE 
    FROM history
      RIGHT JOIN ca ON history.CA = ca.CA
      INNER JOIN bp ON ca.BP = bp.BP
    WHERE history.CA IS NULL 
          AND ca.KAMR IS NULL
          AND $pea_branch_criteria
    ORDER BY ca.MAX_BILL DESC,ca.kVA_SIZE DESC 
  ";

  $fetch_automatic_query = $conn->query($fetch_automatic);
  $ca_obj = $fetch_automatic_query->fetch_all(MYSQLI_ASSOC);
  echo json_encode($ca_obj, JSON_UNESCAPED_UNICODE);