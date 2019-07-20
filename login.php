<?php session_start(); ?>
<?php require('./utils/array_utils.php'); ?>
<?php require('./utils/db_connector.php'); ?>
<?php 
  if(!empty($_SESSION['username'])) {
    header("Location: index.php?action=home");
  }
?>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script>
      window.onload = function(){
        document.getElementsByTagName('form')[0].addEventListener('submit', function(e){
          $.blockUI({
            fadeIn: 1000,
            message:'<div class="font-weight-bold text-primary" style="font-size:26px">กำลังตรวจสอบข้อมูล...</div>'
          });
        });
      };
    </script>
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
          <span class="navbar-text font-roboto font-weight-bold">
            PEA SmartBiz
          </span>
        </div>
      </nav>
    </header>
    <main class="mb-3">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 offset-md-4 col-md-6 offset-lg-4 col-lg-4 offset-xl-4 col-xl-4">
            <div class="card border mb-3 shadow">
                <div class="card-body mx-2">
                    <div class="text-center">
                        <img class="img-fluid" src="./assets/images/pea-logo-purple.png" style="max-width:130px"/>
                    </div>
                    <h5 class="text-center card-title font-weight-bold mt-2">เข้าระบบจัดการข้อมูลฐานลูกค้าฯ</h5>
                    <hr />
                    <form method="POST" action="#!" autocomplete="off">
                        <?php 
                            if($_POST){
                                $username = $_POST['username_txt'];
                                $verify_user_sql = "
                                    SELECT username, password, users.pea_code, office.PEA_NAME, role
                                    FROM users
                                      JOIN office ON users.pea_code = office.PEA_CODE
                                    WHERE username = '{$username}' AND status = 'A'
                                ";
                                $results = $conn->query($verify_user_sql);
                                if(mysqli_num_rows($results) < 1){
                        ?>
                        <div class="form-group">
                            <div class="alert alert-danger" role="alert">
                                ชื่อผู้ใช้ หรือรหัสผ่านไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง
                            </div>
                        </div>
                        <?php
                                } else {
                                    $row = $results->fetch_assoc();
                                    $hash_password = $_POST['password_txt'];
                                    $input_password = $row['password'];
                                    if($hash_password === $input_password){
                                        $_SESSION['username'] = $row['username'];
                                        $_SESSION['pea_code'] = $row['pea_code'];
                                        $_SESSION['pea_name'] = $row['PEA_NAME'];
                                        $_SESSION['role'] = $row['role'];
                                        $_SESSION['loggedin_time'] = time();  
                                        ?>
                                            <script>
                                                Swal.fire({
                                                    type: 'success',
                                                    title: 'ยืนยันข้อมูลถูกต้อง',
                                                    text: 'กำลังนำท่านเข้าสู่ระบบ...',
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                }).then(function(){
                                                    window.location.href = 'index.php?action=home';
                                                });
                                            </script>
                                        <?php
                                    }else{
                                        ?>
                                        <div class="form-group">
                                            <div class="alert alert-danger" role="alert">
                                                รหัสผ่านไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                        ?>
                        <div class="form-group">
                            <label for="username_txt" class="font-weight-bold"><i class="fas fa-user-shield"></i> ชื่อผู้ใช้</label>
                            <input type="text" class="form-control" id="username_txt" name="username_txt" aria-describedby="username-help" placeholder="กรอกชื่อผู้ใช้" value="<?=isset($_POST['username_txt'])?$_POST['username_txt']:""?>" required>
                            <small id="username-help" class="form-text text-muted">ติดต่อผู้พัฒนาเพื่อร้องขอชื่อผู้ใช้ได้</small>
                        </div>
                        <div class="form-group">
                            <label for="password_txt" class="font-weight-bold"><i class="fas fa-key"></i> รหัสผ่าน</label>
                            <input type="password" class="form-control" id="password_txt" name="password_txt" placeholder="รหัสผ่านที่ท่านได้รับ" required>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> เข้าระบบ</button>
                    </form>
                </div>
            </div>
          </div>
        </div> <!-- end of row's class tag -->
      </div> <!-- end of container -->
    </main> <!-- end of main tag -->
  </body>
</html>