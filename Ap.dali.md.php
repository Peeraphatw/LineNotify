<!-- Modal -->
<div id="AP<?=$no?>" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p>Approve <?=$row['Title']?> ?</p>
            </div>
            <div class="modal-footer">
                <form action="ap.process.php" method="POST">
                    <input type="hidden" value="notify_daily" name="tbname">
                    <input type="hidden" value="<?=$row['ID']?>" name="APID">
                    <input type="submit" class="btn btn-success" value="Approve" name="AP">
                </form>

                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>