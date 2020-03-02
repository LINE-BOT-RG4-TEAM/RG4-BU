<div class="row">
  <div class="col-sm-12 col-md-12 col-lg-12">
    <h1 class="float-left font-weight-bold text-primary animated fadeIn">
      <i class="fas fa-user-check"></i> ตรวจสอบผู้ใช้ไฟที่ลงทะเบียน
    </h1>
    <table 
        data-toggle="table" 
        data-url="./api/datatable/fetch_register_users.php?office_type=branch" 
        data-fixed-columns="true"
        data-sticky-header="true"
        data-pagination-v-align="both"
        data-search="true"
        data-group-by="true"
        data-group-by-field="formatted_date"
        data-pagination="true">
      <thead>
        <tr>
          <th data-field="UserID" data-width="120" data-formatter="LINEProfileDisplayFormatter"><i class="fas fa-user-circle"></i> ผู้ใช้</th>
          <th data-field="CA" data-sortable="true" data-formatter="textCenterFormatter"><i class="fas fa-indent"></i> หมายเลขผู้ใช้ไฟ</th>
          <!-- <th data-field="BP" data-sortable="true" data-formatter="textCenterFormatter"><i class="fas fa-business-time"></i> หมายเลข BP</th> -->
          <th data-field="FullName"><i class="fas fa-user-tie"></i> ชื่อที่ลงทะเบียนผ่าน SmartBiz</th>
          <th data-field="CUSTOMER_NAME"><i class="fas fa-user-tie"></i> ชื่อลูกค้าจาก SAP</th>
          <th data-field="CA_TEL"> เบอร์โทร</th>
          <th data-field="CA_EMAIL"> อีเมล์</th>
          <!-- <th data-field="QUANTITY_PURCHASE" data-formatter="suffixQuantityTextCenterFormatter" data-sortable="true"><i class="fas fa-receipt"></i> จำนวนครั้ง</th> -->
          <!-- <th data-formatter="operateFormatter" data-events="operateEvents"><i class="fas fa-cogs"></i> จัดการ</th> -->
        </tr>
      </thead>
    </table>
  </div>
</div>