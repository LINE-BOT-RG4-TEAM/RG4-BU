function PEAGroupFormatter(value, row, index){
    return "#"+value;
}

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

$(function(){
    $("tr.groupBy").css({
        'font-weight': 'bold',
        'font-size': '20px'
    });
});