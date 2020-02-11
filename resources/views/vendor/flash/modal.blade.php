<div id="flash-overlay-modal" class="modal fade text-success {{ isset($modalClass) ? $modalClass : '' }}" role="dialog" aria-labelledby="SavedModal" aria-hidden="true ">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<h5 class="modal-title text-center text-white">{{ $title }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
					<span aria-hidden="true ">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p class="text-center">{!! $body !!}</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
