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
          SELECT bp.CUSTOMER_NAME
                ,ca.CA AS Ca1
                ,history.CA AS Ca2
                ,ca.HML_Type
                ,ca.KAM_TYPE
                ,ca.KAMR
                ,COUNT(history.CA) AS num 
          FROM ca
                LEFT JOIN history ON history.CA = ca.CA
                INNER JOIN bp ON ca.BP = bp.BP 
          WHERE KAMR IS NOT NULL
                AND $pea_branch_criteria
          GROUP BY ca.CA
          ORDER BY CASE 
                        WHEN ca.KAM_TYPE='strategic' THEN 1 
                        WHEN ca.KAM_TYPE = 'star' THEN 2 
                        WHEN ca.KAM_TYPE = 'status' THEN 3 
                        WHEN ca.KAM_TYPE = 'streamline' THEN 4 
                END ,
                num DESC ,
                ca.MAX_BILL DESC ,
                ca.kVA_SIZE DESC 
        ";

        $fetch_automatic_query = $conn->query($fetch_automatic);
        $ca_obj = $fetch_automatic_query->fetch_all(MYSQLI_ASSOC);
        echo json_encode($ca_obj, JSON_UNESCAPED_UNICODE);