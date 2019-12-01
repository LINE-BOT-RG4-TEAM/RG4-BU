<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h2 class="font-weight-bold text-primary">
                            <i class="fas fa-receipt"></i> ติดตามความต้องการ
                        </h2>
                    </div>
                </div>
                <div class='dropdown-divider'></div>
                <div class="row mt-2">
                    <!-- avatar col -->
                    <div class="col-2 text-center">
                        <img src="<?=$_GET["pictureUrl"] ?>" class="animated fadeInDown w-75 shadow rounded-circle" /><br/>
                        <label class="text-center mt-2 fadeInUp">
                            <span class="text-success"><i class="fab fa-line"></i> LINE Account</span><br/>
                            <?=$_GET['displayName']?>
                        </label>
                    </div>
                    <!-- general data -->
                    <div class="col-5 border-right border-light">
                        <table>
                            <tbody style="font-size:16px;">
                                <tr>
                                    <td class="text-right">
                                        เลขที่ใบสรุปฯ :
                                    </td>
                                    <td class="pl-3">
                                        <input type="text" class="text-center form-control readonly bg-white" style="width: 270px;" value="<?=$_GET["purchase_id"]?>" disabled="disabled">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">
                                        หมายเลข BP :
                                    </td>
                                    <td class="pl-3">
                                        <input type="text" class="text-center form-control readonly bg-white" id="bp" value="กำลังดึงข้อมูล..." disabled="disabled">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">
                                        ชื่อลูกค้าตาม BP :
                                    </td>
                                    <td class="pl-3">
                                        <input type="text" class="animated fadeIn text-center form-control readonly bg-white" id="bp_name" value="กำลังดึงข้อมูล..." disabled="disabled">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">
                                        หมายเลขผู้ใช้ไฟ (CA) :
                                    </td>
                                    <td class="pl-3">
                                        <input type="text" class="text-center form-control readonly bg-white" id="ca" value="กำลังดึงข้อมูล..." disabled="disabled">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">
                                        ที่อยู่ (ตามระบบ) : 
                                    </td>
                                    <td class="animated fadeIn pl-3">
                                        <input type="text" class="text-center form-control readonly bg-white" id="address" value="กำลังดึงข้อมูล..." disabled="disabled">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-5">
                        <table class="mt-4">
                            <tbody style="font-size:16px;">
                                <tr>
                                    <td colspan="2">
                                        <h4 class="font-weight-bold text-right">ข้อมูลสำหรับติดต่อผู้ใช้ไฟ</h4>
                                        <div class="dropdown-divider"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right" style="font-size:16px;width:160px;">
                                        ชื่อ-สกุล (ลงทะเบียน) : 
                                    </td>
                                    <td class="animated fadeIn pl-3" style="width:400px;">
                                        <input type="text" class="text-center form-control readonly bg-white" id="FullName" value="กำลังดึงข้อมูล..." disabled="disabled">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">
                                    เบอร์โทรศัพท์ : 
                                    </td>
                                    <td class="animated fadeIn pl-3">
                                    <input type="text" class="text-center form-control readonly bg-white" id="CA_TEL" value="กำลังดึงข้อมูล..." disabled="disabled">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">
                                        อีเมล์ : 
                                    </td>
                                    <td class="animated fadeIn pl-3">
                                    <input type="text" class="text-center form-control readonly bg-white" id="CA_EMAIL" value="กำลังดึงข้อมูล..." disabled="disabled">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <h3 class="font-weight-bold">
                            <i class="far fa-list-alt"></i>
                            บริการที่ผู้ใช้ไฟฟ้าสนใจ
                            <div class="float-right">
                                <a href="show_invoice.php?<?=base64_encode("purchase_id=".$_GET["purchase_id"])?>" class="btn btn-primary" target="_blank">
                                    <i class="fas fa-file-alt"></i> ใบสรุปความต้องการ
                                </a>
                            </div>
                        </h3>
                        <table
                            data-toggle="table" 
                            data-url="./api/datatable/purchase_lineitem_emp_table.php?purchase_id=<?=$_GET['purchase_id']?>" 
                            data-fixed-columns="true"
                            data-sticky-header="true"
                            data-pagination="true">
                            <thead>
                            <tr>
                                <th data-field="cate_id" data-sortable="true" data-width="7">
                                    <i class="fas fa-indent"></i> รหัสบริการ
                                </th>
                                <th data-field="cate_name" data-width="200">
                                    <i class="fas fa-user-tie"></i> ชื่อสินค้า
                                </th>
                                <th data-field="appointment_date" data-sortable="true" data-width="40">
                                    <i class="fas fa-receipt"></i> วันที่ให้พนักงานติดต่อกลับ
                                </th>
                                <th data-field="des" data-formatter="desFormatter">
                                    ความประสงค์เพิ่มเติม
                                </th>
                                <th data-field="contact_time" data-formatter="contactTimeFormatter">
                                    ติดต่อผู้ใช้ไฟ(วันที่/เวลา)
                                </th>
                                <th data-field="quotation_notice" data-formatter="quotationNoticeFormatter">
                                    เลขที่ มท. หรือ<br/>เลขที่ใบเสนอราคา
                                </th>
                                <th data-field="report_document_url" data-width="90" data-formatter="reportFormatter">
                                    <i class="fas fa-receipt"></i> รายงาน
                                </th>
                                <th data-field="notice">
                                    <i class="far fa-images"></i> บันทึกช่วยจำ
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
<input type="hidden" name="hidden_purchase_id" id="hidden_purchase_id" value='<?=$_GET["purchase_id"] ?>' />
<input type="hidden" name="hidden_pictureUrl" id="hidden_pictureUrl" value='<?=$_GET["pictureUrl"] ?>' />
<input type="hidden" name="hidden_displayName" id="hidden_displayName" value='<?=$_GET["displayName"] ?>' />