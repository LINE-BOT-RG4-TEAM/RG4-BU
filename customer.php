<?php require('./utils/array_utils.php'); ?>
<?php require('./utils/db_connector.php'); ?>
<?php 
  // check 'action' from get params
  if(!array_key_exists("action", $_GET)){
    header("Location: ?action=cust_home");
    exit(0);
  }
  // get action value from action key in $_GET
  $action = $_GET['action'];
?>
<?php require('./partials/marketplace_header.php'); ?>
<?php 
  // filter only php extension
  $filter_file_name = array_filter(scandir("./"), "filter_php_file");

  $page_php_path = "{$action}.php";
  if(in_array($page_php_path, $filter_file_name, true)){
    include($page_php_path);
    echo "<button class='animated fadeIn font-weight-bold btn btn-outline-primary float-btn bg-white text-primary border-primary shadow-lg'>
      <i class='fas fa-2x fa-shopping-cart'></i><br/>ตะกร้าสินค้า<br/><span id='quantity_service' class='badge badge-light'>3 บริการ</span>
    </button>";
    echo "<style> 
      .float-btn{
        position: fixed;
        bottom: 0px;
        right: 0px;
        padding: 20px;
        margin-right: 30px;
        margin-bottom: 30px;
        border-radius: 15% 15%;
      }
    </style>";
  } else {
    include("404.php");
  }
  
  // include essentials scripts 
  require("./partials/scripts.php");

  // include script control withit page
  $page_script_path = "scripts/{$action}.js";
  if(file_exists($page_script_path)){
    echo "<script>";
    include("scripts/liff_global.js");
    include($page_script_path);
    echo "</script>";
  }
  
?>
<?php require("./partials/marketplace_footer.php"); ?>