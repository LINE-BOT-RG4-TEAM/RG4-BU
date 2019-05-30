window.onload = function(){
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        startDate: '+5d'
    });

    $("form").submit(function(event){
        $.blockUI({
            message: '<div class="spinner-grow text-primary display-4" style="width: 4rem; height: 4rem;" role="status"><span class="sr-only">Loading...</span></div>',
            overlayCSS : { 
                backgroundColor: '#ffffff',
                opacity: 1
            },
            css : {
                opacity: 1,
                border: 'none',
            }
        });
    })
};