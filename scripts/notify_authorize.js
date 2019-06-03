window.onload = function(){
    $("#create_link").click(function(){
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

        var encoded64 = btoa(payload);
        // redirect
        var redirect_uri = "https://pea-crm.herokuapp.com/customer.php?action=authorize&payload="+encoded64;
        $("#authorize_uri").val(redirect_uri);
        // $("#authorize_uri").props('disabled', false);
    });

    $("#copy_link").click(function(){
        var authorize_uri = $("#authorize_uri").val() || '' ;
        if(authorize_uri.length <= 0){
            Swal.fire({
                type: 'warn',
                text: 'ท่านยังไม่ได้สร้างลิงก์ กรุณาเลือกเงื่อนไขตามข้อ 1 และกดปุ่ม "สร้างลิงก์"'
            });
            return;
        }

        var copyText = document.getElementById("authorize_uri");

        /* Select the text field */
        copyText.select();

        /* Copy the text inside the text field */
        document.execCommand("copy");

        /* Alert the copied text */
        Swal.fire({
            type: "success",
            title: "คัดลอกสำเร็จ",
            text: "ท่านสามารถส่งลิงก์ไปยังผู้รับการแจ้งเตือน ผ่านแอพพลิเคชั่นไลน์เท่านั้น"
        });
    });
};