<h2 class="text-center shadow-sm font-weight-bold" 
    style='border:1px; border-style:solid; border-color:#F1F1F1; padding: 20px;border-radius:40px 40px;'>
    นัดหมายช่วงเวลา
</h2>
<div class="alert alert-primary" role="alert">
    <p id="dear_title" class="font-weight-bold" style="font-size:18px;">
        เรียน คุณลูกค้า
    </p>
    <p style="text-indent:20px;">
        เรามีความยินดีที่ท่านสนใจบริการเสริมของการไฟฟ้าส่วนภูมิภาค
        เพื่อความสะดวกในการรับบริการ ท่านสามารถนัดหมายวันที่ต้องการรับบริการเบื้องต้น
        ผ่านช่องว่าง "นัดหมายวันรับบริการ" ในแต่ละรายการบริการด้านล่างค่ะ
    </p>
    <p class="blockquote-footer text-right" style="font-size:18px;">ขอบคุณค่ะ</p>
</div>
<img class="animated fadeInUp img-fluid" style="display: block;margin-left:auto;margin-right:auto;" src="./assets/images/appointment.jpg" />
<h4><i class="fas fa-list-alt"></i> รายการบริการที่ท่านสนใจ</h4>
<?php
    // dummy purchase id
    $POST_PURCHASE_ID = "PO00007";
    $fetch_purchase_lineitem = "
        SELECT lineitem.cate_id
                , cate_name
                , warranty
                , picture_name
                , des 
        FROM purchase_lineitem lineitem JOIN product_category product
            ON lineitem.cate_id  = product.cate_id
        WHERE product.is_product = 'Y' AND lineitem.purchase_id = '$POST_PURCHASE_ID';
    ";
    $lineitem_result_set = mysqli_query($conn,$fetch_purchase_lineitem);
    // $lineitem_result = $lineitem_result_set->fetch_all(MYSQLI_ASSOC);
?>
<form action="#!" method="POST">
<ul class="list-group list-group-flush">
<?php 
    $i = 1;
    while($product = $lineitem_result_set->fetch_assoc()){
?>
    <li class="list-group-item">
        <div class="text-center">
            <label class="font-weight-bold text-primary bg-light py-2 px-5 shadow-sm" style="font-size:22px;border-radius: 20px;">
                <i class="fas fa-check"></i>
                บริการที่ <?= $i++ ?>
            </label>
        </div>
        <p style="font-size:20px;">
            <span class='font-weight-bold text-success'>
                <i class="far fa-handshake"></i> บริการ:
            </span> 
            <span class="pl-1">
                <?=$product['cate_name']?>
            </span>
        </p>
        <p style="font-size:20px;">
            <span class='font-weight-bold text-secondary'>
                <i class="fas fa-comment-dots"></i> ความต้องการเพิ่มเติม:
            </span> 
            <br/>
            <span class="pl-4">
                <?=($product['des'] == null)?"- ไม่มีข้อมูล -":$product['des'] ?>
            </span>
        </p>
        <p class="font-weight-bold" style="font-size:20px;">
            <i class="far fa-calendar-alt"></i> นัดหมายวันรับบริการ:
        </p>
        <p>
            <input class="form-control text-center datepicker" 
                style="font-size:22px;"
                placeholder="เลือกวันนัดหมาย" 
                type="text" 
                data-cate-id="<?=$product['cate_id']?>" 
                id="<?=$product['cate_id']?>_appointment_date" 
                name="<?=$product['cate_id']?>_appointment_date" />
        </p>
    </li>
<?php 
    }
?>
</ul>
</form>
<br/>
<button type="button" onclick="console.log(this);" class="btn btn-block btn-lg btn-success">ส่งข้อมูล</button>