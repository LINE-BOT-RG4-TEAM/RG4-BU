<h2 class="font-roboto font-weight-bold text-success"><i class="far fa-bell"></i> บริการแจ้งเตือนสำหรับพนักงาน</h2>
<p class="text-secondary">สมัครหรือจัดการข้อมูลของผู้รับข้อมูลการเปลี่ยนแปลงการใช้งานแอพพลิเคชั่น PEA SmartBiz ผ่าน LINE Notify</p>
<!-- <div class="text-left">
    <button type="button" id="" href="javascript:void(0);" onclick="requestForAuthentication();" class="btn btn-success"><i class="fas fa-bell"></i> ลงทะเบียนรับการแจ้งเตือน</button>
    <div class="float-right my-2">
        <p class="text-secondary"><i class="far fa-id-badge"></i> จำนวน 5 คน จาก 10 คน</p>
    </div>
</div> -->
<div class="dropdown-divider w-75"></div>
<div class="col">
    <div class="row">
        <h3 class="font-weight-bold">1. เลือกรูปแบบผู้รับการแจ้งเตือน</h3>
    </div>
    <div class="row">
        <p class="text-secondary">เลือกรูปแบบเป้าหมายในการรับการแจ้งเตือนแบ่งเป็นสองรูปแบบ ดังนี้</p>
    </div>
    <div class="row">
        <div class="col-sm-12 ml-5">
            <div class="form-check">
                <input class="form-check-input position-static" type="radio" name="notifyType" id="LINE_USER" value="user" aria-describedby="line_user_help" checked>
                <label for="LINE_USER"><i class="fas fa-user"></i> แบบรายบุคคล (User)</label>
                <small id="line_user_help" class="text-muted">
                    - การแจ้งเตือนรายบุคคลต้องกรอกรหัสประจำตัวพนักงาน
                </small>
                <div class="row ml-3">
                    <input type="number" class="col-3 form-control" id="employee_code" name="employee_code" placeholder="รหัสประจำตัวพนักงานผู้รับการแจ้งเตือน" required />
                </div>
            </div>
            <div class="form-check mt-2">
                <input class="form-check-input position-static" type="radio" name="notifyType" id="LINE_GROUP" value="group">
                <label for="LINE_GROUP"><i class="fas fa-users"></i> แบบกลุ่ม (Group)</label>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <h3 class="font-weight-bold">2. กดปุ่มสร้างลิงก์</h3>
    </div>
    <div class="row">
        <p class="text-secondary">เมื่อสร้างลิงก์สำเร็จ ให้ท่านนำลิงก์ดังกล่าวส่งไปยังผู้ที่ต้องการได้รับการแจ้งเตือนผ่านแอพพลิเคชั่น LINE</p>
    </div>
    <div class="row">
        <div class="mx-5 input-group">
            <input type="hidden" name="pea_code" id="pea_code" value="<?=$_SESSION['pea_code']?>" />
            <input type="text" class="form-control" id="authorize_uri" name="authorize_uri" placeholder="ลิงก์สำหรับลงทะเบียน" aria-describedby="button-addon" disabled>
            <div class="input-group-append" id="button-addon">
                <button class="btn btn-primary" type="button" id="create_link">สร้างลิงก์</button>
                <button class="btn btn-outline-secondary disabled" type="button" id="copy_link">คัดลอกลิงก์</button>
            </div>
        </div>
    </div>
</div>
<div class="dropdown-divider w-100 mt-3"></div>
<div class="col-12">
    <div class="row mt-2">
        <h2 class="font-weight-bold text-success">พนักงานรับการแจ้งเตือนผ่าน LINE Notify</h2>
    </div>
    <div class="row">
        <div class="col-12">
            <table 
                data-toggle="table" 
                data-url="./api/datatable/fetch_register_from_line_notify.php?pea_code=<?=$_SESSION['pea_code']?>" 
                data-fixed-columns="true"
                data-sticky-header="true"
                data-pagination="true">
                <thead>
                    <tr>
                    <!-- <th data-field="INDEX">#</th> -->
                    <th data-field="notifyType" data-sortable="true" data-formatter="textCenterFormatter"><i class="fas fa-indent"></i> ประเภทผู้รับ</th>
                    <th data-field="receviedName" data-sortable="true" data-formatter="textCenterFormatter"><i class="fas fa-business-time"></i> ชื่อผู้รับ/ชื่อกลุ่ม</th>
                    <th data-field="access_token"><i class="fas fa-user-tie"></i> access token</th>
                    <!-- <th data-field="QUANTITY_PURCHASE" data-formatter="suffixQuantityTextCenterFormatter" data-sortable="true"><i class="fas fa-receipt"></i> จำนวนครั้ง</th> -->
                    <th data-formatter="operateFormatter"><i class="fas fa-cogs"></i> จัดการ</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- <form class="form-inline">
    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">กรุณากำหนดเงื่อนไขดังต่อไปนี้</label>
    <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
        <option selected>Choose...</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
    </select>
</form> -->
