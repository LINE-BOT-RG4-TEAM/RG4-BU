<?php
require('../utils/db_connector.php');
$cate_id = $_GET["cate_id"];
$sql_cate_id = "SELECT * FROM product_category WHERE parent_cate_id = '$cate_id'";
$query_cate_id = mysqli_query($conn,$sql_cate_id);
$data =array();
while($obj = mysqli_fetch_assoc($query_cate_id))
{
    push_array($data,$obj);
}
echo json_encode($data);

?>