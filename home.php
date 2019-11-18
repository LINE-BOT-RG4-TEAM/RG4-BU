<div class="row pl-3">
  <h2 class="font-weight-bold">
    <i class="fas fa-user-friends"></i> ข้อมูลทั่วไปของระบบ
  </h2>
</div>

<div class="row quantity_jobs_area">
  <div class="col-sm-12 col-md-6 col-lg-4">
    <div class="card mt-2 mt-2">
      <div class="card-body">
        <p class="card-text float-right text-success font-weight-bold" 
          style="font-size:24px;" id="high_value_card">
          ...
        </p>
        <h5 class="card-title"><i class="fas fa-star"></i> ลูกค้ารายสำคัญ</h5>
        <a href="?action=high_value" class="btn btn-outline-success">รายละเอียด</a>
      </div>
    </div>
  </div>
  <div class="col-sm-12 col-md-6 col-lg-4">
    <div class="card mt-2 mt-2">
      <div class="card-body">
        <p class="card-text float-right text-dark font-weight-bold" 
          style="font-size:24px;" id="bu_card">
          ...
        </p>
        <h5 class="card-title"><i class="fas fa-hands-helping"></i> ลูกค้าธุรกิจเสริม</h5>
        <a href="?action=bu" class="btn btn-outline-dark">รายละเอียด</a>
      </div>
    </div>
  </div>
  <div class="col-sm-12 col-md-6 col-lg-4">
    <div class="card mt-2 mt-2">
      <div class="card-body">
        <p class="card-text float-right text-danger font-weight-bold" 
          style="font-size:24px;" id="not_bu_card">
          ...
        </p>
        <h5 class="card-title">ลูกค้าไม่มีธุรกิจเสริม</h5>
        <a href="?action=not_bu" class="btn btn-outline-danger">รายละเอียด</a>
      </div>
    </div>
  </div>
</div>

<div class="row mt-2">
  <div class="col-sm-12 col-md-6 col-lg-12">
    <div class="card mt-2">
      <div class="card-header">
				<span class="my-0 font-weight-bold text-primary" style="font-size:20px;">กราฟแสดงจำนวนลูกค้าที่ครบกำหนดบำรุงรักษา  <span id="month_name"></span> </span>
        <div class="float-right">
        <div class="dropdown d-inline-block sub-criteria">
          <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            รูปแบบการแสดงผล
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#" onclick="graph_month()">รายเดือน</a>
            <a class="dropdown-item" href="#" onclick="graph_quater()">รายไตรมาส</a>
          </div>
        </div>
        </div>
			</div>
      <div class="card-body" id="chartarea">
        <canvas id="myChart" style="height:40vh; width:70vw"></canvas>
      </div>
    </div>
  </div>
