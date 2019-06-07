<div class="row">
  <div class="col-sm-12 col-md-12 col-lg-12">
    <div class="card shadow-sm">
      <div class="card-body">
        <h4 class="card-title font-weight-bold">
          <i class="fas fa-walking"></i> รายละเอียดใบสั่งซื้อ
          <span class="d-none d-lg-block d-lg-none float-right badge badge-pill badge-primary">หมายเลขใบสั่งซื้อ : <span id="purchase_id"></span></span>
          <input type="hidden" name="hidden_ca" id="hidden_ca" value="" />
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
              </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4">
              <div class="form-group">
                <label for="bp" class="text-center font-weight-bold">
                  <i class="fas fa-sort-numeric-up"></i> หมายเลข CA
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
                  <i class="fas fa-sort-numeric-up"></i> ที่อยู่ตามหมายเลข CA
                </label>
                <input type="text" class="text-center form-control readonly" id="address" name="address" disabled="disabled">
                <input type="hidden" id="hidden_address" name="hidden_address" />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
              <div class="form-group">
                <label for="bp" class="text-center font-weight-bold">
                  <i class="fas fa-sort-numeric-up"></i> เบอร์โทรศัพท์
                </label>
                <input type="text" class="text-center form-control readonly" id="tel" name="tel" disabled="disabled">
                <input type="hidden" id="hidden_tel" name="hidden_tel" />
              </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6">
              <div class="form-group">
                <label for="bp" class="text-center font-weight-bold">
                  <i class="fas fa-sort-numeric-up"></i> ประเภทมูลค่าลูกค้า
                </label>
                <input type="text" class="text-center form-control readonly" id="hml_type" name="hml_type" disabled="disabled">
                <input type="hidden" id="hidden_hml_type" name="hidden_hml_type" />
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
            <div class="col-sm-12 col-md-12 col-lg-3">
              <h4 class="font-weight-bold">รายการบริการที่เลือก</h4>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6">
                    <button class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>  เลือกสินค้าเพิ่ม</button>
                    <button class="ml-2 btn btn-primary btn-sm" id="btn-confirm"><i class="fas fa-check"></i>  ยืนยัน</button>
            </div>
          </div>
          <!-- <div class="dropdown-divider"></div> -->
          <div class="row mt-2">
            <div class="col-sm-12 col-md-12 col-lg-12">
              <table
                  data-toggle="table" 
                  data-url="./api/datatable/purchase_lineitem_emp_table.php?purchase_id=<?=$_GET['purchase_id']?>" 
                  data-fixed-columns="true"
                  data-sticky-header="true"
                  data-show-footer="true"
                  data-pagination="true">
                <thead>
                  <tr>
                    <th data-field="cate_id" data-sortable="true">
                      <i class="fas fa-indent"></i> รหัสสินค้า
                    </th>
                    <!-- <th data-field="CODE" data-sortable="true"><i class="fas fa-business-time"></i> รหัสการจัดทำ</th> -->
                    <th data-field="cate_name">
                      <i class="fas fa-user-tie"></i> ชื่อสินค้า
                    </th>
                    <!-- <th data-field="STAFF" data-sortable="true"><i class="fas fa-receipt"></i> ผู้ดูแล</th> -->
                    <th data-field="appointment_date" data-sortable="true">
                      <i class="fas fa-receipt"></i> วันที่นัดหมาย
                    </th>
                    <th data-formatter="lineitem_format" data-field="cate_id"  > รายละเอียด</th>
                  </tr>
                </thead>
              </table>
            </div>
            <div class='modal fade' tabindex='-1' role='dialog' id='cartModal'>
                <div class='modal-dialog modal-lg' role='document' >
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title font-weight-bold' id="head_modal"><i class='fas fa-shopping-cart'></i> รหัสสินค้า <span id="modal_cate_id"></span> ใบสั่งซื้อเลขที่ <span id="modal_purchase_id"></span></h5>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                        <div class='modal-body'>
                            <div class="form-group">
                                <label> ชื่อสินค้า</label>
                                <textarea class="form-control" rows="3" id="cate_name" name = "cate_name" disabled></textarea>
                            </div>
                            <div class="form-group">
                                <label> ความต้องการเพิ่มเติม</label>
                                <textarea class="form-control" rows="3" id="des" name = "des" disabled></textarea>
                            </div>
                            <label>วันที่นัดหมาย</label>
                            <input class="form-control text-center datepicker" 
                                style="font-size:22px;"
                                placeholder="เลือกวันนัดหมาย" 
                                type="date" disabled name="date_input" id="app_date"/>
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-primary'  href="#" id="edit" onclick="edit()" value="edit">แก้ไข</button>
                            <button type='button' class='btn btn-primary'  href="#" id="del">ลบ</button>
                            <button type='button' class='btn btn-primary' data-dismiss='modal' >ปิด</button>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>