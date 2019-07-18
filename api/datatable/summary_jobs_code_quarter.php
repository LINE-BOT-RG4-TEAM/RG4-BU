<?php
    session_start();
    require('../../utils/db_connector.php');

    // get current pea_code 
    $pea_code = $_SESSION['pea_code'];
    $pea_branch_criteria = "";
    if(substr($pea_code, 1, 5) == "00000"){
        $pea_district = substr($pea_code, 0, 1);
        $pea_branch_criteria = "ca.PEA_CODE like '{$pea_district}%'";
    } else {
        $pea_branch_criteria = "ca.PEA_CODE = '$pea_code'";
    }

    ## get current year
    $current_year = date("Y");

    $fetch_jobs_quarter = "
        SELECT YEAR(DATE_ADD(`HISTORY`, INTERVAL 1 YEAR)) AS `year`
            , QUARTER(DATE_ADD(`HISTORY`, INTERVAL 1 YEAR)) AS `quarter`
            , COUNT(IF(`CODE` = 'S301', 1, NULL)) AS S301
            , COUNT(IF(`CODE` = 'S302', 1, NULL)) AS S302
            , COUNT(IF(`CODE` = 'S303', 1, NULL)) AS S303
            , COUNT(IF(`CODE` = 'S304', 1, NULL)) AS S304
            , COUNT(IF(`CODE` = 'S305', 1, NULL)) AS S305
        FROM `history`
        JOIN `ca` ON `history`.CA = `ca`.CA
        WHERE `history`.CODE in ('S301', 'S302', 'S303', 'S304', 'S305')
            AND $pea_branch_criteria
            AND YEAR(DATE_ADD(`HISTORY`, INTERVAL 1 YEAR)) >= '{$current_year}'
        GROUP BY 1, 2
        ORDER BY 1, 2;
    ";

    $jobs_code_quarter_results = $conn->query($fetch_jobs_quarter);
    $jobs_code_quarter_obj = $jobs_code_quarter_results->fetch_all(MYSQLI_ASSOC);
    echo json_encode($jobs_code_quarter_obj, JSON_UNESCAPED_UNICODE);
?>