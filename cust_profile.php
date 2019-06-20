<div class="row">
  <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
    <a href="?action=liff_service" class="float-left btn btn-outline-primary text-primary">
        <i class="fas fa-arrow-left"></i> เลือกสินค้า
    </a>
  </div>
</div>
<div class="row mt-2">
  <div class="col-sm-12 col-md-12">
    <div class="card">
      <div class="card-body">
        <form>
          <div class="form-group text-center">
            <h4 class="font-weight-bold text-primary">
              <i class="fas fa-user-edit"></i> 
              แก้ไขข้อมูลส่วนตัว
            </h4>
            <h5 class="mt-2 font-weight-bold text-center" id="LINEDisplayName" name="LINEDisplayName">
              ....
            </h5>
          </div>
          <div class="form-group text-center">
            <img id="profileImage" class="shadow-sm" style="width:100px;height:100px;border-radius:50px 50px;"/>
            <input type="hidden" id="userIdHidden" name="userIdHidden">
          </div>
          <div class="form-group">
            <label for="ca_txt" class="font-weight-bold">หมายเลข CA</label>
            <input type="number" class="form-control disabled" id="ca_txt" name="ca_txt" size="12" readonly>
            <input type="hidden" id="ca_hidden" name="ca_hidden" />
          </div>
          <div class="form-group">
            <label for="fullName_txt" class="font-weight-bold">ชื่อ - นามสกุล</label>
            <input type="text" class="form-control" id="fullName_txt" name="fullName_txt" required>
            <input type="hidden" id="fullName_hidden" name="fullName_hidden" />
          </div>
          <div class="form-group">
            <label for="caTel_txt" class="font-weight-bold">เบอร์โทรศัพท์</label>
            <input type="text" class="form-control" id="caTel_txt" name="caTel_txt" required>
            <input type="hidden" id="caTel_hidden" name="caTel_hidden" />
          </div>
          <div class="form-group">
            <label for="caEmail_txt" class="font-weight-bold">Email</label>
            <input type="text" class="form-control" id="caEmail_txt" name="caEmail_txt" required>
            <input type="hidden" id="caEmail_hidden" name="caEmail_hidden" />
          </div>
          <button type="submit" class="btn btn-primary">แก้ไขข้อมูล</button>
        </form>
      </div>
    </div>
  </div>
</div>