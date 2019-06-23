<div class="col-9 col-m-9 col-l-9">
    <div class="projects">
        <article class="post">
            <div class="post-media">
        <?php foreach ($ListPage as $key => $detail):?>
            <img id="imgDetailArticle" src="/public/imagesUpload/<?php echo $detail->main_picture?>">
            </div>
            <div class="post-content">


                <h2 class="title"><?php echo $detail->title?></h2>
                <div class="post-details">
                    <a href="#" class="post-date"><?php echo $detail->date_inserted?></a>
                </div>
                <div class="the-content">

                    <?php echo $detail->content?>

                    <div class="post-footer">

                        <div class="post-share-wrap">
                            <div class="post-share">
                                <a href="#">
                                    <i class="fab fa-facebook"></i>
                                </a>
                                <a href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#">
                                    <i class="fab fa-google-plus"></i>
                                </a>
                                <a href="#">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                                <a href="#">
                                    <i class="fab fa-pinterest"></i>
                                </a>
                            </div>
                        </div>

                        <div class="cat">
                            <strong>Category:</strong><a href="#" rel="category tag"><?php echo $detail->category?></a>
                        </div>

                    </div>
                </div>
        <?php endforeach;?>
        <?php if (isset($_SESSION["auth"])):?>
                <div id="comments">

        <?php foreach ($Messages as $key => $detail):?>
                    <div class="comments-inner">
                        <ul class="comment-list">
                            <li class="comment">
                                <div class="comment-body">
                                    <div class="comment-context">
                                        <div class="comment-head">
                                            <h2 class="title"><?php echo $detail->firstname; echo " "; echo $detail->lastname;?> </h2>
                                            <span class="comment-date"><?php echo $detail->date_inserted?></span>
                                            <?php if ($_SESSION["role"] == 3):?>
                                            <i id="<?php echo $detail->id?>" style="float: right; cursor: pointer" class="deleteComment fas fa-times"></i>
                                            <?php endif;?>
                                        </div>
                                        <div class="comment-content">
                                            <p>
                                                <?php echo $detail->content?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
        <?php endforeach;?>

                    <div id="respond" class="comment-respond">
                        <h2 class="title">Leave a Reply</h2>
                        <?php $this->addModal("form", $CommentForm);?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </article>
    </div>
</div>




<script>
    $(document).ready(function () {
        $(".deleteComment").click(function () {
            var id = $(this).attr("id");
            $.confirm({
                title: false,
                boxWidth: '500px',
                useBootstrap: false,
                content: '<p class="titleAlert">Are you sur ?</p><br><p class="textAlert">Do you want to delete this Comment ?</p>',
                type: 'dark',
                typeAnimated: true,
                buttons: {
                    Delete: {
                        text: 'Delete',
                        btnClass: 'btn-dark',
                        action: function () {
                            $.ajax({
                                url: '/Comments/deleteComment',
                                data: {id: id},
                                type: 'POST',
                                dataType: "json",
                                success: function (data) {
                                    if (data = 'delete'){
                                        window.location = "/front";
                                    }

                                }
                            });
                        }
                    },
                    close: function () {
                    }
                }
            });

        })
    })
</script>