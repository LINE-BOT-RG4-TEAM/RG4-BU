<div class="row">
  <div class="col-sm-12 col-md-12 col-lg-12">
    <h1 class="float-left font-weight-bold text-primary">
      <i class="fas fa-clipboard-list"></i>
      ใบสั่งซื้อ
    </h1>
    <p class="text-secondary">
      รายการใบสั่ง
    </p>
    <table 
      data-toggle="table" 
      data-pagination="true"
      data-fixed-columns="true"
      data-pagination-v-align="both"
      data-sticky-header="true"
      data-search="true"
      data-page-list="[5, 10, 20, 100, ALL]"
      data-url="./api/datatable/po_table.php">
      <thead>
        <tr>
          <th data-field="purchase_id" data-sortable="true"><i class="fas fa-indent"></i>หมายเลข PO</th>
          <th data-field="cus_name" data-sortable="true"><i class="fas fa-user-tie"></i>ชื่อ BP</th>
          <th data-field="FullName" data-sortable="true"><i class="fas fa-user-tie"></i>ชื่อผู้ติดต่อของ BP</th>
          <th data-field="service_num" data-sortable="true"><i class="fas fa-receipt"></i> จำนวนบริการ</th>
          <th data-field="confident_document" data-sortable="true" data-formatter="documentFormatter"><i class="fas fa-receipt"></i> ใบเสร็จการชำระเงิน</th>
          <th data-formatter="po_Formatter" data-events="po_Events" > รายละเอียด</th>
        </tr>
      </thead>
    </table>
  </div>
</div>