</div>
<div class="row mt-2">
  <?php if(substr($_SESSION["pea_code"], -5) == "00000"){ ?>
    <div class="col-sm-12 col-md-12 col-lg-12 mt-2">
      <h3>งานบำรุงรักษาครบกำหนดบำรุงรักษาอีก 3 เดือนนับจากวันนี้</h3>
      <table 
        data-toggle="table" 
        data-url="./api/datatable/summary_maintenance_3_month.php" 
        data-fixed-columns="true"
        data-group-by="true"
        data-group-by-field="office_name"
        data-sticky-header="true">
        <thead>
          <tr>
            <th data-align="center" data-field="CA" data-formatter="caFormatter">หมายเลขผู้ใช้ไฟ</th>
            <th data-align="center" data-field="CUSTOMER_NAME">ชื่อผู้ใช้ไฟฟ้า</th>
            <th data-align="center" data-field="due_date" data-formatter="dateThaiFormatter"><i class="far fa-calendar-alt"></i> วันที่ครบกำหนด</th>
            <th data-align="center" data-field="CODE_EXPLAIN">รายการการดำเนินการ</th>
            <th data-align="center" data-field="PAYMENT">ค่าใช้จ่ายครั้งก่อน</th>
          </tr>
        </thead>
      </table>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 mt-2">
      <h3>งานบำรุงรักษาที่ครบกำหนดบำรุงรักษาของวันนี้</h3>
      <table 
        data-toggle="table" 
        data-url="./api/datatable/summary_maintenance_today.php" 
        data-fixed-columns="true"
        data-group-by="true"
        data-group-by-field="office_name"
        data-sticky-header="true">
        <thead>
          <tr>
            <th data-align="center" data-field="CA" data-formatter="caFormatter">หมายเลขผู้ใช้ไฟ</th>
            <th data-align="center" data-field="CUSTOMER_NAME">ชื่อผู้ใช้ไฟฟ้า</th>
            <th data-align="center" data-field="CODE_EXPLAIN">รายการการดำเนินการ</th>
            <th data-align="center" data-field="PAYMENT">ค่าใช้จ่ายครั้งก่อน</th>
          </tr>
        </thead>
      </table>
    </div>
  <?php } else { ?>
    <div class="col-sm-12 col-md-12 col-lg-12 mt-2">
      <h3>งานบำรุงรักษาครบกำหนดบำรุงรักษาอีก 3 เดือนนับจากวันนี้</h3>
      <table 
        data-toggle="table" 
        data-url="./api/datatable/summary_maintenance_3_month.php" 
        data-fixed-columns="true"
        data-group-by="true"
        data-group-by-field="CA"
        data-group-by-formatter="caGroupByFormatter"
        data-sticky-header="true">
        <thead>
          <tr>
            <th data-align="center" data-field="CA" data-formatter="caFormatter">หมายเลขผู้ใช้ไฟ</th>
            <th data-align="center" data-field="CUSTOMER_NAME">ชื่อผู้ใช้ไฟฟ้า</th>
            <th data-align="center" data-field="due_date" data-formatter="dateThaiFormatter"><i class="far fa-calendar-alt"></i> วันที่ครบกำหนด</th>
            <th data-align="center" data-field="CODE_EXPLAIN">รายการการดำเนินการ</th>
            <th data-align="center" data-field="PAYMENT">ค่าใช้จ่ายครั้งก่อน</th>
          </tr>
        </thead>
      </table>
    </div>
    <div class="col-sm-12 col-md-5 col-lg-5 mt-2">
      <div class="card h-100">
        <div class="card-header">
          <span class="my-0 font-weight-bold text-primary" style="font-size:16px;">
            งานบำรุงรักษาที่ครบกำหนดบำรุงรักษาในรอบ 3 วัน (เมื่อวาน, วันนี้ และพรุ่งนี้)
          </span>
        </div>
        <div class="card-body">
          <table 
            data-toggle="table" 
            data-url="./api/datatable/summary_maintenance_3_days.php" 
            data-fixed-columns="true"
            data-sticky-header="true">
            <thead>
              <tr>
                <th data-align="center" data-field="str_date" data-formatter="thaiDateFormatter"><i class="far fa-calendar-alt"></i> วันที่</th>
                <th data-align="center" data-field="count"><i class="far fa-calendar-alt"></i> จำนวนงานที่ครบกำหนด</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
    <div class="col-sm-12 col-md-7 col-lg-7 mt-2">
      <div class="card h-100">
        <div class="card-header">
          <span class="my-0 font-weight-bold text-primary" style="font-size:20px;">
            งานบำรุงรักษาที่ครบกำหนดบำรุงรักษาของวันนี้
          </span>
        </div>
        <div class="card-body">
          <table 
            data-toggle="table" 
            data-url="./api/datatable/summary_maintenance_today.php" 
            data-fixed-columns="true"
            data-pagination="true"
            data-sticky-header="true">
            <thead>
              <tr>
                <th data-align="center" data-field="CA" data-formatter="caFormatter">รหัสผู้ใช้ไฟฟ้า</th>
                <th data-align="center" data-field="CUSTOMER_NAME">ชื่อผู้ใช้ไฟฟ้า</th>
                <th data-align="center" data-field="CODE_EXPLAIN">รายการการดำเนินการ</th>
                <th data-align="center" data-field="PAYMENT">ค่าใช้จ่ายครั้งก่อน</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
    <script>

      function caGroupByFormatter(value, index, row){
          return "<b>หมายเลขผู้ใช้ไฟ: "+value+"</b>";
      }

      function isSameDay(firstDate, secondDate){
        return firstDate.getDate() === secondDate.getDate() && firstDate.getMonth() === secondDate.getMonth() && firstDate.getFullYear() === secondDate.getFullYear();
      }

      function getDateDesc(dateParameter) {
        var today = new Date();
        var isToday = isSameDay(today, dateParameter);
        
        // check is 
        var yesterday = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 1);
        // var yesterday = new Date(today);
        var isYesterday = isSameDay(yesterday, dateParameter);

        var tomorrow = new Date(today.getFullYear(), today.getMonth(), today.getDate() + 1);
        var isTomorrow = isSameDay(tomorrow, dateParameter);

        if(isToday) return "วันนี้";
        else if(isYesterday) return "เมื่อวานนี้";
        else if(isTomorrow) return "วันพรุ่งนี้";
      }

      function thaiDateFormatter(value, row){
        var monthNamesThai = ["ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.",
        "ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค."];
        // var monthNamesThai = ["มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน",
        // "กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม"];

        var dayNames = ["วันอาทิตย์ที่","วันจันทร์ที่","วันอังคารที่","วันพุทธที่","วันพฤหัสบดีที่","วันศุกร์ที่","วันเสาร์ที่"];
        var dateObj = new Date(value);

        var plain_format = "วันที่ "+dateObj.getDate()+" "+monthNamesThai[dateObj.getMonth()] + " " + (dateObj.getFullYear() + 543) + "<br/>("+getDateDesc(dateObj)+")";
        // var plain_format = dayNames[dateObj.getDay()]+" "+dateObj.getDay()+" "+monthNamesThai[dateObj.getMonth()] + " " + (dateObj.getFullYear() + 543) + "("+getDateDesc(dateObj)+")";
        return plain_format;
      }
    </script>
  <?php } ?>
