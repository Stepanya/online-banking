<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span id="headname"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="accounts_edit.php">
            		<input type="hidden" id="id" name="id">
                <div class="form-group">
                  <label class="col-sm-4 control-label">First Name </label>

                  <div class="col-sm-7">
                    <input type="text" class="form-control" id="fname" name="fname" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">Last Name </label>

                  <div class="col-sm-7">
                    <input type="text" class="form-control" id="lname" name="lname" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">Middle Initial </label>

                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="mi" name="mi" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">Account Type</label>

                  <div class="col-sm-4">
                    <select class="form-control" id="type" name="type" required>
                      <option value="Savings">Savings</option>
                      <option value="Savings">Savings With Debit Card</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">Account Number</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="accno" name="accno" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">Balance</label>

                  <div class="col-sm-4">
                    <input type="number" class="form-control" id="bal" name="bal" min="100" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">Status </label>

                  <div class="col-sm-4">
                    <select class="form-control" id="status" name="status" required>
                      <option value="Active">Active</option>
                      <option value="Active">Lost</option>
                      <option value="Inactive">Inactive</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">Pin</label>

                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="pin" maxlength="6" pattern="[0-9]" title="Minimum of 6 DIGITS">
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
            	<form class="form-horizontal" method="POST" action="accounts_delete.php">
            		<input type="hidden" id="del_id" name="id">
            		<div class="text-center">
	                	<p>DELETE CLIENT</p>
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


     