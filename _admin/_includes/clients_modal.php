<!-- ADD ACCOUNT -->
<div class="modal fade" id="add_account">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span>Issue Account</span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="accounts_issue.php">
                <input type="hidden" id="acc-id" name="id">

                <div class="form-group">
                  <label class="col-sm-4 control-label">First Name </label>

                  <div class="col-sm-7">
                    <input type="text" class="form-control" id="acc-fname" name="fname" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-4 control-label">Last Name </label>

                  <div class="col-sm-7">
                    <input type="text" class="form-control" id="acc-lname" name="lname" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-4 control-label">Middle Initial </label>

                  <div class="col-sm-7">
                    <input type="text" class="form-control" id="acc-mi" name="mi" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-4 control-label">Username </label>

                  <div class="col-sm-7">
                    <input type="text" class="form-control" id="acc-uname" name="uname" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-4 control-label">Select Account Type</label>

                  <div class="col-sm-4">
                    <select class="form-control" name="type" required>
                      <option value="Savings">Savings</option>
                      <option value="Savings">Savings With Debit Card</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-4 control-label">Deposit Ammount </label>

                  <div class="input-group col-sm-5">
                    <span class="input-group-addon">&#8369;</span>
                    <input type="number" class="form-control" name="amount" min="100" required>
                    <span class="input-group-addon">.00</span>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-4 control-label" >Pin Code</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control pin-code" readonly name="pin" required>
                  </div>

                  <div class="col-sm-4">
                    <button type="button" class="btn btn-primary gen-pin">Generate Pin</button>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-4 control-label" >Account Number</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control acc-no" readonly maxlength="10" name="accno" required>
                  </div>

                  <div class="col-sm-4">
                    <button type="button" class="btn btn-primary gen-acc-no">Generate Account Number</button>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="issue"><i class="fa fa-check-square-o"></i> Submit</button>
              </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span id="headname"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="client_edit.php">
            		<input type="hidden" id="id" name="id">
                <div class="form-group">
                  <label class="col-sm-2 control-label">First Name </label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="fname" name="fname" required>
                  </div>

                  <label class="col-sm-2 control-label">Contact # </label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="ctn" name="ctn" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Last Name </label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="lname" name="lname" required>
                  </div>

                  <label class="col-sm-2 control-label">Address </label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="add" name="add" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Middle Initial </label>

                  <div class="col-sm-1">
                    <input type="text" class="form-control" id="mi" name="mi" required>
                  </div>

                  <label class="col-sm-5 control-label">Date Of Birth </label>

                  <div class="col-sm-4">
                    <input type="date" class="form-control" max="2000-01-01" value="2000-01-01" id="dob" name="dob" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Username </label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="uname" name="uname" required>
                  </div>

                  <label class="col-sm-2 control-label">Status </label>

                  <div class="col-sm-4">
                    <select class="form-control" id="status" name="status" required>
                      <option value="Active">Active</option>
                      <option value="Inactive">Inactive</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Password </label>

                  <div class="col-sm-4">
                    <input type="password" class="form-control" name="pass">
                  </div>
                  <label class="col-sm-2 control-label">Confirm Password </label>

                  <div class="col-sm-4">
                    <input type="password" class="form-control" name="cpass">
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
            	<form class="form-horizontal" method="POST" action="client_delete.php">
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


     