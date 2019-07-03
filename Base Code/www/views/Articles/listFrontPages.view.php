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
                </div>
                <div class="post-text card-description">
                    <?php echo substr($article->content, 0,370)?>
                    ...
                </div>
            </div>
        </article>
        <?php endforeach;?>
    </div>
