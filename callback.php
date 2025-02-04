<?php
    function siteURL(){
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $domainName = $_SERVER['HTTP_HOST'].'/';
        return $protocol.$domainName;
    }

    require('./utils/db_connector.php');
    define('TOKEN_URI', 'https://notify-bot.line.me/oauth/token');
    define('STATUS_URI', 'https://notify-api.line.me/api/status');
    define('REDIRECT_URI', siteURL().'callback.php');
    define('CLIENT_ID', 'YQz4zuElk6zePoTWmsOte7');
    define('CLIENT_SECRET', 'ArleV3DuZ4rpFX0I6v2Utb879SjGAo4s46za8jSaY5g');

    // check when trigger error
    if(isset($_GET['error']) && strlen($_GET['error']) > 0){
        die($_GET['error_description']);
    }

    $payload = explode(",", $_GET['state']);

    // payload = J00000,user,505397
    // payload = J00000,group
    $pea_code = $payload[0];
    // $employee_code = $payload[1];
    if(isset($_GET['code']) && strlen($_GET['code']) > 0){
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];

        $code = $_GET['code'];
        $fields = [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => REDIRECT_URI,
            'client_id' => CLIENT_ID,
            'client_secret' => CLIENT_SECRET
        ];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, TOKEN_URI);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
        $res = curl_exec($ch);
        curl_close($ch);

        if ($res == false)
            throw new Exception(curl_error($ch), curl_errno($ch));
        
        $json = json_decode($res);
        $status = $json->status;
    }
?>
<!DOCTYPE html>
<html lang="th">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>ลงทะเบียนการรับข้อความแจ้งเตือน</title>
        <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="./assets/css/theme_1545570683953.css">
        <link href="https://fonts.googleapis.com/css?family=Sarabun|Roboto" rel="stylesheet">
        <style>
            * {
                font-family: 'Sarabun', 'Roboto', sans-serif;
            }
        </style>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    </head>
    <body>
            <script>
                window.onload = function(){
    <?php 
        if($status == 200) {
            $employee_code = $payload[2];
            $access_token = $json->access_token;
            $fetch_exist_access_token = "
                SELECT employee_code, pea_code
                FROM notify_officers
                WHERE status = 'A' 
                        AND pea_code = '$pea_code'
                        AND employee_code = '$employee_code';
            ";
            $exist_results_set = $conn->query($fetch_exist_access_token);
            
            // มีผู้ใช้ดังกล่าวอยู่แล้วในระบบ
            if(mysqli_num_rows($exist_results_set) > 0){
                echo "
                    Swal.fire({
                        type: 'warn',
                        html: 'ไม่สามารถมีผู้ระบการแจ้งเตือนนี้อยู่แล้วในระบบ'
                    });
                ";
            // ยังไม่มีในระบบต้องเพิ่ม
            } else {
                // เรียกชื่อในโปรแกรมไลน์ของผู้ลงทะเบียน
                $headers = [
                    "Authorization: Bearer {$access_token}"
                ];

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, STATUS_URI);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            
                $res = curl_exec($ch);
                curl_close($ch);

                if ($res == false)
                    throw new Exception(curl_error($ch), curl_errno($ch));
                
                $json = json_decode($res);
                $status = $json->status;
                if($status !== 200){
                    die("เกิดข้อผิดพลาดจากระบบ LINE Notify, กรุณาลองใหม่อีกครั้ง");
                }

                $target_type = $json->targetType;
                $target_name = $json->target;

                // เพิ่มข้อมูลของผู้ลงทะเบียนไปยังตาราง notify_officers
                if($target_type === "USER"){
                    $insert_notify_officer = "
                        INSERT INTO notify_officers(pea_code, employee_code, target_type, target_name, access_token)
                        VALUES('$pea_code', '$employee_code', '$target_type', '$target_name', '$access_token');
                    ";
                }else if($target_type === "GROUP"){
                    $insert_notify_officer = "
                        INSERT INTO notify_officers(pea_code, target_type, target_name, access_token)
                        VALUES('$pea_code', '$target_type', '$target_name', '$access_token');
                    ";
                }
                if($conn->query($insert_notify_officer) === TRUE){
                    echo "
                        Swal.fire({
                            type: 'success',
                            html: 'ลงทะเบียนเรียบร้อยแล้ว'
                        });
                    ";
                    ?>
                        document
                            .getElementsByTagName('body')[0]
                            .append("ผู้ใช้รหัสประจำตัว <?=$employee_code?> ลงทะเบียนด้วยบัญชี LINE นามว่า '<?=$target_name?>' เรียบร้อยแล้ว...");
                    <?php
                } else {
                    die('เกิดข้อผิดพลาดกับระบบ กรุณาลองใหม่อีกครั้ง');
                    header("Location: ".siteURL()."authorize.php");
                }
            }
        } else {
            echo "
                Swal.fire({
                    type:'error',
                    html: 'ท่านทำรายการไม่ถูกต้อง<br/>ระบบจะนำท่านไปยังหน้าลงทะเบียนใหม่อีกครั้ง'
                });
            ";
            echo "alert('เมื่อระบบส่งค่ากลับด้วยสถานะอื่น');";
            header("Location: ".siteURL()."authorize.php");
            die();
        }
    ?>
                }
        </script>
    </body>
</html>