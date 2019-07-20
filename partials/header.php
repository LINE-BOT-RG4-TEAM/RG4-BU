<!DOCTYPE html>
<html lang="th">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ระบบบริหารจัดการฐานข้อมูลลูกค้ารายสำคัญและธุรกิจเสริม - สายงานการไฟฟ้า ภาค 4</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/theme_1545570683953.css">
    <link href="https://fonts.googleapis.com/css?family=Sarabun|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.14.2/dist/bootstrap-table.min.css">
    <link rel="stylesheet" href="./assets/css/bootstrap-table-sticky-header.css">
    <link rel="stylesheet" href="./assets/css/animate.css">
    <style>
      * {
        font-family: 'Sarabun', 'Roboto', sans-serif;
      }
      .font-roboto {
        font-family: 'Roboto';
      }
    </style>
  </head>

  <body>
    <header class="pb-3">
      <!-- Image and text -->
      <nav class="shadow-sm navbar navbar-light bg-white">
        <div class="container-fluid">
          <a class="navbar-brand font-weight-bold animated fadeIn" href="#!">
            <img src="./assets/images/pea-logo.png" width="100" class="d-inline-block align-top" alt="">
            บริหารจัดการฐานข้อมูลลูกค้ารายสำคัญและธุรกิจเสริม
          </a>
          <span class="navbar-text">
            <?="สังกัด: ".$_SESSION['pea_code'].":".$_SESSION['pea_name'].", "."สิทธิ: ".$_SESSION['role'] ?>
          </span>
        </div>
      </nav>
    </header>
    <main class="mb-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12 col-md-4 col-lg-3">
            <!-- <h5 class="header text-secondary font-weight-bold text-left">เมนูหลัก</h5> -->
            <div class="animated fadeIn nav flex-column nav-pills rounded sticky-top" style="z-index: 0;" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <a class="header text-dark bg-light font-weight-bold text-center nav-link disabled" style="font-size:22px;">
                เมนูหลัก
              </a>
              <a class="nav-link <?=$action=='home'?'active':'' ?>" href="?action=home">
                <i class="fas fa-home"></i>
                หน้าแรก
              </a>

              <?php 
                $role = $_SESSION['role'];
                $fetch_menu_by_role = "
                    SELECT menu_role.menu_action
                    , menu.menu_description
                    , menu.menu_icon
                  FROM menu_role 
                    JOIN menu ON menu_role.`menu_action` = menu.`menu_action`
                  WHERE menu_role.`role` = '{$role}' AND menu_role.`is_active` = 'A'
                  ORDER BY `order`
                ";
                $menu_object = $conn->query($fetch_menu_by_role);
                while($menu = $menu_object->fetch_assoc()){
              ?>
                <a class="nav-link <?=$action==$menu['menu_action']?'active':'' ?>" href="?action=<?=$menu['menu_action']?>">
                  <i class="<?=$menu['menu_icon']?>"></i>
                  <?=$menu['menu_description'] ?>
                  <?php 
                    if($menu['menu_action'] == "po_emp"){
                  ?>
                    <div class="float-right">
                      <span class="badge border badge-light pr-quantity" style="display:none;">... งาน</span>
                    </div>
                  <?php
                    }
                  ?>
                </a>
              <?php
                }
              ?>

              <a class="nav-link <?=$action=='logout'?'active':'' ?>" href="logout.php">
                <i class="fas fa-sign-out-alt"></i> 
                ออกจากระบบ
              </a>
              <div class="dropdown-divider"></div>
              <a class="nav-link border p-3 disabled text-center bg-light">
                <i class="far fa-2x fa-id-card"></i><br/>
                ติดต่อสอบถาม, แนะนำ <br/>หรือแจ้งปัญหาการใช้งาน<br/>ที่ 5140 หรือ <br/>chiwawon.sae@pea.co.th 
              </a>
            </div>
          </div>
          <div class="col-sm-12 col-md-8 col-lg-9">