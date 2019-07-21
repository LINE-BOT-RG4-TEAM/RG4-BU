<div class="row">
  <div class="col-sm-12 col-md-12 col-lg-12">
    <h1 class="float-left font-weight-bold text-primary animated fadeIn">
      <i class="fas fa-file-invoice"></i> ดูใบเสนอความต้องการ (PR)
      <br/>
      <span class="text-secondary" style="font-size: 0.6em;">รายการใบเสนอความต้องการจาก กฟฟ. ในสังกัด</span>
    </h1>
    <table 
        data-toggle="table" 
        data-url="./api/datatable/fetch_all_pr_by_district.php" 
        data-fixed-columns="true"
        data-sticky-header="true"
        data-pagination-v-align="both"
        data-search="true"
        data-pagination="true">
      <thead>
        <tr>
            <th data-field="pea_name">pea_name</th>
            <th data-field="PURCHASE_ID">PURCHASE_ID</th>
            <!-- <th data-field="BP">BP</th> -->
            <th data-field="CA">CA</th>
            <th data-field="CUSTOMER_NAME">CUSTOMER_NAME</th>
            <th data-field="FullName">FullName</th>
            <th data-field="CA_TEL">CA_TEL</th>
            <th>
                รายละเอียด
            </th>
        </tr>
      </thead>
    </table>
  </div>
</div>