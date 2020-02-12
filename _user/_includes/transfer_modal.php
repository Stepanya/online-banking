<!-- Confirm -->
<div class="modal fade" id="confirm">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>CONFIRM MONEY TRANSFER</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="transfer_money.php">
            		<input type="hidden" id="sender" name="sender">
                <input type="hidden" id="receiver" name="receiver">
                <input type="hidden" id="pin" name="pin">
                <input type="hidden" id="amount" name="amount">
            		<div class="text-center">
	                	To: <h2 id="acc" class="bold"></h2>
                    Amount: <h2 id="peso" class="bold"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat" name="send"><i class="fa fa-send"></i> Confirm</button>
            	</form>
          	</div>
        </div>
    </div>
</div>