<template>
<transition enter-active-class="animated fadeInRight" leave-active-class="animated fadeOutRight" :duration="500">
	<div class="container">
		<div class="auth-page auth-login">
			<div v-if="show_spinner" class="loading-spinner">
				<loading-spinner/>
			</div>
			<div v-else-if="show_error" class="page-error">
				<loading-error :type="show_error" />
			</div>
			<div v-else>

				<div class="row">
					<div class="col-lg-9 mr-auto ml-auto">
						<div class="login-form">
							<form>
								<div class="form-group">
									<label>{{ trans('text.email')}}</label>
									<input type="text" name="email"  class="form-control" v-model="email" @keydown='errors.clear("email")'>
									<small class="form-text text-danger" v-if="errors.has('email')">{{errors.get('email')}}</small>
								</div>
								<div class="form-group">
									<label>{{ trans('text.password')}}</label>
									<input type="password" name="password"  class="form-control" v-model="password" @keydown='errors.clear("password")'>
									<small class="form-text text-danger" v-if="errors.has('password')">{{errors.get('password')}}</small>
								</div>
								<div class="form-group">
									<div class="col-md-8 offset-md-4">
										<button type="button" class="btn btn-primary btn-submit" @click="submitLogin()">{{trans('text.login')}}</button>
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
			email: '',
			password: '',
		};
	},
	methods: {
		submitLogin() {
			var self = this;
			var data = {
				email: this.email,
				password: this.password,
				//_token: this.$store.state.csrfToken,
			};

			axios.post(self.prefix + 'login', data)

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
