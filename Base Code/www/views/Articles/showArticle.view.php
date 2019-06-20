<div class="row">
    <div  class="col-12 col-m-12 col-l-12">
        <p id="add-PagesTitle">Your Articles</p>
    </div>
</div>
<section id="displayYourPages">
    <div class="row">
        <div  class="col-12 center col-m-12 m-center col-l-12 l-center">

        <?php foreach ($ListPage as $key => $page):?>
            <article class="mainDivYourPages">
                <p class="sectionTopArticle"><i id="cross<?php echo $page->id?>" class="crossDeleteArticle symbolShowArticles fas fa-times"></i></p>
                <a style="text-decoration: none; color: black;" id="<?php echo $page->id?>" class="Article" href="<?php echo "Articles/detailArticles/".$page->route?>">
                <p class="titleDivAddPages"><?php echo $page->title?></p>
                <hr class="hr">
                <p class="textDivAddPages"><?php echo $page->description?></p>
                <hr class="hr">
                <p class="textDivAddPages"><?php echo date('Y-m-d', strtotime($page->date_inserted))?></p>
                </a>
            </article>
        <?php endforeach;?>
        </div>
    </div>
</section>




<script>
    $(".crossDeleteArticle").click( function () {
        var id = this.id.substr(5);
        $.confirm({
            title: false,
            boxWidth: '500px',
            useBootstrap: false,
            content: '<p class="titleAlert">Are you sur ?</p><br><p class="textAlert">Do you want to delete this article ?</p>',
            type: 'dark',
            typeAnimated: true,
            buttons: {
                Delete: {
                    text: 'Delete',
                    btnClass: 'btn-dark',
                    action: function(){
                        $.ajax({
                            url : 'Articles/deleteArticle',
                            data: {id : id},
                            type : 'POST',
                            dataType: "json",
                            success : function(data){
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
</script>