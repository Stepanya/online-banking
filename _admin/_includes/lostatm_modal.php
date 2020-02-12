<!-- Confirm -->
<div class="modal fade" id="confirm">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b id="title"></b></h4>
          	</div>
          	<div class="modal-body">
            		<form method="POST" action="lostatm_action.php">
                  <input type="hidden" name="id" id="id">
                  <input type="hidden" name="mark" id="mark">
                  <input type="hidden" name="accno" id="accnoh">
                  <input type="hidden" name="action" id="action">
                <div class="text-center">
	                	Account Number: <h2 id="accno" class="bold"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-warning btn-flat" name="conf"><i class="fa fa-exclamation"></i> Confirm</button>
              </form>
          	</div>
        </div>
    </div>
</div>