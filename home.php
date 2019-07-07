<div class="row pl-3">
  <h2 class="font-weight-bold">
    <i class="fas fa-user-friends"></i> ข้อมูลทั่วไปของระบบ
  </h2>
</div>

<div class="row">
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
    <div class="card mt-2 mt-2">
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

<!-- <div class="dropdown-divider"></div> -->