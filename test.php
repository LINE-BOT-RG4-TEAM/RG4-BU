<?php
    // hash sha1 session
    // $plain = 's2';
    // $hash_password = sha1($plain);
    // $simple_hash = '$2y$10$dgtzFcVTBa9HCLurf05e9ODtUZ8tSsGkX2XR1BLeM74k.CfgWWNQ2';
    // $result = password_verify($plain, $hash_password);
    // $hash_password = password_hash($plain, PASSWORD_BCRYPT);
    // $result = password_verify($plain, $hash_password);

    // echo "username: $plain <br/>";
    // echo "password: $hash_password <br/>";
    // echo sha1($plain)."<br/>";
    // echo "{sha1($plain)} === {$hash_password}";

    // echo "s1: ".sha1('s1')."<br/>";
    // echo "s2: ".sha1('s2')."<br/>";
    // echo "s3: ".sha1('s3');

    // $_GET
    // echo "<pre>";
    // // var_dump(array_keys($_GET));
    // echo json_encode($_POST, JSON_UNESCAPED_UNICODE);
    // echo "</pre>";
    // $purchase_id = $_POST['purchase_id'];
    // $set_pending_status_sql = "
    //     UPDATE purchase 
    //     SET PURCHASE_STATUS = 'P'
    //     WHERE PURCHASE_ID = '$purchase_id';
    // ";
    // echo $set_pending_status_sql;

    // define('STATUS_URI', 'https://notify-api.line.me/api/status');

    // $headers = [
    //     "Authorization: Bearer sMpjyLrk6WrFjgO0bboXxuZExejzYnsJG7oIyvZnUA3"
    // ];

    // $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL, STATUS_URI);
    // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // // curl_setopt($ch, CURLOPT_HEADER, 0);

    // $res = curl_exec($ch);
    // curl_close($ch);

    // if ($res == false)
    //     throw new Exception(curl_error($ch), curl_errno($ch));
    
    // $json = json_decode($res);
    // $status = $json->status;
    // var_dump($res);
    echo $_SERVER['QUERY_STRING']."<br/>";
    echo base64_encode($_SERVER['QUERY_STRING']);