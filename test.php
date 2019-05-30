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
    echo "<pre>";
    // var_dump(array_keys($_GET));
    echo json_encode($_POST, JSON_UNESCAPED_UNICODE);
    echo "</pre>";