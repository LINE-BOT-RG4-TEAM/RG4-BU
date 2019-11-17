<?php
    define("LINE_PUSH_API", "https://api.line.me/v2/bot/message/push");
    define("LINE_CHANNEL_ACCESS_TOKEN", getenv("LINE_CHANNEL_ACCESS_TOKEN"));

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
    $fetch_duedate_bf_1_month = "
        SELECT FullName
            , ADDRESS
            , CA.CA
            , UserID
            , DATE_ADD(`HISTORY`, INTERVAL 11 MONTH) AS 'bf_1_month_due_date'
            , DATE_ADD(`HISTORY`, INTERVAL 1 YEAR) AS 'due_date'
            , COUNT(*) AS 'count_job'
        FROM history
            JOIN CA ON history.CA = CA.ca
            JOIN BP ON BP.BP = CA.BP
        WHERE UserID IS NOT NULL
            AND DATE_ADD(history.`HISTORY`, INTERVAL 11 MONTH) = '{$today}'
            AND CODE IN ('S301', 'S302', 'S303', 'S304', 'S305')
        GROUP BY 1, 2, 3, 4, 5, 6;
    ";
    $bf_1_month_result = mysqli_query($conn, $fetch_duedate_bf_1_month);
    if($bf_1_month_result->num_rows == 0){
        return;
    }

    while($row = $bf_1_month_result->fetch_assoc()){
        $CA = $row["CA"];
        $userId = $row["UserID"];
        $full_name = $row["FullName"];
        $due_date = $row["due_date"];
        $count_job = $row["count_job"];
        $message = "[ข้อความจาก SmartBiz]\n\nเรียน คุณ {$full_name}\n\nท่านมีรายการบำรุงรักษาที่ครบกำหนดภายในวันที่ {$due_date} จำนวน {$count_job} รายการ \n\n ท่านสามารถตรวจสอบรายการดังกล่าว https://pea-crm.herokuapp.com/show_duedate_1_month.php?ca={$CA}&due_date={$due_date}";
        pushMessageToCustomer($userId, $message);
    }

    function pushMessageToCustomer($userId, $message){
        $messages_obj = [ 
            'type' => 'text', 
            'text' => $message
        ];
        $data = [
            'to' => $userId,
            'messages' => [$messages_obj]
        ];
        $post = json_encode($data);
        $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . LINE_CHANNEL_ACCESS_TOKEN);
        $ch = curl_init(LINE_PUSH_API);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($ch);
        curl_close($ch);
    }