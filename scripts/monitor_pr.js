function textCenterFormatter(value, row, index){
    return [
        "<div class='text-center'>",
        value,
        "</div>"
    ].join("");
}

function textCenterAndWorkSuffixFormatter(value, row, index){
    return [
        "<div class='text-center'>",
        value,
        " บริการ",
        "</div>"
    ].join("");
}

function viewPRFormatter(value, row, index) {
    return [
        '<div class="text-center">',
        '<a href="javascript:void(0);" class="btn btn-sm btn-outline-primary">',
        '<i class="far fa-eye"></i> รายละเอียดใบเสนอฯ',
        '</a>',
        '</div>'
    ].join("");
}

function LINEProfileDisplayFormatter(userId, row, index){
    return [
        "<div class='text-center'>",
        "<img class='w-75 rounded-circle' alt='"+row['displayName']+"' src='"+row['pictureUrl']+"' />",
        "<p class='font-weight-bold'>"+row['displayName']+"</p>",
        "</div>"
    ].join("");
}

$(function(){
    // trigger when data table load success
    $("table").on("load-success.bs.table", function(){
        $("tr.groupBy")
        .css({
            "font-wegiht": "bold",
            "font-size": "24px"
        })
        .addClass("p-2 bg-light text-primary font-weight-bold");
        $("tr.groupBy > td").addClass("animated fadeInLeft");
    })
});