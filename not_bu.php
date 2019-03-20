<div class="row">
  <!-- <h6 class="p-3 font-weight-bold pt-3 rounded-pill bg-primary text-white"> -->
  <h4 class="p-3 font-weight-bold">
    <i class="fas fa-search"></i> ลูกค้าไม่มีประวัติธุรกิจเสริม
  </h4>
  <!-- </h6> -->
</div>
<div class="row">
  <div class="col-sm-12 col-md-12 col-lg-12">
    <table 
        data-toggle="table"
        data-pagination="true"
        data-pagination-v-align="both" 
        data-url="./api/datatable/not_bu_table.php"
        data-fixed-columns="true"
        data-search="true"
        data-sticky-header="true">
      <thead>
        <tr>
          
          <th data-field="CA" data-sortable="true">หมายเลข CA</th>
          <th data-field="CUSTOMER_NAME" data-sortable="true">ชื่อลูกค้า</th>
          <th data-formatter="operateFormatter" data-events="operateEvents" > รายละเอียด</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
