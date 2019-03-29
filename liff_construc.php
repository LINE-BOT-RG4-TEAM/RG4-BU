<div class="row">
<input type="hidden" name="hidden_cate_id" id="hidden_cate_id" value="<?=$_GET['cate_id']?>" />
  <h6 class="p-3 font-weight-bold pt-3 rounded-pill bg-primary text-white" id="content_header">
  </h6>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 mt-3">
        <div class="panel panel-primary">
            <div class="panel-body" id="content_body"></div>
        </div>
    </div>
</div>
<!-- <div class="dropdown-divider"></div> -->
<div class="row" id="card-area">

</div>
<!---->
<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-4 mt-3">
        <div class="card h-100">
            <img class="card-img-top" src="images/pea.jpg" alt="Card image">
            <div class="card-body">
                <h5 class="card-title">สินค้าตัวอย่าง</h5>
                <p class="card-text">สินค้าตัวอย่าง</p>
                <div class="form-check">
                    <label class="form-check-label" for="radio1">
                        <input type="radio" class="form-check-input" id="radio1" name="optradio" value="option1" checked>ประสงค์ให้เจ้าหน้าที่เข้าตรวจสอบ
                     </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label" for="radio2">
                        <input type="radio" class="form-check-input" id="radio2" name="optradio" value="option2">แจ้งรายละเอียดเพิ่มเติม
                    </label>
                </div>
                <div class="form-group mt-3">
                    <textarea class="form-control" rows="5" id="comment"></textarea>
                </div>
            </div>
            <div class="card-footer">
                <a href="#" class="btn btn-primary">เพิ่มในตะกร้า</a>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
  $("#radio1").click(function(){
    $("comment").hide();
  });
  $("#radio2").click(function(){
    $("comment").show();
  });
});
</script>
