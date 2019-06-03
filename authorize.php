<?php
    function siteURL(){
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $domainName = $_SERVER['HTTP_HOST'].'/';
        return $protocol.$domainName;
    }

    define('CLIENT_ID', 'YQz4zuElk6zePoTWmsOte7');
    define('CLIENT_SECRET', 'ArleV3DuZ4rpFX0I6v2Utb879SjGAo4s46za8jSaY5g');
    define('SITE_URL', siteURL());
    $authorizeURL = "https://notify-bot.line.me/oauth/authorize";
    
    // get pea_code from
    $payload = base64_decode($_GET['payload']);

    $params = array(
        'response_type' => 'code',
        'client_id' => CLIENT_ID,
        'redirect_uri' => SITE_URL."callback.php",
        'scope' => 'notify',
        'state' => $payload
    );
    // Redirect the user to Github's authorization page
    header('Location: ' . $authorizeURL . '?' . http_build_query($params));
    die();