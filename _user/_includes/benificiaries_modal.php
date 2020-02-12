<!-- Add -->
<div class="modal fade" id="add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add Benificiary</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="benificiaries_add.php">
                <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Nickname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="nickname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Account Number</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="accno" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Edit Benificiary</b></h4>
          	</div>
          	<div class="modal-body">
              <form class="form-horizontal" method="POST" action="benificiaries_edit.php">
                <input type="hidden" id="id" name="id">
                <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Nickname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control nick" name="nickname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Account Number</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control accno" name="accno" required>
                    </div>
                </div>
            </div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Save Changes</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span id="del_uname"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="benificiaries_delete.php">
            		<input type="hidden" id="del_id" name="id">
            		<div class="text-center">
	                	<p>DELETE BENIFICIARY</p>
	                	<h2 id="del_name" class="bold"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
            	</form>
          	</div>
        </div>
    </div>
</div>


     