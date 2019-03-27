<div class="row">
  <!-- <h6 class="p-3 font-weight-bold pt-3 rounded-pill bg-primary text-white"> -->
  <h4 class="p-3 font-weight-bold" id="high_value_text">
    <i class="fas fa-search"></i> ลูกค้ารายสำคัญ
  </h4>
  <!-- </h6> -->
</div>
<div class="row">
  <div class="col-sm-12 col-md-12 col-lg-12">
    <table 
        data-toggle="table"
        data-pagination="true"
        data-pagination-v-align="both" 
        data-fixed-columns="true"
        data-sticky-header="true"
        data-search="true"
        data-url="./api/datatable/high_value_table.php">
      <thead>
        <tr>
        <th data-field="Ca1" data-sortable="true"><i class="fas fa-indent"></i>หมายเลข CA</th>
          <th data-field="CUSTOMER_NAME" data-sortable="true"><i class="fas fa-user-tie"></i>ชื่อลูกค้า</th>
          <th data-field="HML_Type" data-sortable="true"><i class="fas fa-receipt"></i> HML_TYPE</th>
          <th data-field="4S" data-sortable="true"><i class="fas fa-receipt"></i>KAM_TYPE </th>
          <th data-field="KAMR" data-sortable="true"><i class="fas fa-receipt"></i>ผู้ดูแล </th>
          <th data-formatter="operateFormatter" data-events="operateEvents" > รายละเอียด</th>
        </tr>
      </thead>
    </table>
  </div>
</div>