<div class="row">
    <div  class="col-12 col-m-12 col-l-12">
        <p style="margin-left: 100px;" id="add-PagesTitle">Your Pictures</p>
    </div>
</div>

<section>
    <div  style="width: 100%; padding: 0 10% 0 10%;" class="col-12 col-m-12 col-l-12">
        <div id="sectionPicture" class="col-12 col-m-12 col-l-12">
            <?php foreach ($ListPicture as $key => $picture):?>
                <div style="margin: 10px;"  class="gridPicture col-10 col-m-8 col-l-5">
                    <figure id="<?php echo $picture->id?>" class="figurePicture">
                            <div class="divDeletePicture">
                                <a id="cross<?php echo $picture->id?>" class="crossDeletePicture" ><i class="symbolCross fas fa-times"></i></a>
                            </div>
                            <img id="img<?php echo $picture->id?>" class="pictures"  src="../public/imagesUpload/<?php echo $picture->name_id?>">
                    </figure>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</section>

