<div class="row">
  <div class="col-sm-12 col-md-12 col-lg-12">
    <h1 class="float-left font-weight-bold text-primary">
      <i class="fas fa-clipboard-list"></i>
      ใบสรุปความต้องการ
      <br/>
      <small class="text-secondary">
        รายการใบสรุปฯ สั่งซื้อบริการเสริมของ กฟภ. จากผู้ใช้ไฟ
      </small>
    </h1>
    <table 
      data-toggle="table" 
      data-pagination="true"
      data-fixed-columns="true"
      data-pagination-v-align="both"
      data-sticky-header="true"
      data-search="true"
      data-page-size="5"
      data-page-list="[5, 10, 20, 100, ALL]"
      data-url="./api/datatable/po_table.php">
      <thead>
        <tr>
          <th data-field="purchase_id" data-sortable="true"><i class="fas fa-indent"></i>หมายเลข PR</th>
          <th data-field="cus_name" data-sortable="true"><i class="fas fa-user-tie"></i>ชื่อ BP</th>
          <th data-field="FullName" data-sortable="true"><i class="fas fa-user-tie"></i>ชื่อผู้ติดต่อของ BP</th>
          <th data-field="service_num" data-sortable="true"><i class="fas fa-receipt"></i> จำนวนบริการ</th>
          <th data-formatter="po_Formatter" data-events="po_Events" > รายละเอียด</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

<div class="row mt-5">
  <div class="col-sm-12 col-md-12 col-lg-12">
    <h2 class="float-left font-weight-bold text-success">
      <i class="far fa-check-square"></i>
      ใบเสนอความต้องการที่ กฟภ. ดำเนินการเรียบร้อยแล้ว
    </h2>
    <table 
      data-toggle="table" 
      data-pagination="true"
      data-fixed-columns="true"
      data-pagination-v-align="both"
      data-sticky-header="true"
      data-search="true"
      data-page-size="5"
      data-page-list="[5, 10, 20, 100, ALL]"
      data-url="./api/datatable/complete_po_table.php">
      <thead>
        <tr>
          <th data-field="purchase_id" data-sortable="true"><i class="fas fa-indent"></i>หมายเลข PR</th>
          <th data-field="cus_name" data-sortable="true"><i class="fas fa-user-tie"></i>ชื่อ BP</th>
          <th data-field="FullName" data-sortable="true"><i class="fas fa-user-tie"></i>ชื่อผู้ติดต่อของ BP</th>
          <th data-field="service_num" data-sortable="true"><i class="fas fa-receipt"></i> จำนวนบริการ</th>
          <th data-formatter="po_Formatter" data-events="po_Events" > รายละเอียด</th>
        </tr>
      </thead>
    </table>
  </div>
</div>