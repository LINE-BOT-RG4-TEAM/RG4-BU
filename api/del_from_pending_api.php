<?php
    require('../utils/db_connector.php');
    $purchase_id = $_POST["purchase_id"];
    $cate_id = $_POST["cate_id"];

    $sql_delete = "DELETE FROM purchase_lineitem WHERE purchase_id = '$purchase_id' AND cate_id = '$cate_id'";

    mysqli_query($conn,$sql_delete);

    echo "Delete Success...";

?>