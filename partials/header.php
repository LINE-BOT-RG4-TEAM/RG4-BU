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
    <style>
      * {
        font-family: 'Sarabun', 'Roboto', sans-serif;
      }
    </style>
  </head>

  <body>
    <header class="pb-3">
      <!-- Image and text -->
      <nav class="shadow-sm navbar navbar-light bg-white">
        <div class="container">
          <a class="navbar-brand font-weight-bold" href="#!">
            <img src="./assets/images/pea-logo.png" width="100" class="d-inline-block align-top" alt="">
            บริหารจัดการฐานข้อมูลลูกค้ารายสำคัญและธุรกิจเสริม
          </a>
          <span class="navbar-text">
            Customer Relationship Management (Business Unit)
          </span>
        </div>
      </nav>
    </header>
    <main class="mb-3">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-4 col-lg-3">
            <h5 class="header text-dark font-weight-bold text-center">เมนูหลัก</h5>
            <div class="nav flex-column nav-pills rounded" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <a class="nav-link <?=$action=='home'?'active':'' ?>" href="?action=home">
                <i class="fas fa-home"></i>
                หน้าแรก
              </a>
              <!-- <div class="dropdown-divider"></div> -->
              <!-- <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                <i class="fas fa-star"></i>
                ข้อมูลลูกค้า High Value
              </a>
              <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                <i class="fab fa-searchengin"></i>
                ค้นหาลูกค้าอัตโนมัติ
              </a> -->
              <a class="nav-link <?=$action=='search'?'active':'' ?>" href="?action=search">
                <i class="fas fa-hand-point-up"></i>  
                ค้นหาลูกค้า
              </a>
            </div>
          </div>
          <div class="col-sm-12 col-md-8 col-lg-9">