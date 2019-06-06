<?php
    require_once __DIR__ . '/vendor/autoload.php';

    $queryString = $_SERVER['QUERY_STRING'];
    parse_str(base64_decode($queryString), $params);

    $purchase_id = $params['purchase_id'];

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML('<h1>Hello world!</h1>');
    $mpdf->WriteHTML("purchase id is $purchase_id");
    $mpdf->Output();