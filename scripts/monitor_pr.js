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

function LINEProfileDisplayFormatter(userId, row, index){
    $.ajax({
        url: 'https://api.line.me/v2/bot/profile/'+userId,
        method: "get",
        crossDomain: true,
        dataType: 'jsonp',
        beforeSend: function(request) {
            request.setRequestHeader("Authorization", 'Bearer <?=getenv("LINE_CHANNEL_ACCESS_TOKEN")?>');
        },
        success: function(response){
            console.log('response', response);
        },
        error: function(error){
            console.log('error', error);
        }
    });
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
        $("tr.groupBy > td").addClass("animated fadeInUp");
    })
});

// function getwithNo_cors(){
//     fetch('https://api.line.me/v2/bot/profile/U9629b9b72e84a8b4f4f904e21db16199', {	
//             'mode': 'no-cors',
//             headers: new Headers({
//                 'Authorization': 'Bearer NCUUPMI9eL++OnIxuXLB4UFgn1I6BGR8MP6ljLJt2EWpNVRxjRZgfgMZdarheJ5d1Kd43O0V3RZkrsYs907kRbskDfAE9Rgmftpbbfy3ZbUX3JuIkDGtmlCgdfGkKoEUI3wNM0OEERB82/oyt4Kb0wdB04t89/1O/w1cDnyilFU='
//             })
//         }
//     )
//     .then(function(response){
//         console.log('getwithNo_cor - success', response.json());
//     })
//     .catch(function(error){
//         console.log('getwithNo_cor - error', error);
//     });
// }

// function getwith_cors(){
//     fetch('https://api.line.me/v2/bot/profile/U9629b9b72e84a8b4f4f904e21db16199', {	
//             'mode': 'cors',
//             headers: new Headers({
//                 'Authorization': 'Bearer NCUUPMI9eL++OnIxuXLB4UFgn1I6BGR8MP6ljLJt2EWpNVRxjRZgfgMZdarheJ5d1Kd43O0V3RZkrsYs907kRbskDfAE9Rgmftpbbfy3ZbUX3JuIkDGtmlCgdfGkKoEUI3wNM0OEERB82/oyt4Kb0wdB04t89/1O/w1cDnyilFU='
//             })
//         }
//     )
//     .then(function(response){
//         console.log('getwith_cors - success', response.json());
//     })
//     .catch(function(error){
//         console.log('getwith_cors - error', error);
//     });
// }

// getwithNo_cors();
// getwith_cors();