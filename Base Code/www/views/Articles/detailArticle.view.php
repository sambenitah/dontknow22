
<?php foreach ($DetailArticle as $key => $detail):?>


<div class="row">
    <div class="col-6 center col-m-6 m-center col-l-8 l-center">
        <div class="backgroundDetailArticle">

            <article  id="<?php echo $detail->id?>" class="post">
                <div class="row">
                    <div style="width: 100%; padding: 0px;" class="col-6  col-m-6 col-l-8">
                        <div class="post-media">
                            <img id="<?php echo $detail->main_picture?>" style="width: 100%; height: 500px;" src="/public/imagesUpload/<?php echo $detail->main_picture?>">
                        </div>
                    </div>
                </div>
                <div class="post-content">
                    <div class="the-content">
                        <p id="errorContent"></p>
                        <?php $this->addModal("form", $formArticle);?>
                    </div>
                </div>
                <input id="inputHiddenCategory" value="<?php echo $detail->category?>">
                <input id="inputHiddenPicture" value="<?php echo $detail->main_picture?>">
                <input id="inputHiddenContent" value="<?php echo $detail->content ?>">
                <input id="inputHiddenStatus" value="<?php echo $detail->status ?>">
            </article>
        </div>
    </div>
</div>
<?php endforeach;?>




<script>
    $(document).ready( function () {

        $.ajax({
            url : '/Pictures/showPictureInSelecte',
            type : 'POST',
            data: {ajax : true },
            dataType: "json",
            success : function(data){

                for(i=0 ; i<data.length; i++)
                    $("#selectPicture").append('<option id= "'+data[i].name_id+'">' + data[i].name + '</option>')
            }
        });

        $.ajax({
            url: '/Categories/showCategory',
            type: 'POST',
            data: {},
            dataType: "json",
            success: function (category) {
                for(i=0 ; i<category.length; i++)
                    $("#selectCategory").append('<option id= "'+category[i].name+'">' + category[i].name + '</option>')
            }
        });

        var contentTynmce = $("#inputHiddenContent").val();
        $("#textareaUpdateArticle").val(contentTynmce);

    });


    $("#selectPicture").change(function () {
        var picture = $('#selectPicture option:selected').attr('id');
        $("#inputHiddenPicture").val(picture)
    });


    $("#selectCategory").change(function () {
        var category = $('#selectCategory option:selected').text();
        $("#inputHiddenCategory").val(category)
    });

    $("#selectStatus").change(function () {
        var category = $('#selectStatus option:selected').text();
        $("#inputHiddenStatus").val(category)
    });



    $("#bouttonDetailArticle").click(function (e) {
        e.preventDefault();
        tinyMCE.triggerSave();
        var content = tinyMCE.get('textareaUpdateArticle').getContent();

        var id = $(".post").attr('id');
        var picture = $("#inputHiddenPicture").val();
        if (picture == '-')
            var picture = $('img').attr('id');

        var category = $("#inputHiddenCategory").val();
        if (category == '-')
            var category = $('#inputHiddenCategory').val();

        var status = $("#inputHiddenStatus").val();
        if (status == '-')
            var status = $('#inputHiddenStatus').val();



        $.ajax({
            url : '/Articles/updateArticle',
            data: {id : id, content : content, main_picture : picture, category : category, status : status },
            type : 'POST',
            dataType: "json",
            success : function(data){
                if (data != 'Update')
                    $("#errorContent").append(data)
                else
                window.location.reload(true);
            }
        });
    });
</script>
