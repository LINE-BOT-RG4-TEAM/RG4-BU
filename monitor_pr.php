<div class="row">
  <div class="col-sm-12 col-md-12 col-lg-12">
    <h1 class="float-left font-weight-bold text-primary animated fadeIn">
      <i class="fas fa-file-invoice"></i> ดูใบเสนอความต้องการ (PR)
      <br/>
      <span class="text-secondary" style="font-size: 0.6em;">รายการใบเสนอความต้องการจาก กฟฟ. ในสังกัด</span>
    </h1>
    <table 
        class="table-bordered table-sm"
        data-toggle="table" 
        data-group-by="true"
        data-group-by-field="pea_name"
        data-url="./api/datatable/fetch_all_pr_by_district.php" 
        data-fixed-columns="true"
        data-sticky-header="true"
        data-pagination-v-align="both"
        data-search="true"
        data-pagination="true">
      <thead>
        <tr>
            <th data-field="UserID" data-width="120" data-formatter="LINEProfileDisplayFormatter"><i class="fas fa-user-circle"></i> ผู้ใช้</th>
            <th data-field="pea_name" data-visible="false" data-formatter="PEAGroupFormatter">ชื่อการไฟฟ้า</th>
            <th data-field="PURCHASE_ID" data-formatter="textCenterFormatter">เลขที่ใบเสนอ<br/>ความต้องการ</th>
            <!-- <th data-field="BP">BP</th> -->
            <th data-field="CA" data-formatter="textCenterFormatter">หมายเลขผู้ใช้ไฟ <br/>(CA)</th>
            <th data-field="CUSTOMER_NAME">ชื่อตาม BP</th>
            <!-- <th data-field="FullName">ชื่อ-สกุล</th> -->
            <th data-field="quantity_service" data-formatter="textCenterAndWorkSuffixFormatter">จำนวนบริการ</th>
            <!-- <th data-field="CA_TEL">CA_TEL</th> -->
            <th data-formatter="viewPRFormatter" data-events="viewPRDetailEvents">
              รายละเอียด
            </th>
        </tr>
      </thead>
    </table>
  </div>
</div>