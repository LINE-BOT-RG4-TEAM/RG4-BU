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
        $update_lineitem_and_status .= "
            UPDATE purchase_lineitem
            SET `des` = '$desc', `appointment_date` = '$appointment_date'
            WHERE `purchase_lineitem_id` = '$purchase_line_item_id';
        ";
    }

    // add query for update status to Pending (P)
    $update_lineitem_and_status .= "
        UPDATE purchase 
        SET PURCHASE_STATUS = 'P'
        WHERE PURCHASE_ID = '$purchase_id';
    ";

    if (!$conn->multi_query($update_lineitem_and_status)) {
        die("can't update line item appointment");
    }
    $conn->close();

    /* TODO
     * แก้ไขให้ไปแจ้งเตือนทุกคนตามสังกัดไฟฟ้าดังกล่าว
     * และแจ้งเตือน กบล. ที่เขต
     */
    $notifyOfficerText = "\n\nผู้ใช้ไฟฟ้านามว่า 'นายชีววร เศรษฐกุล' สนใจบริการธุรกิจเสริม จำนวน {$quantity_purchase} รายการ พร้อมระบุวันนัดหมายที่สะดวกในการรับบริการ\n\nรายละเอียดบริการต่างๆ ท่านสามารถตรวจสอบได้จาก https://nuntio.serveo.net/crm-bu/login.php";
    notifyToOfficer('HfxxJygBYroHH0Xojwm1j873oHhTICwlzkPFWaN5Bio', $notifyOfficerText);
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
                    var liff_message = "[ข้อความจาก SmartBiz]\n\nเรียน คุณลูกค้า\n\nคุณสนใจเลือกบริการเสริมจาก กฟภ. จำนวน <?=$quantity_purchase ?> บริการ จากหมายเลขคำสั่งซื้อ #<?=$purchase_id?> เมื่อวันที่ <?= date("Y-m-d"); ?> เวลา <?= date("H:i") ?>น. โดยพนักงาน กฟภ. จะดำเนินการวางแผนในการให้บริการ และติดต่อนัดหมายท่านอีกครั้งเพื่อยืนยันวันนัดหมาย \n\n เอกสารยืนยันการสั่งซื้อ: https://pea-crm.herokuapp.com/show_invoice.php?<?= $encode_purchase_id ?>";
                    
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