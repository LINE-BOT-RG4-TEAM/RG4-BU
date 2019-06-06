<?php
    $queryString = $_SERVER['QUERY_STRING'];
    parse_str(base64_decode($queryString), $params);
    var_dump($params);