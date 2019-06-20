<div class="col-l-9">
    <div class="projects">

        <?php foreach ($ListPage as $key => $article):?>
        <article class="post card">
            <div class="post-media card-thumb">
                <a href="Articles/singleArticle/<?php echo $article->route?>">
                    <img src="/public/imagesUpload/<?php echo $article->main_picture?>" alt="Post">
                </a>
            </div>
            <div class="post-content card-body">
                <h2 class="title card-title">
                    <a href="Articles/singleArticle/<?php echo $article->route?>"><?php echo $article->title?></a>
                </h2>
                <div class="post-details card-subtitle">
                    <a href="#" class="post-date"><?php echo $article->date_inserted?></a>
                    <a href="#" class="post-views">15 views</a>
                    <a href="#" class="post-comments">03 Comments</a>
                </div>
                <div class="post-text card-description">
                    <?php echo substr($article->content, 0,370)?>
                    ...
                </div>
            </div>
        </article>
        <?php endforeach;?>



        <div class="pagination-wrap">
            <ul>
                <li>
                    <a class="prev page-numbers" href="#">
                        <i class="fa fa-long-arrow-left"></i>
                    </a>
                </li>
                <li>
                    <a class="page-numbers" href="#">1</a>
                </li>
                <li>
                    <span class="page-numbers current">2</span>
                </li>
                <li>
                    <a class="page-numbers" href="#">3</a>
                </li>
                <li>
                    <a class="page-numbers" href="#">4</a>
                </li>
                <li>
                    <a class="next page-numbers" href="#">
                        <i class="fa fa-long-arrow-right"></i>
                    </a>
                </li>
            </ul>

        </div>
    </div>