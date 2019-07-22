$(function(){
    $.ajax({
        url: './api/fetch_purchase_emp_api.php',
        method: 'POST',
        data: {
            purchase_id: $("#hidden_purchase_id").val()
        },
        success: function(response){
            var obj = JSON.parse(response) || [];
            $('#bp').val(obj[0].BP);
            $('#bp_name').val(obj[0].CUSTOMER_NAME);
            $('#ca').val(obj[0].CA);
            $("#FullName").val(obj[0].FullName);
            $("#CA_TEL").val(obj[0].CA_TEL);
            $("#CA_EMAIL").val(obj[0].CA_EMAIL);
            $("#address").val(obj[0].ADDRESS);
        },
        error: function(error){

        }
    });
});

function reportFormatter(link, row, index){
    link = link || "";
    if(link.length == 0){
        return [
            "<div class='text-center text-dark'>",
            '<i class="fas fa-times"></i> ไม่พบรายงาน',
            "</div>"
        ].join("");
    }
    return [
        '<div class="text-center">',
        "<a class='btn btn-primary' href='"+link+"' target='_blank'>",
        '<i class="far fa-file-pdf"></i> เรียกดูรายงาน',
        '</a>',
        '</div>'
    ].join("");
}

function contactTimeFormatter(contactData, row, index){
    contactData = contactData || '';
    if(contactData.length == 0){
        return [
            "<div class='text-danger font-weight-bold text-center'>",
            '<i class="fas fa-times"></i> ไม่มีข้อมูล<br/>ติดต่อ',
            "</div>"
        ].join("");
    }
    return contactData;
}

function quotationNoticeFormatter(notice, row, index){
    console.log('quotationNoticeFormatter',row);
    notice = notice || "";
    if(notice.length == 0){
        return [
            "<div class='text-info font-weight-bold text-center'>",
            '<i class="fas fa-times"></i> ไม่มีเลขที่ มท./<br/>เลขที่ใบเสนอราคา',
            "</div>"
        ].join("");
    }
    return notice;
}

function desFormatter(des, row, index){
    des = des || '';
    if(des.length == 0){
        return "<div class='text-center text-success'>ไม่มีประสงค์เพิ่มเติม</div>";
    }
    return des;
}