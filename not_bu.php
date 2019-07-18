<div class="row">
  <div class="col-sm-12 col-md-12 col-lg-12">
    <h4 class="pt-3 font-weight-bold float-left">
      <i class="fas fa-search"></i> ลูกค้าไม่มีประวัติธุรกิจเสริม
    </h4>
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
          <th data-field="CA" data-sortable="true">หมายเลขผู้ใช้ไฟฟ้า (CA/Ref.No.1)</th>
          <th data-field="CUSTOMER_NAME" data-sortable="true">ชื่อลูกค้า</th>
          <th data-formatter="operateFormatter" data-events="operateEvents" > รายละเอียด</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
