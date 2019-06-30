<?php require("./utils/db_connector.php"); ?>
<!DOCTYPE html>
<html lang="th">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ระบบบริหารจัดการฐานข้อมูลลูกค้ารายสำคัญและธุรกิจเสริม - สายงานการไฟฟ้า ภาค 4</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/theme_1545570683953.css">
    <link href="https://fonts.googleapis.com/css?family=Sarabun|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <style>
      * {
        font-family: 'Sarabun', 'Roboto', sans-serif;
      }
      .font-roboto {
        font-family: 'Roboto';
      }
    </style>
  </head>
  <body>

    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <h2 class="font-weight-bold pt-2"><i class="far fa-images"></i> อัพโหลดรูปภาพก่อน/หลัง ดำเนินการ</h2>
        </div>
      </div>
      <?php 
        $purchase_id = $_GET['purchase_id'];
        $purchase_lineitem_id = $_GET['purchase_lineitem_id'];

        // fetch quantity of activity photo
        $fetch_quantity = "
          SELECT 
              COUNT(CASE WHEN photo_mode = 'before_operate' THEN 1 ELSE NULL END) AS 'quantity_before_photo'
            , COUNT(CASE WHEN photo_mode = 'after_operate' THEN 1 ELSE NULL END) AS 'quantity_after_photo'
          FROM purchase_activity_photo
          WHERE purchase_lineitem_id = '{$purchase_lineitem_id}';
        ";
        $activity_result = $conn->query($fetch_quantity);
        $quantity_num_rows = $activity_result->num_rows;
        if($quantity_num_rows == 0){
          // before
          $count_before_photo = 0;
          $is_exceed_before_photo = false;

          // after
          $count_after_photo = 0;
          $is_exceed_after_photo = false;
        } else {
          $row_result = $activity_result->fetch_assoc();
          
          // before result
          $count_before_photo = (int)$row_result['quantity_before_photo'];
          $is_exceed_before_photo = ($count_before_photo == 5) ? true : false;

          // after result
          $count_after_photo = (int)$row_result['quantity_after_photo'];
          $is_exceed_after_photo = ($count_before_photo == 5) ? true : false;
        }
      ?>
      <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6">
          <div class="card p-2">
            <div class="card-body">
              <div class="row">
                <div class="form-group">
                  <h4 class="text-primary font-weight-bold">
                    ภาพถ่ายก่อนดำเนินการ
                    <small class="text-secondary">
                      คงเหลือ <?=5 - $count_before_photo?> รูป
                    </small>
                  </h4>
                  <?php if(!$is_exceed_before_photo){ ?>
                  <progress id="upload_progress_before_operate w-100" value="0" max="100">0%</progress>
                  <input type="file" class="form-control-file" id="photo_uploader_before_operate" onchange="javascript:uploadPhoto('<?=$_GET['purchase_id']?>', <?=$_GET['purchase_lineitem_id']?>, 'before_operate', this);" value="upload" accept="image/jpeg"/>
                  <?php } ?>
                </div>
              </div>
              <div class="row">
                <div>
                <?php 
                  $fetch_before_photo = "
                    SELECT *
                    FROM purchase_activity_photo
                    WHERE purchase_lineitem_id = '{$_GET['purchase_lineitem_id']}'
                          AND photo_mode = 'before_operate'
                    ORDER BY upload_timestamp desc;
                  ";
                  $before_result = $conn->query($fetch_before_photo);
                  $before_quantity = $before_result->num_rows;
                  if($before_quantity == 0){
                    echo "<h3>ไม่มีภาพก่อนดำเนินการ</h3>";
                  }else{
                    while($before_photo = $before_result->fetch_assoc()){
                ?>
                  <button type="button" onclick="javascript:removePhoto('<?=$before_photo['id']?>', '<?=$before_photo['firebase_ref']?>');" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <img src="<?=$before_photo['photo_url']?>" class="mt-2 w-100 img-thumbnail rounded mx-auto d-block" alt="...">
                <?php
                    }
                  }
                ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
          <div class="card p-2">
            <div class="card-body">
              <div class="row">
                <div class="form-group">
                  <h4 class="text-success font-weight-bold">
                    ภาพถ่ายหลังดำเนินการ
                    <small class="text-secondary">
                      คงเหลือ <?=5 - $count_after_photo?> รูป
                    </small>
                  </h4>
                  <?php if(!$is_exceed_after_photo){ ?>
                  <progress id="upload_progress_after_operate w-100" value="0" max="100">0%</progress>
                  <input type="file" class="form-control-file" id="photo_uploader_after_operate" onchange="javascript:uploadPhoto('<?=$_GET['purchase_id']?>', <?=$_GET['purchase_lineitem_id']?>, 'after_operate', this);" value="upload" accept="image/jpeg"/>
                  <?php } ?>
                </div>
              </div>
              <div class="row">
                <div>
                <?php 
                  $fetch_after_photo = "
                    SELECT *
                    FROM purchase_activity_photo
                    WHERE purchase_lineitem_id = '{$_GET['purchase_lineitem_id']}'
                          AND photo_mode = 'after_operate'
                    ORDER BY upload_timestamp desc;
                  ";
                  $after_result = $conn->query($fetch_after_photo);
                  $after_quantity = $after_result->num_rows;
                  if($after_quantity == 0){
                    echo "<h3 class='text-center'>ไม่มีภาพหลังดำเนินการ</h3>";
                  }else{
                    while($after_photo = $after_result->fetch_assoc()){
                ?>
                  <button type="button" onclick="javascript:removePhoto('<?=$after_photo['id']?>', '<?=$after_photo['firebase_ref']?>');" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <img src="<?=$after_photo['photo_url']?>" class="mt-2 w-100 img-thumbnail rounded mx-auto d-block" alt="...">
                <?php
                    }
                  }
                ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/6.2.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.7.0/firebase-storage.js"></script>
    <script src="./assets/js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.14.2/dist/bootstrap-table.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="./assets/js/jquery.blockUI.js"></script>
    <script>
      var firebaseConfig = {
        apiKey: "<?=getenv('FIREBASE_API_KEY')?>",
        authDomain: "<?=getenv('FIREBASE_AUTH_DOMAIN')?>",
        databaseURL: "<?=getenv('FIREBASE_DATABASE_URL')?>",
        projectId: "<?=getenv('FIREBASE_PROJECT_ID')?>",
        storageBucket: "<?=getenv('FIREBASE_STORAGE_BUCKET')?>",
        messagingSenderId: "<?=getenv('FIREBASE_MESSAGING_SENDER_ID')?>",
        appId: "<?=getenv('FIREBASE_APP_ID')?>"
      };
      // Initialize Firebase
      firebase.initializeApp(firebaseConfig);

      function uploadPhoto(purchase_id, purchase_lineitem_id, mode, e){
        var file = e.files[0];
        var upload_progress = document.getElementById('upload_progress_'+mode);
        console.log(upload_progress);
        var photo_uploader = document.getElementById('photo_uploader_'+mode);
        var storageRef = firebase.storage().ref(purchase_id+'/'+purchase_lineitem_id+'/'+mode+'/'+file.name);
        var uploadTask = storageRef.put(file);
        $.blockUI();
        uploadTask.on("state_changed", 
          function progress(snapshot){
            var percentage = (snapshot.bytesTransferred/snapshot.totalBytes)*100;
            upload_progress.value = percentage;
            console.log('percentage now ', percentage);
          },
          function error(error){
            console.log('error');
          },
          function complete(){
            var fullPath = uploadTask.snapshot.ref.fullPath;
            var name = uploadTask.snapshot.ref.name;
            uploadTask.snapshot.ref.getDownloadURL().then(function(downloadURL) {
              $.ajax({
                url: "./api/update_activity_photo.php",
                method: "POST",
                data: {
                  purchase_lineitem_id: purchase_lineitem_id,
                  photo_mode: mode,
                  firebase_ref: fullPath,
                  photo_name: name,
                  photo_url: downloadURL
                },
                beforeSend: function(){
                  console.log('before_send');
                },
                success: function(response){
                  console.log('response', response);
                },
                error: function(error){
                  console.log('error', error);
                },
                complete: function(){
                  console.log('complete');
                  window.location.reload();
                }
              })
            });
            Swal.fire(
              'อัพโหลดสำเร็จ',
              '',
              'success'
            );
          }
        );
      }

      function removePhoto(photo_id, firebase_ref){
        var photoRef = firebase.storage().ref().child(firebase_ref);

        // Delete the file
        photoRef.delete().then(function() {
          // File deleted successfully
          console.log('Remove from firebase successfully...');
        }).catch(function(error) {
          // Uh-oh, an error occurred!
          console.log("Can't download from firebase storage.");
        });

        $.ajax({
          url: "./api/remove_activity_photo.php",
          method: "POST",
          data: {
            photo_id: photo_id
          },
          beforeSend: function(){
            $.blockUI();
          },
          success:function(response){
            Swal.fire(
              "ลบภาพถ่ายเรียบร้อยแล้ว",
              "",
              "success"
            );
          },
          error:function(error){
            Swal.fire(
              "ไม่สามารถลบภาพถ่าย",
              "",
              "error"
            );
          },
          complete: function(){
            window.location.reload();
            $.unblockUI();
          }
        })
      }
    </script>
  </body>
</html>