<div class="row">
  <h6 class="p-3 font-weight-bold pt-3 rounded-pill bg-primary text-white">
    <i class="fas fa-table"></i> ข้อมูลภาพรวมของระบบ
  </h6>
</div>

<div class="row">
  <div class="col-sm-12 col-md-6 col-lg-12">
    <div class="card mt-2 mt-2">
      <div class="card-header">
				<span class="my-0 font-weight-bold text-primary" style="font-size:20px;">กราฟแสดงจำนวนลูกค้าที่ครบกำหนดบำรุงรักษา  <span id="month_name"></span> </span>
        <div class="float-right">
        <div class="dropdown d-inline-block">
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

<!-- <div class="dropdown-divider"></div> -->
<div class="row">
  <div class="col-sm-12 col-md-6 col-lg-4">
    <div class="card mt-2 mt-2">
      <div class="card-body">
        <h5 class="card-title">ลูกค้ารายสำคัญ</h5>
        <p class="card-text" id="high_value_card"></p>
        <a href="?action=high_value" class="btn btn-primary">รายละเอียด</a>
      </div>
    </div>
  </div>
  <div class="col-sm-12 col-md-6 col-lg-4">
    <div class="card mt-2 mt-2">
      <div class="card-body">
        <h5 class="card-title">ลูกค้าธุรกิจเสริม</h5>
        <p class="card-text" id="bu_card"></p>
        <a href="?action=bu" class="btn btn-primary">รายละเอียด</a>
      </div>
    </div>
  </div>
  <div class="col-sm-12 col-md-6 col-lg-4">
    <div class="card mt-2 mt-2">
      <div class="card-body">
        <h5 class="card-title">ลูกค้าไม่มีธุรกิจเสริม</h5>
        <p class="card-text" id="not_bu_card"></p>
        <a href="?action=not_bu" class="btn btn-primary">รายละเอียด</a>
      </div>
    </div>
  </div>
</div>