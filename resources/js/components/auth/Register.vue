<template>
<transition enter-active-class="animated fadeInRight" leave-active-class="animated fadeOutRight" :duration="500">
	<div class="container">
		<div class="auth-page auth-register">
			<div v-if="show_spinner" class="loading-spinner">
				<loading-spinner/>
			</div>
			<div v-else-if="show_error" class="page-error">
				<loading-error :type="show_error" />
			</div>
			<div v-else>
				<div class="row">
					<div class="col-lg-9 mr-auto ml-auto">
						<div class="register-form">
							<form>
								<div class="form-group">
									<label>{{ trans('text.user_login')}}</label>
									<input type="text" name="user_login"  class="form-control" v-model="user_login" @keydown='errors.clear("user_login")'>
									<small class="form-text text-danger" v-if="errors.has('user_login')">{{errors.get('user_login')}}</small>
								</div>

                                <div class="form-group">
									<label>{{ trans('text.user_email')}}</label>
									<input type="text" name="user_email"  class="form-control" v-model="user_email" @keydown='errors.clear("user_email")'>
									<small class="form-text text-danger" v-if="errors.has('user_email')">{{errors.get('user_email')}}</small>
								</div>

								<div class="form-group">
									<label>{{ trans('text.password')}}</label>
									<input type="password" name="password"  class="form-control" v-model="password" @keydown='errors.clear("password")'>
									<small class="form-text text-danger" v-if="errors.has('password')">{{errors.get('password')}}</small>
								</div>
								<div class="form-group">
									<label>{{ trans('text.confirm-password')}}</label>
									<input type="password" name="password_confirmation"  class="form-control" v-model="password_confirmation" @keydown='errors.clear("password_confirmation")'>
									<small class="form-text text-danger" v-if="errors.has('password_confirmation')">{{errors.get('password_confirmation')}}</small>
								</div>


                                <div class="form-group">
									<label>{{ trans('text.display_name')}}</label>
									<input type="text" name="display_name"  class="form-control" v-model="display_name" @keydown='errors.clear("display_name")'>
									<small class="form-text text-danger" v-if="errors.has('display_name')">{{errors.get('display_name')}}</small>
								</div>
                                <div class="form-group">
									<label>{{ trans('text.user_url')}}</label>
									<input type="text" name="user_url"  class="form-control" v-model="user_url" @keydown='errors.clear("user_url")'>
									<small class="form-text text-danger" v-if="errors.has('user_url')">{{errors.get('user_url')}}</small>
								</div>
								<div class="form-group">
									<div class="col-md-8 offset-md-4">
										<button type="button" class="btn btn-primary btn-submit" @click="submitLogin()">{{trans('text.register')}}</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</transition>
</template>
<script>
const Errors = require('../../errors.js');

export default {
	data() {
		return {
			errors: new Errors(),
			show_spinner: false,
			show_error: false,
			user_login: '',
			user_nicename: '',
			user_email: '',
			password: '',
			password_confirmation: '',
			display_name: '',
			user_url: '-',
		};
	},
	methods: {
		submitLogin() {
			var self = this;
			var data = {
				user_nicename: this.user_nicename,
				user_login: this.user_login,
				user_email: this.user_email,
				password: this.password,
				password_confirmation: this.password_confirmation,
				display_name: this.display_name,
				user_url: this.user_url,
			};

			axios.post(self.prefix + 'register', data)
				.then(function(response) {
					self.$router.go(-1);
					self.$store.state.Auth = response.data.user;
					axios.defaults.headers.common['X-CSRF-TOKEN'] = response.data.csrf_token;
				})
				.catch(function(error) {
					self.errors.record(error)
				});
		},
	}
}
</script>
