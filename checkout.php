<h2 class="text-center shadow-sm font-weight-bold" 
    style='border:1px; border-style:solid; border-color:#F1F1F1; padding: 20px;border-radius:40px 40px;'>
    นัดหมายช่วงเวลา
</h2>
<div class="alert alert-primary" role="alert">
    <p id="dear_title" class="font-weight-bold" style="font-size:18px;">
        เรียน คุณลูกค้า
    </p>
    <p style="text-indent:20px;">
        เรามีความยินดีที่ท่านสนใจบริการของการไฟฟ้าส่วนภูมิภาค
        เพื่อความสะดวกในการรับบริการ ท่านสามารถนัดหมายวันที่ต้องการรับบริการเบื้องต้น
        ผ่านช่องว่าง "นัดหมายวันรับบริการ" ในแต่ละรายการบริการด้านล่างค่ะ
    </p>
    <p class="blockquote-footer text-right" style="font-size:18px;">ขอบคุณค่ะ</p>
</div>
<img class="animated fadeInUp img-fluid" style="display: block;margin-left:auto;margin-right:auto;" src="./assets/images/appointment.jpg" />
<h4 class="font-roboto font-weight-bold"><i class="fas fa-list-alt"></i> รายการบริการที่ท่านสนใจ</h4>
<?php
    $GET_PURCHASE_ID = $_GET['purchase_id'];
    $fetch_purchase_lineitem = "
        SELECT  purchase_lineitem_id
                , lineitem.cate_id
                , cate_name
                , warranty
                , picture_name
                , des 
        FROM purchase_lineitem lineitem JOIN product_category product
            ON lineitem.cate_id  = product.cate_id
        WHERE product.is_product = 'Y' AND lineitem.purchase_id = '$GET_PURCHASE_ID';
    ";
    $lineitem_result_set = mysqli_query($conn, $fetch_purchase_lineitem);
    // $lineitem_result = $lineitem_result_set->fetch_all(MYSQLI_ASSOC);
?>
<form action="checkout-success.php" method="POST">
<input type="hidden" name="purchase_id" value="<?=$GET_PURCHASE_ID ?>" />
<ul class="list-group list-group-flush">
<?php 
    $i = 1;
    while($product = $lineitem_result_set->fetch_assoc()){
?>
    <li class="list-group-item">
        <div class="text-center">
            <label class="font-weight-bold text-white bg-dark py-2 px-5 shadow-sm" style="font-size:22px;border-radius: 20px;">
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
            <span>
                <?php 
                    $desc = null; 
                    if($product['des'] !== null){
                        $desc = $product['des'];
                    }
                ?>
                <textarea class="form-control" 
                    name="purchases[<?=$product['purchase_lineitem_id']?>][desc]" 
                    placeholder="ท่านไม่มีความต้องการเพิ่มเติมในบริการนี้" autocomplete="off" ><?= $desc ?></textarea>
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
                name="purchases[<?=$product['purchase_lineitem_id']?>][appointment_date]"
                required 
                autocomplete="off" />
        </p>
    </li>
<?php 
    }
?>
</ul>
<br/>
<div class="btn-block">
    <button type="submit" class="btn btn-block btn-lg btn-success">
        <i class="fas fa-paper-plane"></i> ส่งข้อมูล
    </button>
    <button type="button" href="javascript:void(0);" 
        onclick="javascript: window.location.href='?action=liff_service';" 
        class="btn btn-block btn-lg btn-outline-danger">
        <i class="fas fa-chevron-circle-left"></i> 
        กลับไปเลือกสินค้า
    </button>
</div>
</form>