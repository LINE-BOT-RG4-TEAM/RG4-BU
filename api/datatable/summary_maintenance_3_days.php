<?php
    session_start();
    date_default_timezone_set("Asia/Bangkok");
    require('../../utils/db_connector.php');

    // get current date
    $today = date("Y-m-d");

    // get current pea_code 
    $pea_code = $_SESSION['pea_code'];
    $pea_branch_criteria = "";
    if(substr($pea_code, -5) == "00000"){
        $pea_district = substr($pea_code, 0, 1);
        $pea_branch_criteria = "PEA_CODE like '{$pea_district}%'";
    } else {
        $pea_branch_criteria = "PEA_CODE = '$pea_code'";
    }
    
    // WHEN DATE_ADD(history.`HISTORY`, INTERVAL 1 YEAR) = DATE('{$today}') - INTERVAL 1 DAY THEN CONCAT('เมื่อวาน ','(', DATE('{$today}') - INTERVAL 1 DAY,')')
    // WHEN DATE_ADD(history.`HISTORY`, INTERVAL 1 YEAR) = DATE('{$today}') THEN CONCAT('วันนี้ ','(', DATE('{$today}'),')')
    // WHEN DATE_ADD(history.`HISTORY`, INTERVAL 1 YEAR) = DATE('{$today}') + INTERVAL 1 DAY THEN CONCAT('พรุ่งนี้ ','(', DATE('{$today}') + INTERVAL 1 DAY,')') ELSE '' END AS 'str_date'
    $fetch_summary_jobs = "
        SELECT 
            DATE_ADD(history.`HISTORY`, INTERVAL 1 YEAR) AS 'str_date'
            , COUNT(*) AS 'count'
        FROM heroku_3bd2ba953f29004.history 
        WHERE DATE_ADD(history.`HISTORY`, INTERVAL 1 YEAR) BETWEEN DATE('{$today}') - INTERVAL 1 DAY AND DATE('{$today}') + INTERVAL 1 DAY
                AND CODE IN ('S301', 'S302', 'S303', 'S304', 'S305')
                AND {$pea_branch_criteria}
        GROUP BY 1
        ORDER BY 1
    ";

    $summary_job_3_day_results = $conn->query($fetch_summary_jobs);
    $summary_job_3_day_obj = $summary_job_3_day_results->fetch_all(MYSQLI_ASSOC);
    echo json_encode($summary_job_3_day_obj, JSON_UNESCAPED_UNICODE);