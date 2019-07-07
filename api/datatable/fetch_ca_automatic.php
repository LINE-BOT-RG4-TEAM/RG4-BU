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
          ,ca.BP
          ,bp.CUSTOMER_NAME AS 'BP_NAME'
          ,ca.ADDRESS AS 'CA_ADDRESS'
          ,kW_PK
          ,MAX_BILL
          ,AVG_BILL
          ,kVA_SIZE
          ,COUNT(history.CA) AS 'QUANTITY_PURCHASE'
    FROM ca 
      JOIN bp ON ca.bp = bp.BP
      LEFT JOIN history ON ca.CA = history.CA
    WHERE $pea_branch_criteria
    GROUP BY ca.CA
            ,ca.BP
            ,bp.CUSTOMER_NAME
            ,ca.ADDRESS
            ,kW_PK
            ,MAX_BILL
            ,AVG_BILL
            ,kVA_SIZE
    ORDER BY COUNT(history.CA) DESC
  ";

  $fetch_automatic_query = $conn->query($fetch_automatic);
  $ca_obj = $fetch_automatic_query->fetch_all(MYSQLI_ASSOC);
  echo json_encode($ca_obj, JSON_UNESCAPED_UNICODE);