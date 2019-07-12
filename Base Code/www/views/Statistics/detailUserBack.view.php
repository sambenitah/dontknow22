
<div class="row">
    <div class="col-6 center col-m-6 m-center col-l-6 l-center">
        <p id="titleDetailUser" class="textDetailUser">Detail de l'utilisateur  <?php echo $DetailUsers["firstname"]?></p>
        <p class="textDetailUser">Firstname : <?php echo $DetailUsers["firstname"] ?></p>
        <p class="textDetailUser">Lastname : <?php echo $DetailUsers["lastname"] ?></p>
        <p class="textDetailUser">Email : <?php echo $DetailUsers["email"] ?></p>
        <p class="textDetailUser">Date inserted : <?php echo $DetailUsers["date_inserted"] ?></p>
        <p class="textDetailUser">Date updated : <?php echo $DetailUsers["date_updated"] ?></p>
        <form action="/Statistics/updateUserDetail" method="post">
            <div class="FormDetailUser row">
                <div class="col-2  col-m-2  col-l-2">
                    <p class="textDetailUser">Role</p>
                    <div class="divSelectUserDetail">
                        <?php if ($_SESSION["role"] == "3"): ?>
                            <select name="role" class="selectUserDetail" <?php echo $DetailUsers["role"] != 3 ? "" : "disabled = 'true'" ?>>
                                <option value="1" <?php echo $DetailUsers["role"] == 1 ? "selected = select" : "" ?>>Simple user</option>
                                <option value="2" <?php echo $DetailUsers["role"] == 2 ? "selected = select" : "" ?>>Admin</option>
                            </select>
                        <?php endif;?>
                    </div>
                </div>
                <div class="col-2  col-m-2  col-l-2">
                    <p class="textDetailUser">Status</p>
                    <div class="divSelectUserDetail">
                        <select name="status" class="selectUserDetail">
                            <option value="1" <?php echo $DetailUsers["status"] == 1 ? "selected = select" : "" ?>>1</option>
                            <option value="0" <?php echo $DetailUsers["status"] == 0 ? "selected = select" : "" ?>>0</option>
                        </select>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $DetailUsers["id"] ?>">
            <input type="hidden" name="token" value="<?php echo $DetailUsers["token"] ?>">
            <div>
                <input id="bouttonAddArticle" class="bouttonConfirmForm bouttonUpdateDetailUser" type="submit" value="Update" />
            </div>
        </form>
    </div>
</div>




