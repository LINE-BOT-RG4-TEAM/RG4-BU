<div class="row">
  <div class="col-sm-12 col-md-12 col-lg-12">
    <div class="card-text">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <div class="alert alert-light h-100 text-dark" role="alert">
            <span class="font-weight-bold text-success" style="font-size: 22px;"><i class="fas fa-bullhorn"></i> ข้อควรทราบก่อนดำเนินการ</span><br/>
            <div class="dropdown-divider text-light"></div>
            <span class="font-weight-bold">
              ในหน้าเว็บไซต์ปัจจุบันที่ท่านเข้าถึงอยู่ เป็นหน้าเว็บสำหรับจัดการบริการต่างๆ ดังนี้
            </span>
              <ol class="font-weight-bold">
                <li>เพิ่ม/ลด/แก้ไข รายบริการต่างๆ ผ่านตาราง `รายการบริการ` (ตามตารางด้านล่าง)</li>
                <li>เพิ่มไฟล์รายงานการดำเนินกิจกรรมในระบบในรูปแบบไฟล์ pdf</li>
                <li>หลังจาก กฟฟ.​ ดำเนินการให้บริการเสร็จสิ้นแล้ว สามารถแนบภาพกิจกรรม ก่อนทำ/หลังทำ</li>
              </ol>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row mt-3">
  <div class="col-sm-12 col-md-12 col-lg-12">
    <div class="card border">
      <div class="card-body">
        <h3 class="card-title font-weight-bold text-primary">
          <i class="fas fa-walking"></i> รายละเอียดใบสั่งซื้อ
          <span class="d-none d-lg-block d-lg-none float-right badge badge-pill badge-primary">หมายเลขใบสั่งซื้อ : <span id="purchase_id"></span></span>
          <input type="hidden" name="hidden_purchase_id" id="hidden_purchase_id" />
        </h3>
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
            <div class="col-sm-12 col-md-12 col-lg-4">
              <div class="form-group">
                <label class="text-center font-weight-bold">
                  <i class="fas fa-sort-numeric-up"></i> ชื่อ-สกุล (ที่ลงทะเบียนไว้)
                </label>
                <input type="text" class="text-center form-control readonly" id="FullName" name="FullName" disabled="disabled">
              </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4">
              <div class="form-group">
                <label class="text-center font-weight-bold">
                  <i class="fas fa-sort-numeric-up"></i> เบอร์โทรศัพท์
                </label>
                <input type="text" class="text-center form-control readonly" id="tel" name="tel" disabled="disabled">
              </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4">
              <div class="form-group">
                <label class="text-center font-weight-bold">
                  <i class="fas fa-sort-numeric-up"></i> E-mail
                </label>
                <input type="text" class="text-center form-control readonly" id="CA_EMAIL" name="CA_EMAIL" disabled="disabled">
              </div>
            </div>
          </div>
          <div class="row">
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
                  <i class="fas fa-sort-numeric-up"></i> KAM_TYPE
                </label>
                <input type="text" class="text-center form-control readonly" id="KAM_TYPE" name="KAM_TYPE" disabled="disabled">
                <input type="hidden" id="hidden_KAM_TYPE" name="hidden_KAM_TYPE" />
              </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4">
              <div class="form-group">
                <label for="bp" class="text-center font-weight-bold">
                  <i class="fas fa-sort-numeric-up"></i> KAMR
                </label>
                <input type="text" class="text-center form-control readonly" id="kamr" name="kamr" disabled="disabled">
                <input type="hidden" id="hidden_kamr" name="hidden_kamr" />
              </div>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-sm-12 col-md-12 col-lg-12">
              <h4 class="font-weight-bold">รายการบริการ
                <div class="float-right">
                  <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#select_service_modal">
                    <i class="fas fa-plus"></i> 
                    เลือกสินค้าเพิ่ม
                  </button>
                </div>
                <div class="float-right">
                  <a id="send_confirm_email" href="javascript:void(0);" class="btn btn-outline-dark btn-block disabled">
                    <i class="far fa-envelope"></i>
                    ส่งอีเมล์ไปยังผู้ใช้ไฟ
                  </a>
                </div>
              </h4>
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
                  data-pagination="true">
                <thead>
                  <tr>
                    <th data-field="cate_id" data-sortable="true" data-width="7">
                      <i class="fas fa-indent"></i> รหัสสินค้า
                    </th>
                    <th data-field="cate_name" data-width="200">
                      <i class="fas fa-user-tie"></i> ชื่อสินค้า
                    </th>
                    <th data-field="appointment_date" data-sortable="true" data-width="40">
                      <i class="fas fa-receipt"></i> วันที่นัดหมาย
                    </th>
                    <th data-field="report_document_url" data-width="90" data-formatter="reportFormatter">
                      <i class="fas fa-receipt"></i> รายงาน
                    </th>
                    <th data-field="notice" data-width="200" data-formatter="noticeFormatter">
                      <i class="far fa-images"></i> ข้อความหมายเหตุ<br/>จาก พนง.กฟฟ
                    </th>
                    <th data-formatter="lineitem_format" data-width="50" data-field="cate_id">
                      รายละเอียด
                    </th>
                  </tr>
                </thead>
              </table>
            </div>
            <!-- modal -ของสินค้า -->
            <div class='modal fade' tabindex='-1' role='dialog' id='PoModal'>
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
                            <button type='button' class='btn btn-primary'  href="javascript:void(0);" id="edit" onclick="edit()" value="edit">แก้ไข</button>
                            <button type='button' class='btn btn-primary'  href="javascript:void(0);" id="del" onclick="del()">ลบ</button>
                            <button type='button' class='btn btn-primary' data-dismiss='modal' >ปิด</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- จบ MOdal ของสินค้า -->
            <!-- modal -เลือกสินค้าเพิ่ม -->
            <div class='modal fade' tabindex='-1' role='dialog' id='select_service_modal'>
                <div class='modal-dialog modal-lg' role='document' >
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title font-weight-bold' id="head_modal"><i class='fas fa-shopping-cart'></i> เลือกบริการเพิ่ม--ใบสั่งซื้อเลขที่ <span id="select_service_modal_purchase_id"></span></h5>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                        <div class='modal-body'>
                            <div class="form-group">
                                <label> หมวดหมู่หลัก</label>
                                <select class="form-control" id="select_service_cate_name" name = "select_service_cate_name" onclick="fetch_level2(this.value)">
                                  <option>กรุณาเลือก</option>
                                  
                                </select>
                            </div>
                            <div class="form-group sub_cate">
                                <label id="sub_cate_label"> หมวดหมู่ย่อย</label>
                                <select class="form-control" id="select_sub_cate" name = "select_sub_cate" onchange="fetch_level3(this.value)">
                                <option>กรุณาเลือก</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label> คำอธิบาย</label>
                                <textarea class="form-control desc" rows="5" id="select_service_des" name = "select_service_des" disabled></textarea>
                            </div>
                            <div class="form-group detail">
                                <label> รายละเอียดเพิ่มเติม</label>
                                <textarea class="form-control" rows="5" id="detail_from_cus" name = "detail_from_cus"></textarea>
                            </div>
                            <div id="div_date">
                            <label>วันที่นัดหมาย</label>
                            <input class="form-control text-center datepicker" 
                                style="font-size:22px;"
                                placeholder="เลือกวันนัดหมาย" 
                                type="date" name="date_input" id="app_date_add2po" required/>
                            </div>
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-primary'  href="#" id="btn_add" onclick="" >เพิ่ม</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- จบ modal -เลือกสินค้าเพิ่ม -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/6.2.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.7.0/firebase-storage.js"></script>