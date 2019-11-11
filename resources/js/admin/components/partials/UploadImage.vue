<template>
<div class="image-uploader">
	<div :id="'imageUploader_' + nbr" class="dropzone"></div>
</div>
</template>
<script>
import Dropzone from 'dropzone'
export default {
	props: ['image_id', 'image_path', 'type', 'nbr'],
	data() {
		return {
			image_input: this.image_id,
		};
	},

	watch: {
		image_input: function() {
			this.$emit('uploaded', this.image_input);
		}
	},

	mounted() {
		var self = this;
		var myDropzone = new Dropzone("#imageUploader_" + this.nbr, {
			url: '/api/images/upload?type=' + this.type + '&_token=' + App.csrfToken,
			thumbnailWidth: 150,
			maxFilesize: 0.5,
			uploadMultiple: false,
			multiple: false,
			addRemoveLinks: true,
			maxFiles: 1,
			dictDefaultMessage: self.trans('text.dict-default-message'),
			dictFallbackMessage: self.trans('text.dict-fallback-message'),
			dictFallbackText: self.trans('text.dict-fallback-text'),
			dictFileTooBig: self.trans('text.dict-file-too-big'),
			dictInvalidFileType: self.trans('text.dict-invalid-file-type'),
			dictResponseError: self.trans('text.dict-response-error'),
			dictCancelUpload: self.trans('text.dict-cancel-upload'),
			dictUploadCanceled: self.trans('text.dict-upload-canceled'),
			dictCancelUploadConfirmation: self.trans('text.dict-cancel-upload-confirmation'),
			dictRemoveFile: self.trans('text.dict-remove-file'),
			dictMaxFilesExceeded: self.trans('text.dict-max-files-exceeded'),
			acceptedFiles: 'image/png,image/jpeg,image/jpg',
			headers: {
				"My-Awesome-Header": "header value"
			},
			init: function() {
				this.on("success", function(file, response) {
					self.image_input = response.path ; 
					this.disable();
				});
				this.on("removedfile", function(file) {
					self.image_input = '' ;
					this.enable();
				});
				if (self.image_id) {
					var mockFile = { name: self.image_path.substring(self.image_path.lastIndexOf("/") + 1), size: 12345 };
					this.emit("addedfile", mockFile);
					this.emit("thumbnail", mockFile, '/uploads/' + self.type + '/sm/' + self.image_path);
					this.emit("complete", mockFile);
					this.disable();
				}
			}
		});
	}
}
</script>
