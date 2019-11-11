<template>
<div class="card">
    <form role="form" @submit.prevent="storeSupplier()">
        <div class="card-header">
            <h3 v-if="action == 'edit'" class="card-title">{{ trans('text.edit-role')}}</h3>
            <h3 v-else class="card-title">{{ trans('text.add-role')}}</h3>
        </div>
        <div class="card-body">
					<div class="form-group row">
							<label class="col-lg-2 col-form-label">{{ trans('text.name')}}</label>
							<div class="col-lg-5">
									<input type="text" name="first_name" :placeholder="trans('text.first_name')" class="form-control" v-model="role.first_name" @keydown='errors.clear("first_name")'>
									<small class="form-text text-danger" v-if="errors.has('first_name')">{{errors.get('first_name')}}</small>
							</div>
							<div class="col-lg-5">
									<input type="text" name="last_name" :placeholder="trans('text.last_name')" class="form-control" v-model="role.last_name" @keydown='errors.clear("last_name")'>
									<small class="form-text text-danger" v-if="errors.has('last_name')">{{errors.get('last_name')}}</small>
							</div>
					</div>
					<div class="form-group row">
							<label class="col-lg-2 col-form-label">{{ trans('text.gender')}}</label>
							<div class="col-lg-2">
									<div class="custom-control custom-radio custom-control-inline">
											<input type="radio" id="radioMale" name="gender" value="male" v-model="role.gender" class="custom-control-input">
											<label class="custom-control-label" for="radioMale">{{ trans('text.male')}}</label>
									</div>
									<div class="custom-control custom-radio custom-control-inline">
											<input type="radio" id="radiofemale" name="gender" value="female" v-model="role.gender" class="custom-control-input">
											<label class="custom-control-label" for="radiofemale">{{ trans('text.female')}}</label>
									</div>
									<small class="form-text text-danger" v-if="errors.has('gender')">{{errors.get('gender')}}</small>
							</div>
							<label class="col-lg-2 col-form-label">{{ trans('text.birthday')}}</label>
							<div class="col-lg-2">
									<input type="date" name="birthday" class="form-control" v-model="role.birthday" @keydown='errors.clear("birthday")'>
									<small class="form-text text-danger" v-if="errors.has('birthday')">{{errors.get('birthday')}}</small>
							</div>
					</div>
					<div class="form-group row">
							<label class="col-lg-2 col-form-label">{{ trans('text.email')}}</label>
							<div class="col-lg-10">
									<input type="text" name="email" class="form-control" v-model="role.email" @keydown='errors.clear("email")'>
									<small class="form-text text-danger" v-if="errors.has('email')">{{errors.get('email')}}</small>
							</div>
					</div>
					<div class="form-group row">
							<label class="col-lg-2 col-form-label">{{ trans('text.tel')}}</label>
							<div class="col-lg-5">
									<input type="text" name="tel" class="form-control" v-model="role.tel" @keydown='errors.clear("tel")'>
									<small class="form-text text-danger" v-if="errors.has('tel')">{{errors.get('tel')}}</small>
							</div>
							<label class="col-lg-1 col-form-label">{{ trans('text.fax')}}</label>
							<div class="col-lg-4">
									<input type="text" name="fax" class="form-control" v-model="role.fax" @keydown='errors.clear("fax")'>
									<small class="form-text text-danger" v-if="errors.has('fax')">{{errors.get('fax')}}</small>
							</div>
					</div>
					<div class="form-group row">
							<label class="col-lg-2 col-form-label">{{ trans('text.address')}}</label>
							<div class="col-lg-10">
									<textarea name="address" class="form-control" v-model="role.address" rows="2" @change='errors.clear("address")' maxlength="50"></textarea>
									<small class="form-text text-danger" v-if="errors.has('address')">{{errors.get('address')}}</small>
							</div>
					</div>
					<div class="form-group row">
							<label class="col-lg-2 col-form-label">{{ trans('text.image')}}</label>
							<div class="col-lg-2">
									<upload-image @uploaded="imageUploaded" :nbr="1" :type="'images'" :image_path="role.image_path" :image_id="role.image_id"></upload-image>
									<small class="form-text text-danger" v-if="errors.has('image')">{{errors.get('image')}}</small>
							</div>
					</div>
					<div class="form-group row">
							<label class="col-lg-2 col-form-label">{{ trans('text.qualification')}}</label>
							<div class="col-lg-10">
									<textarea name="qualification" class="form-control" v-model="role.qualification" rows="3" @change='errors.clear("qualification")'></textarea>
									<small class="form-text text-danger" v-if="errors.has('qualification')">{{errors.get('qualification')}}</small>
							</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-2 col-form-label">{{ trans('text.password')}}</label>
						<div class="col-lg-5">
								<input type="password" name="password" class="form-control" v-model="role.password" @keydown='errors.clear("password")'>
								<small class="form-text text-danger" v-if="errors.has('passwords')">{{errors.get('password')}}</small>
						</div>
							<label class="col-lg-2 col-form-label">{{ trans('text.recruitment_date')}}</label>
							<div class="col-lg-2">
									<input type="date" name="recruitment_date" class="form-control" v-model="role.recruitment_date" @keydown='errors.clear("recruitment_date")'>
									<small class="form-text text-danger" v-if="errors.has('qualification')">{{errors.get('recruitment_date')}}</small>
							</div>
					</div>
					<div class="form-group row">
							<label class="col-lg-2 col-form-label">{{ trans('text.note')}}</label>
							<div class="col-lg-10">
									<textarea name="note" class="form-control" v-model="role.note" rows="3" @change='errors.clear("note")'></textarea>
									<small class="form-text text-danger" v-if="errors.has('note')">{{errors.get('note')}}</small>
							</div>
					</div>
        </div>
        <div class="card-footer text-right">
            <button v-if="action == 'edit'" type="submit" class="btn btn-primary btn-sm ">{{ trans('text.update')}}</button>
            <button v-else type="submit" class="btn btn-primary btn-sm ">{{ trans('text.add')}}</button>
        </div>
    </form>
