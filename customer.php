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
    if(!in_array($action, array("cust_register","checkout","purchase_detail"))){
      require('./partials/circular_menu.php');
      /*echo "<button type='button' data-toggle='modal' data-target='#cartModal' class='animated fadeIn font-weight-bold btn btn-outline-primary float-btn bg-white text-primary border-primary shadow-lg'>
        <i class='fas fa-2x fa-shopping-cart'></i><br/>ตะกร้าสินค้า<br/><span id='quantity_service' style='font-size:16px;' class='badge badge-light'>0 บริการ</span>
      </button>
      <div class='modal fade' tabindex='-1' role='dialog' id='cartModal'>
        <div class='modal-dialog' role='document'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h5 class='modal-title font-weight-bold'><i class='fas fa-shopping-cart'></i> รายการบริการ</h5>
              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>
            <div class='modal-body' id='lineitem_area'>
            </div>
            <div class='modal-footer'>
              <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
          </div>
        </div>
      </div>";
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
      </style>";*/
    }
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