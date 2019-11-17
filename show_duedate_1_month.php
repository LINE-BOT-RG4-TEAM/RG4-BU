<?php
    require("./utils/db_connector.php");
    require("./utils/date_utils.php");
    $ca = $_GET["ca"];
    $due_date = $_GET["due_date"];
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
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.14.2/dist/bootstrap-table.min.css">
    <link rel="stylesheet" href="./assets/css/bootstrap-table-sticky-header.css">
    <link href="https://unpkg.com/bootstrap-table@1.15.3/dist/extensions/group-by-v2/bootstrap-table-group-by.css" rel="stylesheet">
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
      <div class="container">
        <!-- <div class="col-12"> -->
            <div class="row mt-4">
                <div class="col-12">
                    <h2>รายการบำรุงรักษาที่ครบกำหนดในวันที่ <?=dateThai($due_date)?></h2>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <table 
                        data-toggle="table" 
                        data-url="./api/datatable/fetch_due_date_by_ca.php?ca=<?=$ca?>&due_date=<?=$due_date?>>" 
                        data-fixed-columns="true"
                        data-pagination="true"
                        data-sticky-header="true">
                        <thead>
                        <tr>
                            <th data-align="center" data-formatter="runningFormatter">No.</th>
                            <th data-align="center" data-field="CODE_EXPLAIN">รายการที่ดำเนินการ</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- <div class="row mt-4">
                <div class="col-12">
                    <div class="alert alert-primary" role="alert">
                        คุณลูกค้าสามารถติดต่อพนักงานเพื่อสอบถามข้อมูลเกี่ยวกับบริการจาก PEA ได้
                    </div>
                </div>
            </div> -->
        <!-- </div> -->
      </div>
      <script>
        function runningFormatter(value, row, index){
            return index + 1;
        }
      </script>
    <script src="./assets/js/jquery-3.3.1.min.js"></script>
    <script src="./assets/js/notify.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.14.2/dist/bootstrap-table.min.js"></script>

    <script src="./scripts/global.js"></script>
    <!-- datepicker -->
    <script src="./assets/js/jquery.blockUI.js"></script>
    <script src="./assets/js/Chart.min.js"></script>
  </body>
</html>