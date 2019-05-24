<?php
    require('../utils/db_connector.php');
    $lineitem_id = $_POST["lineitem_id"];

    $sql_delete = "DELETE FROM purchase_lineitem WHERE purchase_lineitem_id=$lineitem_id";
    mysqli_query($conn,$sql_delete);

    echo "Delete Success...";


?>