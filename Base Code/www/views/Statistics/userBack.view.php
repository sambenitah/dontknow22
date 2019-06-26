<?php
use DontKnow\Core\Routing;
?>
<div class="row">
    <div class="col-11 center col-m-11 m-center col-l-11 l-center">
        <table id="tableAllUser">
            <tr id="headerTable">
                <td class="td">Id</td>
                <td class="td">Firstname</td>
                <td class="td">Lastname</td>
                <td class="td">Email</td>
                <td class="td">Status</td>
                <td class="td">Date Inserted</td>
                <td class="td">Date Updated</td>
                <td class="td">Role</td>
                <td class="td"></td>
            </tr>
            <?php foreach ($AllUsers as $key => $detail):?>
                <tr>
                    <td class="td"><?php echo $detail->id;?></td>
                    <td class="td"><?php echo $detail->firstname; ?></td>
                    <td class="td"><?php echo $detail->lastname; ?></td>
                    <td class="td"><?php echo $detail->email; ?></td>
                    <td class="td"><?php echo $detail->status; ?></td>
                    <td class="td"><?php echo $detail->date_inserted; ?></td>
                    <td class="td"><?php echo $detail->date_updated; ?></td>
                    <td class="td"><?php echo $detail->role; ?></td>
                    <td class="td">
                        <?php if ($_SESSION["role"] == "3"): ?>
                        <a href="Statistics/detailManagementUsers/<?php echo $detail->id;?>">Update</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>


