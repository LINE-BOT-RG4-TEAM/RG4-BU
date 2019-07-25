<?php session_start(); ?>
<?php require('./utils/array_utils.php'); ?>
<?php require('./utils/db_connector.php'); ?>
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
    <link rel="stylesheet" href="./assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.14.2/dist/bootstrap-table.min.css">
    <link rel="stylesheet" href="./assets/css/bootstrap-table-sticky-header.css">
    <style>
      * {
        font-family: 'Sarabun', 'Roboto', sans-serif;
      }
      .font-roboto {
        font-family: 'Roboto';
      }
    </style>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="http://malsup.github.io/jquery.blockUI.js"></script>

    <!-- <script src="./assets/js/jquery-3.3.1.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.14.2/dist/bootstrap-table.min.js"></script>
    <script src="./assets/js/bootstrap-table-sticky-header.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.th.min.js"></script> -->
  </head>

  <body>
    <header class="pb-3">
      <nav class="shadow-sm navbar navbar-light bg-white">
        <div class="container">
          <a class="navbar-brand font-weight-bold" href="#!">
            <img src="./assets/images/pea-logo.png" width="100" class="d-inline-block align-top" alt="">
            Find Out Customer
          </a>
        </div>
      </nav>
    </header>
    <main class="mt-3 mb-3">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 offset-md-4 col-md-6 offset-lg-4 col-lg-4 offset-xl-4 col-xl-4">
            <div class="accordion" id="accordionExample">
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h2 class="mb-0">
                    <button class="btn btn-link font-weight-bold" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      <i class="fas fa-qrcode"></i> QR Code หรือ LINE ID ของ PEA SmartBiz
                    </button>
                  </h2>
                </div>

                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                  <div class="card-body border border-top-0 border-left-0 border-right-0 border-secondary">
                    <img class="w-100" src="./assets/images/qr-code-with-logo.png"/>
                    <p class='font-weight-bold text-center' style="font-size: 35px;">LINE ID<br/>@jgz8631b</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="mt-3 card border-left-0 border-bottom-0 border-right-0 border-primary mb-3 shadow">
                <div class="card-body mx-2 my-2">
                    <div class="text-center">
                        <img class="img-fluid" src="./assets/images/pea-logo-purple.png" style="max-width:130px"/>
                    </div>
                    <h5 class="text-center card-title font-weight-bold mt-2">ค้นหาข้อมูลลูกค้าระบบฐานข้อมูลลูกค้ารายสำคัญ</h5>
                    <hr />
                    <form method="POST" action="#!" autocomplete="off">
                        <div class="form-group">
                          <label for="cust_name" class="font-weight-bold"><i class="fas fa-user-shield"></i> ชื่อลูกค้า (ส่วนใดส่วนหนึ่ง)</label>
                          <input type="text" class="form-control" id="cust_name" name="cust_name" placeholder="กรอกส่วนใดส่วนของชื่อลูกค้า" value="<?=isset($_POST['cust_name'])?$_POST['cust_name']:''?>">
                        </div>
                        <div class="form-group">
                          <label for="address" class="font-weight-bold"><i class="fas fa-key"></i> ที่อยู่ลูกค้า</label>
                          <input type="text" class="form-control" id="address" name="address" placeholder="กรอกส่วนใดส่วนหนึ่งของที่อยู่" value="<?=isset($_POST['address'])?$_POST['address']:''?>">
                        </div>
                        <!-- <div class="alert alert-primary font-weight-bold" role="alert">
                          <i class="far fa-question-circle"></i> หากท่านต้องการค้นหาข้อมูลในช่องข้อมูลเดียวด้วยหลายๆ ค่า ท่านสามารถกรอกเครื่องหมาย , (comma) คั่นระหว่างค่า
                        </div> -->
                        <div class="form-group text-center">
                          <button type="submit" class="btn btn-primary btn-block btn-lg">
                            <i class="fas fa-paper-plane"></i> ค้นหา
                          </button>
                        </div>
                    </form>
                </div>
            </div>
          </div>
        </div> <!-- end of row's class tag -->
        <!-- show results of data -->
        <?php 
          if($_POST){
        ?>
            <table 
              data-toggle="table" 
              data-pagination="true"
              data-fixed-columns="true"
              data-pagination-v-align="both"
              data-sticky-header="true"
              data-search="true"
              data-page-size="5"
              data-page-list="[5, 10, 20, 100, ALL]"
              data-url="./api/datatable/find_customer.php?cust_name=<?=$_POST['cust_name']?>&address=<?=$_POST['address']?>">
              <thead>
                <tr>
                  <th data-field="PEA_NAME" data-sortable="true"><i class="fas fa-indent"></i>การไฟฟ้า</th>
                  <th data-field="CA" data-sortable="true"><i class="fas fa-user-tie"></i>CA</th>
                  <th data-field="CUSTOMER_NAME" data-sortable="true"><i class="fas fa-user-tie"></i>ชื่อลูกค้า</th>
                  <th data-field="ADDRESS" data-sortable="true"><i class="fas fa-receipt"></i> ที่อยู่</th>
                  <th data-field="BUSINESS_TYPE"> ประเภทธุรกิจ</th>
                </tr>
              </thead>
            </table>
        <?php
          }
        ?>
      </div> <!-- end of container -->
    </main> <!-- end of main tag -->
    <div class="text-center pt-2 pb-3 border border-left-0 border-right-0 border-bottom-0">
      <!-- <img src="./assets/images/pea-logo.png" width="150" class="pt-2 d-inline-block align-top"><br> -->
      <span class="text-muted font-weight-bold">PEA 4.0 - Digital Utility</span><br/>
      <span class="text-muted">พัฒนาโดย สายงานการไฟฟ้า ภาค 4</span>
    </div>
  </body>
</html>