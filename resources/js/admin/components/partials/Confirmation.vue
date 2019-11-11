<template>
<div id="confirm_model" v-if="Auth !== null" class="modal delet-modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<h4 class="modal-title text-center" id="myModalLabel">{{ trans('text.are-you-sure')}}</h4>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info bg-teal btn-sm btn-block" data-dismiss="modal">{{ trans('text.no')}}</button>
				<button type="button" class="btn btn-danger btn-sm px-4" @click="confirm()">{{ trans('text.yes')}}</button>
			</div>
		</div>
	</div>
</div>
</template>
<script>
export default {
	methods: {
		confirm: function() {
			$('#confirm_model').modal('hide');
			Event.$emit('confirmed');
		},
	},
	mounted() {
		Event.$on('confirm', function() {
			console.log('askk');
			$('#confirm_model').modal('show');
		});
	}
};
</script>
