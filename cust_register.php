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
            <h3 class="font-weight-bold">ยินดีต้อนรับ, คุณ<div id="uNameInput"></div></h3>
            <img id="profileImage" class="shadow-sm" style="width:100px;height:100px;border-radius:50px 50px;"/>
          </div>
          <div class="form-group">
            <label for="uIdInput" class="font-weight-bold">User ID</label>
            <input type="text" class="form-control" id="uIdInput" disabled readonly>
          </div>
          <div class="form-group">
            <label for="caInput" class="font-weight-bold">หมายเลข CA</label>
            <input type="number" class="form-control" id="caInput" aria-describedby="emailHelp" placeholder="กรอกหมายเลข CA ของท่าน" size="12" required>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group">
            <label for="nameInput">ชื่อ - นามสกุล</label>
            <input type="text" class="form-control" id="nameInput" placeholder="กรอกชื่อ - นามสกุลของท่าน" required>
          </div>
          <div class="form-group">
            <label for="telInput">เบอร์โทรศัพท์</label>
            <input type="text" class="form-control" id="telInput" placeholder="กรอกเบอร์โทรศัพท์" required>
          </div>
          <div class="form-group">
            <label for="emailInput">Email</label>
            <input type="text" class="form-control" id="emailInput" placeholder="ระบุ Email ของท่าน" required>
          </div>
          <button type="submit" class="btn btn-primary">ส่งข้อมูล</button>
        </form>
      </div>
    </div>
  </div>
</div>