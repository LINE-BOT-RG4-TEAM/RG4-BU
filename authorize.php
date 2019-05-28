<?php
    $authorizeURL = "https://notify-bot.line.me/oauth/authorize";
    define('CLIENT_ID', 'YQz4zuElk6zePoTWmsOte7');
    define('CLIENT_SECRET', 'ArleV3DuZ4rpFX0I6v2Utb879SjGAo4s46za8jSaY5g');
    // $client_id = "YQz4zuElk6zePoTWmsOte7";
    // $client_secret = "ArleV3DuZ4rpFX0I6v2Utb879SjGAo4s46za8jSaY5g";
    // header("Location: https://notify-bot.line.me/oauth/authorize");
    // header("'response_type': 'code'");
    // header("'client_id': 'YQz4zuElk6zePoTWmsOte7'");
    // header("'redirect_uri': https://monstro.serveo.net/crm-bu/success.php");
    // header("'scope': 'notify'");
    // header("'state': 'cheevavorn'");

    $params = array(
        'response_type' => 'code',
        'client_id' => CLIENT_ID,
        'redirect_uri' => 'https://pea-crm.herokuapp.com/callback.php',
        'scope' => 'notify',
        'state' => 'cheevavorn'
    );
    // Redirect the user to Github's authorization page
    header('Location: ' . $authorizeURL . '?' . http_build_query($params));
    die();