<?php
    set_time_limit(0);
    date_default_timezone_set("Asia/Bangkok");
    require("/app/utils/db_connector.php");
    require("/app/api/notify/notify_func.php");
    require("/app/utils/date_utils.php");

    // check holiday
    $todaytime = strtotime('today');
    $todaydate = date('Y-m-d', $todaytime);
    $fetch_holiday = "SELECT * FROM holiday WHERE status = 'A' AND holiday_date = '$todaydate'";
    $holiday_list = mysqli_query($conn, $fetch_holiday);

    if(isWeekend($todaydate) || mysqli_num_rows($holiday_list) > 0){
        return;
    }

    $today = date("Y-m-d");
    // fetch history for duedate maintenance before 3 month for officer
    $fetch_duedate_bf_3_month = "
        SELECT PEA_CODE, COUNT(*) AS 'count_job'
        FROM history
        WHERE DATE_ADD(`HISTORY`, INTERVAL 9 MONTH) = '{$today}'
            AND CODE IN ('S301', 'S302', 'S303', 'S304', 'S305')
        GROUP BY 1
    ";
    $bf_3_month_result = mysqli_query($conn, $fetch_duedate_bf_3_month);
    if($bf_3_month_result->num_rows == 0){
        return;
    }

    while($row = $bf_3_month_result->fetch_assoc()){
        $pea_code = $row['pea_code'];
        $count_job = $row['count_job'];
        $fetch_officer_by_pea_code = "
            SELECT officers.pea_code, office.pea_name, target_name, access_token
            FROM notify_officers officers
                    JOIN office ON officers.pea_code = office.pea_code
            WHERE officers.pea_code = '{$pea_code}'
                    AND `status` = 'A'
        ";
        $officers_result = mysqli_query($conn, $fetch_officer_by_pea_code);
        if($officers_result->num_rows == 0) 
            continue;
        
        $desc_date = dateThai(date("Y-m-d"));
        while($officer = $officers_result->fetch_assoc()){
            $pea_name = $officer["pea_name"];
            $access_token = $officer["access_token"];
            $message = "
                \nแจ้งเตือนงานบำรุงรักษาล่วงหน้า 3 เดือน ประจำวันที่ {$desc_date} ของ {$pea_name} จำนวน {$count_job} งาน\n\n
                กรุณาตรวจสอบรายละเอียดของงานตามลิงก์ https://pea-crm.herokuapp.com ด้วยชื่อผู้ใช้และรหัสผ่านตามสังกัดของท่าน
            ";
            notifyToOfficer($access_token, $message);
        }
    }