$( document ).ready(function() {
    var width = $(document).width();

    $(".figurePicture").mouseover(function() {
        var id = this.id;
        $("#cross"+id+"").css("visibility", "visible");
    });

    $(".figurePicture" ).mouseleave(function() {
        var id = this.id;
        $("#cross"+id+"").css("visibility", "hidden");
    });


    $(".crossDeletePicture").click(function () {

        var id = this.id.substr(5);
        var url = $("#img"+id+"").attr('src');

        $.confirm({
            title: false,
            boxWidth: '500px',
            useBootstrap: false,
            content: '<p class="titleAlert">Are you sur ?</p><br><p class="textAlert">Do you want to delete this picture ?</p>',
            type: 'dark',
            typeAnimated: true,
            buttons: {
                Delete: {
                    text: 'Delete',
                    btnClass: 'btn-dark',
                    action: function(){
                        $.ajax({
                            url : 'Pictures/deletePicture',
                            data: {id : id, url : url},
                            type : 'POST',
                            dataType: "json",
                            success : function(data){
                                if(data == "Delete") {
                                    window.location.reload(true);
                                }
                                else{
                                    $.confirm({
                                        title: false,
                                        boxWidth: '500px',
                                        useBootstrap: false,
                                        content: '<p class="textAlert">You can\'t delete this picture because you use it</p>',
                                        type: 'dark',
                                        typeAnimated: true,
                                    })
                                }
                            }
                        });
                    }
                },
                close: function () {
                }
            }
        });
    });
});

//---------------   Show article  ------------------//

//---------------  Articledetail  ------------------//


tinymce.init({
    selector: '#textareaUpdateArticle',
    plugins: "autoresize",
    min_height: 500,
});

//---------------  Category  ------------------//





