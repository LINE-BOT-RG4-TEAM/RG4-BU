window.onload = function(){
    $("#create_link").click(function(){
        // นำไปใส่ในฟังก์ชั่นที่คัดลอกลิงก์
        
        // var authorize_uri = $("#authorize_uri").val() || '' ;
        // if(authorize_uri.length <= 0){
        //     Swal({
        //         type: 'warn',
        //         text: 'ไม่สามารถ'
        //     });
        //     return;
        // }
        var pea_code = $("#pea_code").val() || '';
        var payload = pea_code+",";
        var notifyType = $("[name='notifyType']:checked").val() || '';
        if(notifyType === "user"){
            var employee_code = $("#employee_code").val();
            if(employee_code.length <= 0){
                $("#employee_code").focus();
                Swal.fire({
                    type: "warning",
                    text: "กรุณากรอกรหัสประจำตัวพนักงานของผู้รับการแจ้งเตือนด้วยค่ะ"
                });
                return;
            }
            payload += "user,"+employee_code;
        }else if(notifyType === "group"){
            payload += "group";
        }
        // redirect
        var redirect_uri = "https://pea-crm.herokuapp.com/customer.php?action=authorize&payload="+payload;
        $("#authorize_uri").val(redirect_uri);
        $("#authorize_uri").props('disabled', false);
    });
};