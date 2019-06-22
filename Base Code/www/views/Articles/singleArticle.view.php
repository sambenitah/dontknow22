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
                    <a href="#" class="post-views">15 views</a>
                    <a href="#" class="post-comments">03 Comments</a>
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
        </article>
    </div>
</div>