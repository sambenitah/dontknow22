$( document ).ready(function () {
    $( ".inputAddPage" ).click(function() {

        $(".inputAddPage").attr("class", "inputAddPage")
        var clss = $(this).attr("id");
        $("#"+clss+"").attr("class", "inputAddPage inputAddPage--click");

    });
});