</div>

<div class="row mt-2">
  <div class="col-sm-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="card-header">
        <span class="my-0 font-weight-bold text-primary" style="font-size:20px;">
          ตารางแสดงจำนวนงานครบกำหนดบำรุงรักษารายเดือน
          <div class="float-right text-secondary">ตารางแสดงแยกเป็นรหัส S301, S302, S303, S304 และ S305</div>
        </span>
      </div>
      <div class="card-body">
        <blockquote class="blockquote text-secondary text-center">
          <p style="font-size:20px">
            <span class="badge badge-primary">S301 - ขอซ่อมแซมอุปกรณ์ไฟฟ้า</span>
            <span class="badge badge-success">S302 - ขอตรวจสอบและบำรุงรักษาสวิตซ์เกีย</span>
            <span class="badge badge-danger">S303 - ขอตรวจสอบและบำรุงรักษาเคเบิล</span><br/>
            <span class="badge badge-info">S304 - ขอตรวจสอบและบำรุงรักษารีเลย์</span>
            <span class="badge badge-secondary">S305 - ขอบำรุงรักษาหม้อแปลงไฟฟ้า</span>
          </p>
        </blockquote>
        <table 
          data-toggle="table" 
          data-url="./api/datatable/summary_jobs_code_monthly.php" 
          data-fixed-columns="true"
          data-sticky-header="true"
          data-show-footer="true"
          data-pagination="false">
          <thead>
            <tr>
              <th data-formatter="buddistYearFormatter" data-align="center" data-field="year"><i class="far fa-calendar-alt"></i> ปี</th>
              <th data-formatter="monthThaiFormatter" data-align="center" data-field="month_name"><i class="far fa-calendar-alt"></i> เดือน</th>
              <th data-footer-formatter="summaryS301Formatter" data-formatter="quantityJobsS301Formatter" data-class="text-primary" data-align="right" data-field="S301"><i class="fas fa-plug"></i> รหัส S301</th>
              <th data-footer-formatter="summaryS302Formatter" data-formatter="quantityJobsS302Formatter" data-class="text-success" data-align="right" data-field="S302"><i class="fas fa-toggle-off"></i> รหัส S302</th>
              <th data-footer-formatter="summaryS303Formatter" data-formatter="quantityJobsS303Formatter" data-class="text-danger" data-align="right" data-field="S303">รหัส S303</th>
              <th data-footer-formatter="summaryS304Formatter" data-formatter="quantityJobsS304Formatter" data-class="text-info" data-align="right" data-field="S304">รหัส S304</th>
              <th data-footer-formatter="summaryS305Formatter" data-formatter="quantityJobsS305Formatter" data-class="text-secondary" data-align="right" data-field="S305">รหัส S305</th>
              <th data-formatter="monthlyFormatter" data-align="right" data-footer-formatter="grandSummaryFormatter">รวมตามเดือน</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
  <div class="col-sm-12 col-md-12 col-lg-12 mt-2">
    <div class="card">
      <div class="card-header">
        <span class="my-0 font-weight-bold text-primary" style="font-size:20px;">
          ตารางแสดงจำนวนงานครบกำหนดบำรุงรักษารายไตรมาส
        </span>
      </div>
      <div class="card-body">
        <table 
          data-toggle="table" 
          data-url="./api/datatable/summary_jobs_code_quarter.php" 
          data-fixed-columns="true"
          data-sticky-header="true"
          data-show-footer="true"
          data-pagination="false">
          <thead>
            <tr>
              <th data-formatter="buddistYearFormatter" data-align="center" data-field="year"><i class="far fa-calendar-alt"></i> ปี</th>
              <th data-align="center" data-field="quarter"><i class="far fa-calendar-alt"></i> ไตรมาสที่</th>
              <th data-footer-formatter="summaryS301Formatter" data-formatter="quantityJobsS301Formatter" data-class="text-primary" data-align="right" data-field="S301"><i class="fas fa-plug"></i> รหัส S301</th>
              <th data-footer-formatter="summaryS302Formatter" data-formatter="quantityJobsS302Formatter" data-class="text-success" data-align="right" data-field="S302"><i class="fas fa-toggle-off"></i> รหัส S302</th>
              <th data-footer-formatter="summaryS303Formatter" data-formatter="quantityJobsS303Formatter" data-class="text-danger" data-align="right" data-field="S303">รหัส S303</th>
              <th data-footer-formatter="summaryS304Formatter" data-formatter="quantityJobsS304Formatter" data-class="text-info" data-align="right" data-field="S304">รหัส S304</th>
              <th data-footer-formatter="summaryS305Formatter" data-formatter="quantityJobsS305Formatter" data-class="text-secondary" data-align="right" data-field="S305">รหัส S305</th>
              <th data-formatter="monthlyFormatter" data-align="right" data-footer-formatter="grandSummaryFormatter">รวมตามไตรมาส</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="jobsModalLgCenter" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalCenterTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table 
          id="modal_table"
          data-pagination="true"
          data-page-size="5"
          data-page-list="[5, 10, 20, 100, ALL]">
          <thead>
            <tr>
              <th data-field="BP">BP</th>
              <th data-field="CA" data-formatter="caFormatter">หมายเลขผู้ใช้ไฟ</th>
              <!-- <th data-field="invoice_date" data-formatter="dateThaiFormatter">วันชำระเงิน</th> -->
              <th data-field="next_due_date" data-formatter="dateThaiFormatter">ครบกำหนด</th>
              <th data-field="CUSTOMER_NAME">ชื่อลูกค้า</th>
              <th data-field="CODE_EXPLAIN">ดำเนินการ</th>
              <!-- <th data-field="PAYMENT">ค่าใช้จ่าย</th> -->
            </tr>
          </thead>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- <div class="dropdown-divider"></div> -->