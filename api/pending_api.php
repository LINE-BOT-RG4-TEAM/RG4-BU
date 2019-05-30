<?php
    $values = array();
    parse_str($_POST['form_data'],$values);
    echo json_encode($values);

?>