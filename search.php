<div class="row">
  <div class="col-sm-12 col-md-12 col-lg-12">
    <h1 class="float-left font-weight-bold text-primary animated fadeIn">
      <i class="fas fa-search"></i> ค้นหาข้อมูลลูกค้า
    </h1>
    <table 
        data-toggle="table" 
        data-url="./api/datatable/fetch_ca_automatic.php" 
        data-fixed-columns="true"
        data-sticky-header="true"
        data-pagination-v-align="both"
        data-search="true"
        data-pagination="true">
      <thead>
        <tr>
          <th data-field="CA" data-sortable="true" data-formatter="textCenterFormatter"><i class="fas fa-indent"></i> หมายเลขผู้ใช้ไฟฟ้า (CA)</th>
          <th data-field="BP" data-sortable="true" data-formatter="textCenterFormatter"><i class="fas fa-business-time"></i> หมายเลข BP</th>
          <th data-field="BP_NAME"><i class="fas fa-user-tie"></i> ชื่อ BP</th>
          <th data-field="QUANTITY_PURCHASE" data-formatter="suffixQuantityTextCenterFormatter" data-sortable="true"><i class="fas fa-receipt"></i> จำนวนครั้ง</th>
          <th data-formatter="operateFormatter" data-events="operateEvents"><i class="fas fa-cogs"></i> จัดการ</th>
        </tr>
      </thead>
    </table>
  </div>
</div>