</div>
</template>
<script>
const Errors = require('../../../errors.js');

import {
    fr
} from 'vuejs-datepicker/dist/locale'
import Datepicker from 'vuejs-datepicker';
import moment from 'moment';

export default {
    props: ['action', 'role'],
    data() {
        return {
            errors: new Errors(),
            locale: fr,
        };
    },
    components: {
        Datepicker,
    },
    methods: {
        imageUploaded(image) {
            this.role.image = image;
        },

        toDate(date) {
            if (!date) {
                return null;
            } else {
                return moment(date).format('YYYY-MM-DD HH:mm:ss');
            }
        },

        storeSupplier() {
            var self = this;
            var data = this.role;
            data.birthday = this.toDate(this.role.birthday);

            if (this.action == 'edit') {
                axios.put('/api/roles/' + this.role.id, data)
                    .then((response) => {
                        self.$router.push('/admin/roles/' + response.data.employee.id);
                        Event.$emit('notify', self.trans('text.role-edited'), 'success', self.trans('text.success'));
                    })
                    .catch((error) => {
                        self.errors.record(error);
                        Event.$emit('notify', self.trans('text.role-not-edited'), 'warning', self.trans('text.warning'));
                    });
            } else {
                axios.post('/api/roles', data)
                    .then((response) => {
                        self.$router.push('/admin/roles/' + response.data.employee.id);
                        Event.$emit('notify', self.trans('text.role-added'), 'success', self.trans('text.success'));
                    })
                    .catch((error) => {
                        console.log(error);
                        self.errors.record(error);
                        Event.$emit('notify', self.trans('text.role-not-added'), 'warning', self.trans('text.warning'));
                    });
            }

        },
    },
}
</script>
