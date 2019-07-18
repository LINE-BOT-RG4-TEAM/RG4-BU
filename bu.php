<div class="row">
  <div class="col-sm-12 col-md-12 col-lg-12">
    <h2 class="float-left font-weight-bold text-primary">
      <i class="fas fa-search"></i> ลูกค้าธุรกิจเสริม
    </h2>
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
          
          <th data-field="CA" data-sortable="true"><i class="fas fa-indent"></i>หมายเลขผู้ใช้ไฟฟ้า (CA/Ref.No.1)</th>
          <th data-field="CUSTOMER_NAME" data-sortable="true"><i class="fas fa-user-tie"></i>ชื่อลูกค้า</th>
          <th data-field="num" data-sortable="true"><i class="fas fa-receipt"></i> จำนวนครั้งการซื้อธุรกิจเสริม</th>
          <th data-formatter="operateFormatter" data-events="operateEvents" > รายละเอียด</th>
        </tr>
      </thead>
    </table>
  </div>
</div>