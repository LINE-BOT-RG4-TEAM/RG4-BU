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
            ,COUNT(history.CA) AS num
            ,ca.kVA_SIZE,ROUND(sum(history.PAYMENT),2) AS paid
            ,ca.MAX_BILL
            ,MAX(history.HISTORY) AS last
      FROM ca
            INNER JOIN bp ON ca.BP = bp.BP
            INNER JOIN history ON history.CA = ca.CA
      WHERE ca.KAMR IS NULL
            AND $pea_branch_criteria
      GROUP BY history.CA
      ORDER BY ca.MAX_BILL DESC,ca.kVA_SIZE DESC,num DESC
  ";

  $fetch_automatic_query = $conn->query($fetch_automatic);
  $ca_obj = $fetch_automatic_query->fetch_all(MYSQLI_ASSOC);
  echo json_encode($ca_obj, JSON_UNESCAPED_UNICODE);