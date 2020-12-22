<!-- */ delete M */ -->
<div class="modal fade" id="deleteM<?=$nodaily?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Do you Want to Delete: <?=$datadaily['Title']?> ?
            </div>
            <div class="modal-footer align-items-center">
                <form action="dali.delete.php" method="POST">
                    <input type="hidden" value="<?=$datadaily['ID']?>" name="ddaiid">
                    <input type="submit" value="Yes" class="btn btn-danger" name="ddaily">
                    <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                </form>
            </div>
        </div>
    </div>
</div>