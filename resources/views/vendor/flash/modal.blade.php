<div id="flash-overlay-modal" class="modal fade font-fira {{ isset($modalClass) ? $modalClass : '' }}" role="dialog" aria-labelledby="SavedModal" aria-hidden="true ">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-center text-primary">{{ $title }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
					<span aria-hidden="true ">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p class="text-center" style="font-size:1.275em">{!! $body !!}</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">ปิด</button>
			</div>
		</div>
	</div>
</div>
