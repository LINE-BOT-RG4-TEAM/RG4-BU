<div class="row">
  <div class="col-sm-12 col-md-12 col-lg-12">
    <div class="card shadow-sm">
      <div class="card-body">
        <h4 class="card-title font-weight-bold">
          <i class="fas fa-walking"></i> รายละเอียดข้อมูลลูกค้า 
          <span class="d-none d-lg-block d-lg-none float-right badge badge-pill badge-primary">หมายเลขผู้ใช้ไฟฟ้า (CA) : <?=$_GET['ca']?></span>
          <input type="hidden" name="hidden_ca" id="hidden_ca" value="<?=$_GET['ca']?>" />
        </h4>
        <div class="dropdown-divider"></div>
        <div class="card-text">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-4">
              <div class="form-group">
                <label for="bp" class="text-center font-weight-bold">
                  <i class="fas fa-sort-numeric-up"></i> หมายเลข BP
                </label>
                <input type="text" class="text-center form-control readonly" id="bp" name="bp" disabled="disabled">
                <input type="hidden" id="hidden_bp" name="hidden_bp" />
              </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4">
              <div class="form-group">
                <label for="bp" class="text-center font-weight-bold">
                  <i class="fas fa-sort-numeric-up"></i> หมายเลขผู้ใช้ไฟฟ้า (CA)
                </label>
                <input type="text" class="text-center form-control readonly" id="ca" name="ca" disabled="disabled">
                <input type="hidden" id="hidden_ca" name="hidden_ca" />
              </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4">
              <div class="form-group">
                <label for="bp" class="text-center font-weight-bold">
                  <i class="fas fa-sort-numeric-up"></i> ประเภทธุรกิจ
                </label>
                <input type="text" class="text-center form-control readonly" id="business_type" name="business_type" disabled="disabled">
                <input type="hidden" id="hidden_business_type" name="hidden_business_type" />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-4">
              <div class="form-group">
                <label for="bp" class="text-center font-weight-bold">
                  <i class="fas fa-sort-numeric-up"></i> ชื่อลูกค้า (ตาม BP Number)
                </label>
                <input type="text" class="text-center form-control readonly" id="customer_name" name="customer_name" disabled="disabled">
                <input type="hidden" id="hidden_customer_name" name="hidden_customer_name" />
              </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-8">
              <div class="form-group">
                <label for="bp" class="text-center font-weight-bold">
                  <i class="fas fa-sort-numeric-up"></i> ที่อยู่ตามหมายเลขผู้ใช้ไฟฟ้า (CA/Ref.No.1)
                </label>
                <input type="text" class="text-center form-control readonly" id="address" name="address" disabled="disabled">
                <input type="hidden" id="hidden_address" name="hidden_address" />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-4">
              <div class="form-group">
                <label for="bp" class="text-center font-weight-bold">
                  <i class="fas fa-sort-numeric-up"></i> เบอร์โทรศัพท์
                </label>
                <input type="text" class="text-center form-control readonly" id="tel" name="tel" disabled="disabled">
                <input type="hidden" id="hidden_tel" name="hidden_tel" />
              </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4">
              <div class="form-group">
                <label for="bp" class="text-center font-weight-bold">
                  <i class="fas fa-sort-numeric-up"></i> ประเภทมูลค่าลูกค้า
                </label>
                <input type="text" class="text-center form-control readonly" id="hml_type" name="hml_type" disabled="disabled">
                <input type="hidden" id="hidden_hml_type" name="hidden_hml_type" />
              </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4">
              <div class="form-group">
                <label for="bp" class="text-center font-weight-bold">
                  <i class="fas fa-sort-numeric-up"></i> ค่าใช้จ่ายบิลมากที่สุด
                </label>
                <input type="text" class="text-center form-control readonly" id="max_bill" name="max_bill" disabled="disabled">
                <input type="hidden" id="hidden_max_bill" name="hidden_max_bill" />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
              <div class="form-group">
                <label for="bp" class="text-center font-weight-bold">
                  <i class="fas fa-sort-numeric-up"></i> KAM_TYPE
                </label>
                <input type="text" class="text-center form-control readonly" id="KAM_TYPE" name="KAM_TYPE" disabled="disabled">
                <input type="hidden" id="hidden_KAM_TYPE" name="hidden_KAM_TYPE" />
              </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6">
              <div class="form-group">
                <label for="bp" class="text-center font-weight-bold">
                  <i class="fas fa-sort-numeric-up"></i> KAMR
                </label>
                <input type="text" class="text-center form-control readonly" id="kamr" name="kamr" disabled="disabled">
                <input type="hidden" id="hidden_kamr" name="hidden_kamr" />
              </div>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-sm-12 col-md-12 col-lg-6">
              <h4 class="font-weight-bold">ประวัติการซื้อธุรกิจเสริม</h4>
            </div>
          </div>
          <!-- <div class="dropdown-divider"></div> -->
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
              <table
                  data-toggle="table" 
                  data-url="./api/datatable/fetch_history_bu.php?ca=<?=$_GET['ca']?>" 
                  data-fixed-columns="true"
                  data-sticky-header="true"
                  data-show-footer="true"
                  data-pagination="true">
                <thead>
                  <tr>
                    <!-- <th data-formatter="dateFormatter" data-field="history" data-sortable="true"> -->
                    <th data-formatter="dateThaiFormatter" data-field="history">
                      <i class="fas fa-indent"></i> วันที่ชำระเงิน
                    </th>
                    <!-- <th data-field="CODE" data-sortable="true"><i class="fas fa-business-time"></i> รหัสการจัดทำ</th> -->
                    <th data-field="CODE_NAME">
                      <i class="fas fa-user-tie"></i> กิจกรรมที่ทำ
                    </th>
                    <!-- <th data-field="STAFF" data-sortable="true"><i class="fas fa-receipt"></i> ผู้ดูแล</th> -->
                    <th data-field="PAYMENT" data-sortable="true">
                      <i class="fas fa-receipt"></i> ค่าใช้จ่าย
                    </th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>