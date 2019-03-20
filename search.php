<div class="row">
  <!-- <h6 class="p-3 font-weight-bold pt-3 rounded-pill bg-primary text-white"> -->
  <h4 class="p-3 font-weight-bold">
    <i class="fas fa-search"></i> ค้นหาข้อมูลลูกค้ารายสำคัญ
  </h4>
  <!-- </h6> -->
</div>
<div class="row">
  <div class="col-sm-12 col-md-12 col-lg-12">
    <table 
        data-toggle="table" 
        data-url="./api/datatable/fetch_ca_automatic.php" 
        data-fixed-columns="true"
        data-sticky-header="true">
      <thead>
        <tr>
          <th>#</th>
          <th data-field="CA" data-sortable="true" data-formatter="textCenterFormatter"><i class="fas fa-indent"></i> หมายเลข CA</th>
          <th data-field="BP" data-sortable="true" data-formatter="textCenterFormatter"><i class="fas fa-business-time"></i> หมายเลข BP</th>
          <th data-field="BP_NAME"><i class="fas fa-user-tie"></i> ชื่อ BP</th>
          <th data-field="QUANTITY_PURCHASE" data-formatter="suffixQuantityTextCenterFormatter" data-sortable="true"><i class="fas fa-receipt"></i> จำนวนครั้ง</th>
          <th data-formatter="operateFormatter" data-events="operateEvents"><i class="fas fa-cogs"></i> จัดการ</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

<!-- <div class="dropdown-divider"></div> -->