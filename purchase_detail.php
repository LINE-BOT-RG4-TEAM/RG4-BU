<div class="row">
  <div class="col-sm-12 col-md-12 col-lg-8 offset-xl-1 col-xl-5">
    <div style="height: 20%"></div>
    <div style="height: 40%">
      <h1 style="font-family: Roboto;" class="text-sm-center text-md-center text-lg-center text-xl-right font-weight-bold">PEA SmartBiz</h1>
      <p style="font-family: Roboto;" class="text-muted text-sm-center text-md-center text-lg-center text-xl-right text-grey">Shop a PEA service with our best service</p>
    </div>
  </div>
  <div class="col-sm-12 col-md-12 col-lg-4 col-xl-6">
    <img class="d-none d-lg-block h-75" src="https://marketplace-cdn.atlassian.com/s/public/AppsMirror-1-052ef62a1badc10cb07e1acb207ac2d1.svg" alt="">
  </div>
</div>
<div class="row mt-3 ml-1">
  <h6 class="p-3 font-weight-bold pt-3 rounded-pill bg-primary text-white">
    <i class="fas fa-table"></i> รายละเอียดใบสั่งซื้อเลขที่  <span id="purchase_id"></span><span id="edit_status"></span>
  </h6>
</div>
<div class="row">
  <div class="col-sm-12 col-md-6 col-lg-4 mt-3">
  <form action="checkout-success.php" method="post">
    <input type="hidden" id="purchase_id_hid" name="purchase_id"/>
    <ul class="list-group list-group-flush" id="fetch_area">
      <li  class="list-group-item">
        <div class="text-center">
          <label class="font-weight-bold text-primary bg-light py-2 px-5 shadow-sm" style="font-size:22px;border-radius: 20px;">
            <i class="fas fa-check"></i>
              บริการที่ 
          </label>
        </div>
        <p style="font-size:20px;">
          <span class='font-weight-bold text-success'>
              <i class="far fa-handshake"></i> บริการ:
          </span> 
          <span class="pl-1">
            ตรวจสอบหาจุดร้อน
          </span>
        </p>
        <p style="font-size:20px;">
            <span class='font-weight-bold text-secondary'>
                <i class="fas fa-comment-dots"></i> ความต้องการเพิ่มเติม:
            </span> 
            <br/>
            <span class="pl-4">
              <textarea class="form-control" rows="5" id="des" name = "des" disabled></textarea>
            </span>
            <p class="font-weight-bold" style="font-size:20px;">
              <i class="far fa-calendar-alt"></i> นัดหมายวันรับบริการ:
            </p>
            <p>
              <input class="form-control text-center datepicker" 
                style="font-size:22px;"
                placeholder="เลือกวันนัดหมาย" 
                type="date" disabled name="date_input"/>
            </p>
        </p>
      </li>
      <li  class="list-group-item">
        <div class="text-center">
          <label class="font-weight-bold text-primary bg-light py-2 px-5 shadow-sm" style="font-size:22px;border-radius: 20px;">
            <i class="fas fa-check"></i>
              บริการที่ 
          </label>
        </div>
        <p style="font-size:20px;">
          <span class='font-weight-bold text-success'>
              <i class="far fa-handshake"></i> บริการ:
          </span> 
          <span class="pl-1">
            ตรวจสอบหาจุดร้อน
          </span>
        </p>
        <p style="font-size:20px;">
            <span class='font-weight-bold text-secondary'>
                <i class="fas fa-comment-dots"></i> ความต้องการเพิ่มเติม:
            </span> 
            <br/>
            <span class="pl-4">
              <textarea class="form-control" rows="5" id="des" name = "des" disabled></textarea>
            </span>
            <p class="font-weight-bold" style="font-size:20px;">
              <i class="far fa-calendar-alt"></i> นัดหมายวันรับบริการ:
            </p>
            <p>
              <input class="form-control text-center datepicker" 
                style="font-size:22px;"
                placeholder="เลือกวันนัดหมาย" 
                type="date" disabled name="date_input"/>
            </p>
        </p>
      </li>
    </ul>
  <!-- </div> -->
    <div class="col-sm-12 col-md-6 col-lg-4 text-center mt-3">
      <a href="#" id="btn_select_more" class="btn btn-lg btn-success">เลือกสินค้าเพิ่ม</a>
      <button type="button"  class="btn btn-lg btn-success" id="edit_btn" value="edit">แก้ไข</button>
    </div>
  </form>
  </div>
<!-- </div> -->
