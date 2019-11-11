<template></template>
<script>
import VueIziToast from 'vue-izitoast'
import 'izitoast/dist/css/iziToast.min.css';
export default {
	template: 'app',
	name: 'app',
	props: [
		'active',
		'message',
		'type',
		'title'
	],
	data() {
		return {
			notification: {
				message: this.message,
				type: this.type,
				title: this.title,
			}
		};
	},
	methods: {
		showNotification: function() {
			switch (this.notification.type) {
				case 'danger':
					this.icon = 'danger.svg';
					this.progressBarColor = '#f94c54';
					this.iconColor = '#f95f66';
					break;
				case 'info':
					this.icon = 'info.svg';
					this.progressBarColor = '#28a8f2';
					this.iconColor = '#5ac5f2';
					break;
				case 'success':
					this.icon = 'success.svg';
					this.progressBarColor = '#80c316';
					this.iconColor = '#a8d65f';
					break;
				case 'warning':
					this.icon = 'warning.svg';
					this.progressBarColor = '#f5b10c';
					this.iconColor = '#f0b651';
					break;
			}
			this.$toast.show(this.notification.message, this.notification.title, {
				rtl: true,
				icon: '',
				image: '/img/icons/' + this.icon,
				imageWidth: 55,
				iconColor: this.iconColor,
				theme: 'dark',
				transitionIn: 'flipInX',
				progressBarColor: this.progressBarColor
			});
		},
	},
	mounted() {
		if (this.active == 'true') {
			this.showNotification();
		}
	},
	created() {
		var self = this;
		Event.$on('notify', function(message, type, title) {
			self.notification.message = message;
			self.notification.type = type;
			self.notification.title = title;
			self.showNotification();
		});
	}
};
</script>
