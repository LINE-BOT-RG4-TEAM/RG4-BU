<?php
    require('../utils/db_connector.php');
    require("./notify/notify_func.php");
    define("LINE_PUSH_API", "https://api.line.me/v2/bot/message/push");
    define("LINE_CHANNEL_ACCESS_TOKEN", getenv("LINE_CHANNEL_ACCESS_TOKEN"));

    $purchase_id = $_POST["purchase_id"];

    $fetch_summary_purchase = "
        SELECT purchase.purchase_id
                , purchase.UserID
                , ca.FullName
                , ca.PEA_CODE
                , ca.`CA`
                , COUNT(lineitem.purchase_lineitem_id) AS 'quantity_service'
        FROM purchase  
            JOIN purchase_lineitem lineitem ON purchase.purchase_id = lineitem.purchase_id
            JOIN ca ON ca.`CA` = purchase.`CA`
        WHERE purchase.purchase_id = '{$purchase_id}' 
        GROUP BY 1, 2, 3, 4, 5
    ";

    $summary_purchase_results = $conn->query($fetch_summary_purchase);
    $summary_row = $summary_purchase_results->fetch_assoc();
    $userId = $summary_row["UserID"];
    $quantity_service = $summary_row["quantity_service"];

    // build notify message

    $encode_purchase_id = base64_encode("purchase_id=$purchase_id");
    $notify_message = "[ข้อความจาก SmartBiz]\n\nเรียน คุณลูกค้า\n\nพนักงาน กฟภ. ได้ปรับปรุงบริการเสริมตามใบสรุปความต้องการหมายเลข #{$purchase_id} โดยมีจำนวนบริการเสริมทั้งหมด $quantity_service บริการ เมื่อวันที่ ".date("Y-m-d")." เวลา ".date("H:i")."น. โดยพนักงาน กฟภ. จะดำเนินการวางแผนในการให้บริการต่อไป \n\n ใบสรุปความต้องการ: https://pea-crm.herokuapp.com/show_invoice.php?{$encode_purchase_id}";

    // notify customer by line bot
    $messages = [ 
        'type' => 'text', 
        'text' => $notify_message
    ];
    $data = [
        'to' => $userId,
        'messages' => [$messages]
    ];
    $post = json_encode($data);
    $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . LINE_CHANNEL_ACCESS_TOKEN);
    $ch = curl_init(LINE_PUSH_API);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    // $result = curl_exec($ch);
    curl_close($ch);

    // notify officers
    $pea_code = $summary_row["PEA_CODE"];
    $ca = $summary_row["CA"];
    $FullName = $summary_row["FullName"];
    $message = "ผู้ใช้ไฟฟ้านามว่า `{$FullName}` ได้ปรับเปลี่ยนบริการเสริม ตามใบสรุปความต้องการเลขที่ #{$purchase_id} โดยมีจำนวนบริการทั้งหมด {$quantity_service} บริการ \n\n ใบสรุปความต้องการ: https://pea-crm.herokuapp.com/show_invoice.php?{$encode_purchase_id}";
    $district = substr($pea_code, 0, 1);
    $fetch_officers = "
        SELECT access_token
        FROM notify_officers
        WHERE pea_code in ('{$pea_code}', '{$district}00000')
    ";
    $notify_results = $conn->query($fetch_officers);
    while($officer = $notify_results->fetch_assoc()){
        notifyToOfficer($officer["access_token"], $message);
    }
    http_response_code(200);
    exit(0);
