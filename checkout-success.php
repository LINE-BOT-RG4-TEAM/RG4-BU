<?php
    date_default_timezone_set("Asia/Bangkok");
    require("./utils/db_connector.php");
    require("./api/notify/notify_func.php");
    $purchase_list = $_POST['purchases'];
    $quantity_purchase = count($purchase_list);
    $purchase_id = $_POST['purchase_id'];

    $update_lineitem_and_status = "";
    foreach($purchase_list as $purchase_line_item_id => $data){
        $desc = trim($data['desc']);
        $appointment_date = trim($data['appointment_date']);
        $update_lineitem_and_status = "
            UPDATE purchase_lineitem
            SET `des` = '$desc', `appointment_date` = '$appointment_date'
            WHERE `purchase_lineitem_id` = '$purchase_line_item_id';
        ";
        $conn->query($update_lineitem_and_status);
    }

    // add query for update status to Pending (P)
    $update_purchase_status = "
        UPDATE purchase 
        SET PURCHASE_STATUS = 'P'
        WHERE PURCHASE_ID = '{$purchase_id}';
    ";

    if (!$conn->query($update_purchase_status)) {
        die("can't update purchase status");
    }

    /* 
     * แจ้งเตือนทุกคนตามสังกัดไฟฟ้าดังกล่าว
     * และแจ้งเตือน กบล. ที่เขต
     */
    $fetch_notify_received_person = "
        SELECT purchase.purchase_id
            , purchase.UserID
            , ca.PEA_CODE
            , office.PEA_NAME
            , ca.FullName
            , notify_officers.access_token
            , notify_officers.employee_code
            , notify_officers.target_type
        FROM purchase
            JOIN ca ON purchase.UserID = ca.UserID
            JOIN notify_officers ON ca.PEA_CODE = notify_officers.PEA_CODE
            JOIN office ON ca.PEA_CODE = office.PEA_CODE
        WHERE purchase.purchase_id = '{$purchase_id}';
    ";
    $received_result = $conn->query($fetch_notify_received_person);
    $person = $received_result->fetch_assoc();
    $pea_code = $person["PEA_CODE"];
    $pea_name = $person["PEA_NAME"];
    $notifyOfficerText = "\n\nผู้ใช้ไฟฟ้านามว่า '".$person["FullName"]."' สนใจบริการธุรกิจเสริม จำนวน {$quantity_purchase} รายการ ตามใบสรุปความต้องการหมายเลข $purchase_id พร้อมระบุวันนัดหมายที่สะดวกในการรับบริการ ในสังกัด '{$pea_name}' ";
    notifyToOfficer($person["access_token"], $notifyOfficerText);
    while($person = $received_result->fetch_assoc()){
        notifyToOfficer($person["access_token"], $notifyOfficerText);
    }
    mysqli_free_result($received_result);

    $fetch_district_notify_recevied_person = "
        SELECT pea_code
            , access_token
            , employee_code
            , target_type
        FROM notify_officers
        WHERE notify_officers.pea_code = CONCAT(LEFT('$pea_code',1), '00000');
    ";
    $received_result = $conn->query($fetch_district_notify_recevied_person);
    while($person = $received_result->fetch_assoc()){
        notifyToOfficer($person["access_token"], $notifyOfficerText);
    }
?>
<!DOCTYPE html>
<html lang="th">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>ระบบกำลังประมวลผล</title>
        <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="./assets/css/theme_1545570683953.css">
        <link href="https://fonts.googleapis.com/css?family=Sarabun|Roboto" rel="stylesheet">
        <style>
            * {
                font-family: 'Sarabun', 'Roboto', sans-serif;
            }
        </style>

        <script src="https://d.line-scdn.net/liff/1.0/sdk.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
        <script>
            window.onload = function(){
                var responseHTML = '<p style="font-size:24px;">ได้รับข้อมูลบริการที่ท่านสนใจพร้อมวันนัดหมายเรียบร้อยแล้ว</p>'+ 
                                '<p style="font-size:20px">การไฟฟ้าส่วนภูมิภาคจะดำเนินการตรวจสอบข้อมูล และวางแผนในการให้บริการต่อไปค่ะ</p>';
                
                Swal.fire({
                    title: 'สำเร็จ !',
                    html: responseHTML,
                    type: 'success'
                }).then(function(){
                    <?php 
                        $encode_purchase_id = base64_encode("purchase_id=$purchase_id");
                    ?>
                    var liff_message = "[ข้อความจาก SmartBiz]\n\nเรียน คุณลูกค้า\n\nคุณสนใจเลือกบริการเสริมจาก กฟภ. จำนวน <?=$quantity_purchase ?> บริการ จากใบเสนอความต้องการหมายเลข #<?=$purchase_id?> เมื่อวันที่ <?= date("Y-m-d"); ?> เวลา <?= date("H:i") ?>น. โดยพนักงาน กฟภ. จะดำเนินการวางแผนในการให้บริการ และติดต่อนัดหมายท่านอีกครั้งเพื่อยืนยันวันนัดหมาย \n\n ใบเสนอความต้องการ: https://pea-crm.herokuapp.com/show_invoice.php?<?= $encode_purchase_id ?>";
                    
                    // send message from liff
                    liff.sendMessages([
                        {
                            type: 'text',
                            text: liff_message
                        }
                    ]);
                    Swal.fire({
                        title: '',
                        type: 'info',
                        text: 'กำลังนำท่านไปยังหน้าเลือกสินค้า, กรุณารอสักครู่ค่ะ ...',
                        timer: 5000
                    }).then(function(){
                        window.location.href = "customer.php?action=liff_service";
                    });
                });
            }
        </script>
    </head>
    <body>

    </body>
</html>