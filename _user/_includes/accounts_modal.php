<!-- LOST -->
<div class="modal fade" id="lost">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span id="report_uname"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="accounts_report.php">
            		<input type="hidden" id="report_id" name="id">
            		<div class="text-center">
	                	<p>REPORT AS LOST</p>
	                	<h2 id="report_info" class="bold"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="report"><i class="fa fa-trash"></i> Report</button>
            	</form>
          	</div>
        </div>
    </div>
</div>


     