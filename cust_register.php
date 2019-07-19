<div class="row">
  <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
    <h4 class="font-weight-bold text-center">
      ลงทะเบียนการใช้บริการธุรกิจเสริมการไฟฟ้าผ่านแอพพลิเคชั่น LINE
    </h4>
  </div>
</div>
<div class="row mt-2">
  <div class="col-sm-12 col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
        </div>
        <form>
          <div class="form-group text-center">
            <h4 class="font-weight-bold">ยินดีต้อนรับ<br/><div id="uNameInput"></div></h4>
            <img id="profileImage" class="shadow-sm" style="width:100px;height:100px;border-radius:50px 50px;"/>
            <input type="hidden" id="uIdInput" name="uIdInput">
          </div>
          <div class="form-group">
            <label for="caInput" class="font-weight-bold"><i class="fas fa-asterisk"></i> หมายเลขผู้ใช้ไฟฟ้า (CA/Ref.No.1)</label>
            <input type="number" class="form-control" id="caInput" name="caInput" placeholder="กรอกหมายเลขผู้ใช้ไฟฟ้าของท่าน" size="12" required>
          </div>
          <div class="form-group">
            <label for="nameInput" class="font-weight-bold"><i class="fas fa-user-edit"></i> ชื่อ - นามสกุล</label>
            <input type="text" class="form-control" id="nameInput" name="nameInput" placeholder="ชื่อ - นามสกุลของท่าน" required>
          </div>
          <div class="form-group">
            <label for="telInput" class="font-weight-bold"><i class="fas fa-mobile-alt"></i> เบอร์โทรศัพท์</label>
            <input type="text" class="form-control" id="telInput" name="telInput" placeholder="กรอกเบอร์โทรศัพท์ สำหรับติดต่อกลับ" required>
          </div>
          <div class="form-group">
            <label for="emailInput" class="font-weight-bold"><i class="fas fa-at"></i> Email</label>
            <input type="text" class="form-control" id="emailInput" name="emailInput" placeholder="ระบุ Email ของท่านเพื่อรับการแจ้งเตือน" required>
          </div>
          <button type="submit" class="btn btn-primary">ส่งข้อมูล</button>
        </form>
      </div>
    </div>
  </div>
</div>