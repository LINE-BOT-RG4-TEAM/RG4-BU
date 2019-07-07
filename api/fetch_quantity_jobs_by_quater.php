<?php
    session_start();
    require("../utils/db_connector.php");

    $year = $_POST["year"];

	// get current pea_code 
	$pea_code = $_SESSION['pea_code'];
	$pea_branch_criteria = "";
	if(substr($pea_code, 1, 5) == "00000"){
		$pea_district = substr($pea_code, 0, 1);
		$pea_branch_criteria = "ca.PEA_CODE like '{$pea_district}%'";
	}else{
		$pea_branch_criteria = "ca.PEA_CODE = '$pea_code'";
	}

    $fetch_quantity_by_quater = "
        SELECT YEAR(DATE_ADD(`HISTORY`, INTERVAL 1 YEAR)) AS `year`
            , QUARTER(DATE_ADD(`HISTORY`, INTERVAL 1 YEAR)) AS `quarter`
            , COUNT(*) AS `quantity_jobs`
        FROM `history`
            JOIN `ca` ON `history`.CA = `ca`.CA
        WHERE `CODE` IN ('S301', 'S302', 'S303', 'S304', 'S305')
                AND YEAR(DATE_ADD(`HISTORY`, INTERVAL 1 YEAR)) >= '{$year}'
                AND $pea_branch_criteria
        GROUP BY 1, 2
        ORDER BY 1, 2
    ";

    $jobs_by_quarter_month_results = $conn->query($fetch_quantity_by_quater);

    if($jobs_by_quarter_month_results->num_rows <= 0){
        echo json_encode(array());
        http_response_code(404);
        exit(1);
    }

    $all_jobs = $jobs_by_quarter_month_results->fetch_all(MYSQLI_ASSOC);
    echo json_encode($all_jobs, JSON_UNESCAPED_UNICODE);
    http_response_code(200);
    exit(0);