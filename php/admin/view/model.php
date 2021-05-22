<?php

$id = $row['id'];

?>
<a href="#myModalRemarks<?php echo $row['id']; ?>" class="remarksBtn" data-toggle="modal">Click to edit</a>
<div class="modal fade bd-example-modal-lg" id="myModalRemarks<?php echo $row['id']; ?>" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content -->
        <div class="modal-content">
            <form method="post" action="controller/submit.php">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times</button>
                </div>

                <div class="modal-content">
                    <br>
                    <?php echo $row['name']; ?>
                    <br>
                    <?php
                    require "../controller/editEvent.php";
                    ?>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Save changes</button>
                </div>
            </form>

        </div>
    </div>
</div>


