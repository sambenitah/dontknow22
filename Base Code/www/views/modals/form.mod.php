<?php $data = ($config["config"]["method"]=="POST")?$_POST:$_GET; ?>

<?php if( !empty($config["errors"])):?>
        <ul>
            <?php foreach ($config["errors"] as $errors):?>
            <p id="error"><?php echo $errors;?></p>
                <?php endforeach ?>
        </ul>
<?php endif ?>

<form
        action="<?php echo $config["config"]["action"];?>"
        method="<?php echo $config["config"]["method"];?>"
        class="<?php echo $config["config"]["class"];?>"
        id="<?php echo $config["config"]["id"];?>"
        <?php if ($config["config"]["enctype"] == true ):?>
        enctype="multipart/form-data"
        <?php endif;?>
>


    <?php if (array_key_exists('select', $config)):?>
        <?php foreach ($config["select"] as $key => $select):?>
            <div class="row">
                <div class="col-12 center col-m-5 m-center col-l-5 l-center">
                    <div id="divLabelSelect">
                        <label id="labelSelect" class="label"><?php echo $select["label"];?></label>
                    </div>
                    <select id="<?php echo $select["id"];?>" class="<?php echo $select["class"];?>">
                        <?php foreach ( $select["option"] as $key => $detailSelect ):?>
                            <option id="<?php echo $detailSelect["id"];?>"><?php echo $detailSelect["value"];?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
        <?php endforeach;?>
    <?php endif;?>

    <?php foreach ($config["data"] as $key => $Form):?>
        <?php if($Form["type"]=="color" ):?>
            <label class="label"><?php echo $Form["label"];?></label>
            <input type="<?php echo $Form["type"];?>"
                   name="<?php echo $key;?>"
                <?php echo ($Form["required"])?'required="required"':'';?>
                   id="<?php echo $Form["id"];?>"
                   class="<?php echo $Form["class"];?>"
                   value="<?php echo $Form["value"];?>"
            >
        <?php endif;?>
    <?php endforeach;?>


    <?php foreach ($config["data"] as $key => $Form):?>

        <?php if($Form["type"]=="text" || $Form["type"]=="email" || $Form["type"]=="password"):?>

            <?php if($Form["type"]=="password" ) unset($data[$key]); ?>

            <input type="<?php echo $Form["type"];?>"
                   name="<?php echo $key;?>"
                   placeholder="<?php echo  $Form["placeholder"];?>"
                <?php echo ($Form["required"])?'required="required"':'';?>
                   id="<?php echo $Form["id"];?>"
                   class="<?php echo $Form["class"];?>"
                   value="<?php echo(!empty($Form["value"])) ? $Form["value"] : '' ;?>"
            >
            <?php elseif ($Form["type"] == null):?>
                <label class="label"><?php echo $Form["value"];?></label>
                <textarea id="<?php echo $Form["id"];?>"
                          class="<?php echo $Form["class"];?>"
                          name="<?php echo $key;?>">
                </textarea>
        <?php endif;?>
    <?php endforeach;?>

    <?php if (array_key_exists('dataFile', $config)):?>
        <?php foreach ($config["dataFile"] as $key => $files):?>

            <label id="labelFile" class="label"><?php echo $files["titleFile"];?></label>
            <label for="file" class="<?php echo $files["classLabel"];?>"><?php echo $files["value"];?></label>
            <input  type="<?php echo $files["type"];?>"
                    id="<?php echo $files["id"];?>"
                    class="<?php echo $files["class"];?>"
                    name="<?php echo $key;?>"
                    accept="<?php echo $files["accept"];?>"
            >

        <?php endforeach;?>
    <?php endif;?>


    <input type="submit" id="<?php echo $config["config"]["idSubmit"];?>" class="<?php echo $config["config"]["classSubmit"];?>" value="<?php echo $config["config"]["submit"];?>">

    <?php if ($config["config"]["cancelButton"] != false):?>

        <a href="#" class="<?php echo $config["config"]["classCancel"];?>" id="<?php echo $config["config"]["idCancel"];?>" ><?php echo $config["config"]["cancel"];?></a>

    <?php endif;?>


</form>