<div class="row">
  <!-- <h6 class="p-3 font-weight-bold pt-3 rounded-pill bg-primary text-white"> -->
  <h4 class="p-3 font-weight-bold">
    <i class="fas fa-search"></i> ลูกค้าธุรกิจเสริม
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
      data-page-list="[5, 10, 20, 100, ALL]"
      data-url="./api/datatable/bu_table.php">
      <thead>
        <tr>
          
          <th data-field="CA" data-sortable="true"><i class="fas fa-indent"></i>หมายเลข CA</th>
          <th data-field="CUSTOMER_NAME" data-sortable="true"><i class="fas fa-user-tie"></i>ชื่อลูกค้า</th>
          <th data-field="num" data-sortable="true"><i class="fas fa-receipt"></i> จำนวนครั้งการซื้อธุรกิจเสริม</th>
          <th data-formatter="operateFormatter" data-events="operateEvents" > รายละเอียด</th>
        </tr>
      </thead>
    </table>
  </div>
</div>