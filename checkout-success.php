<?php
    require("./utils/db_connector.php");
    require("./api/notify/notify_func.php");
    $purchase_list = $_POST['purchases'];

    $update_lineitem_sql = "";
    foreach($purchase_list as $purchase_line_item_id => $data){
        $desc = trim($data['desc']);
        $appointment_date = trim($data['appointment_date']);
        $update_lineitem_sql .= "
            UPDATE purchase_lineitem
            SET `des` = '$desc', `appointment_date` = '$appointment_date'
            WHERE `purchase_lineitem_id` = '$purchase_line_item_id';
        ";
    }

    if (!$conn->multi_query($update_lineitem_sql)) {
        die("can't update line item appointment");
    }

    // update header status to pending
    $purchase_id = $_POST['purchase_id'];
    $set_pending_status_sql = "
        UPDATE purchase 
        SET `PURCHASE_STATUS` = 'P'
        WHERE `PURCHASE_ID` = '$purchase_id';
    ";
    $conn->query($set_pending_status_sql);
    $conn->close();

    $notifyOfficerText = "\n\nผู้ใช้ไฟฟ้านามว่า 'นายชีววร เศรษฐกุล' สนใจบริการธุรกิจเสริม จำนวน 8 รายการ พร้อมวันนัดหมายที่สะดวกในการรับบริการ\n\nรายละเอียดบริการต่างๆ ท่านสามารถตรวจสอบได้จาก https://nuntio.serveo.net/crm-bu/login.php";
    notifyToOfficer('HfxxJygBYroHH0Xojwm1j873oHhTICwlzkPFWaN5Bio', $notifyOfficerText);
?>
<html>
    <body>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
        <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
        <script>
            Swal.fire({
                title: 'สำเร็จ !',
                html: 'การไฟฟ้าส่วนภูมิภาค ได้รับข้อมูลบริการที่ท่านสนใจพร้อมวันนัดหมายเรียบร้อยแล้ว...<br/> ',
                type: 'success',
                timer: 5000
            }).then(function(){
                window.location.href = "customer.php?action=liff_construc";
            });
        </script>
    </body>
</html>