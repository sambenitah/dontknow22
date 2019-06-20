
<div class="row">
    <div  class="col-12 col-m-12 col-l-12">
        <p id="add-PagesTitle">Add Category</p>
    </div>
</div>

<section id="formAddPages">

    <?php $this->addModal("form", $ListForm);?>

    <a id="a-deleteCategory" href="#">Do you want to delete a category ?</a>

    <div id="CategoryDelete">

    </div>

</section>
<script>
    $(document).ready( function () {

        $.ajax({
            url : '/Categories/showCategory',
            type : 'POST',
            data: {},
            dataType: "json",
            success : function(data){

                for(i=0 ; i<data.length; i++) {
                    $("#CategoryDelete").append('<div id="divExtCategory"><p class="textCategoryForDelete">' + data[i].name + '<i id= "' + data[i].id + '" class="crossDeleteCategory fas fa-times"></i></p><div>')

                    $(".crossDeleteCategory").click(function () {
                        var id = this.id;

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
                                    action: function () {
                                        $.ajax({
                                            url: 'Categories/deleteCategory',
                                            data: {id: id},
                                            type: 'POST',
                                            dataType: "json",
                                            success: function (data) {
                                                window.location.reload(true);
                                            }
                                        });
                                    }
                                },
                                close: function () {
                                }
                            }
                        });
                    });
                }
            }
        });

    });




    $( "#a-deleteCategory" ).click(function() {
        $( "#CategoryDelete" ).show( "slow" );
    });

</script>
