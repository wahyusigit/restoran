<template>
	<div class="table-responsive">
		<!-- <button v-on:click="showSweetAlert">Hello world</button>
		<alert v-if="message" type="success">
			<strong>Berhasil</strong>
			{{ message }}
		</alert> -->
		<!-- <router-link to="/user/create" class="btn btn-primary">
			<i class="fa fa-plus"></i>   User
		</router-link> -->
		<div class="form-group clearfix">
			<div class="col-md-6">
				<div class="input-group input-group-sm">
				<input type="text" class="form-control" v-model="search_val">
				    <span class="input-group-btn">
						<button @click="search" type="button" class="btn btn-info btn-flat">Cari</button>
				    </span>
				</div>
			</div>
			<button class="btn btn-default btn-sm pull-right" @click="addUser"><i class="fa fa-plus"></i>Add User</button>
		</div>
		<hr>
		<table class="table">
			<thead>
				<tr>
					<th>No.</th>
					<th>Nama lengkap</th>
					<th>Email</th>
					<th class="text-center">Actions</th>
				</tr>
			</thead>

			<tbody>
				<tr v-for="(user, index) in users.data">
					<td>{{ users.from + index }}</td>
					<td>{{ user.name }} </td>
					<td>{{ user.email }} </td>
					<td class="text-center">
						<button @click="showUser(user)" class="btn btn-default btn-sm"><i class="fa fa-folder-o"></i></button>
						<button @click="softDelete(user.id_user)" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> </button>
					</td>
				</tr>
			</tbody>
		</table>
		
		<ul class="pagination">
			<li v-if="users.prev_page_url">
				<a @click.prevent="paginate(users.prev_page_url)" :href="users.prev_page_url">&laquo; Previous</a>
			</li>
			<li v-if="users.next_page_url">
				<a @click.prevent="paginate(users.next_page_url)" :href="users.next_page_url">Next &raquo;</a>
			</li>
		</ul>

		<modal title="modalTitle" :show.sync="showModal" :backdrop="false" effect="zoom" >
		    <div slot="modal-header" class="modal-header">
		      <h4 class="modal-title">{{ modalTitle }}</b></h4>
		    </div>
		    <div slot="modal-body" class="modal-body">
		    	<form @submit.prevent="store" action="/user" method="post">
				<input type="hidden" name="id_user" v-model="state.id_user" >
		        <div :class="['form-group', errors.name ? 'has-error' : '']">
		          <label>Nama Lengkap</label>
		          <input v-model="state.name" type="text" class="form-control" :disabled="disableInput">
		          <span v-if="errors.name" class="label label-danger">{{ errors.name[0] }}</span>
		        </div>

		        <div :class="['form-group', errors.email ? 'has-error' : '']">
		          <label>Email</label>
		          <input v-model="state.email" type="email" class="form-control" :disabled="disableInput">
		          <span v-if="errors.email" class="label label-danger">{{ errors.email[0] }}</span>
		        </div>
		        <div class="form-group clearfix">
		        	<button @click="showModal = false" type="button" class="btn btn-default pull-left"><i class="fa fa-close"></i>Close</button>
			      	<button type="submit" class="btn btn-primary pull-right" v-if="disableInput === false">Simpan<i class="fa fa-save"></i></button>
			      	<button type="button" @click="disableInput = false" class="btn btn-default pull-right" v-if="disableInput === true">Ubah<i class="fa fa-edit"></i></button>
		      	</div>
		        </form>
		    </div>
		    <div slot="modal-footer" class="modal-footer">
		      
		      <!-- <router-link :to="{ name: 'userIndex' }">
		        <button type="button" class="btn btn-default">Kembali</button>
		      </router-link> -->
		    </div>
		</modal>
	</div>
</template>

<script>
	var modal = require('vue-strap').modal;
	var alert = require('vue-strap').alert;
	var swal = require('vue-sweetalert2').alert;

	export default {
		components: {
			modal,
			alert
		},
		data() {
			return {
				users: [],
				errors: [],
				user: [],
				state: {
					id_user:'',
					name: '',
					email: ''
				},
				message : '',
				showModal: false,
				fadeModal: false,
				zoomModal: false,
				showCustomModal: false,
				largeModal: false,
				smallModal: false,
				modalTitle: '',
				modalBody: '',
				modalFooter: '',
				disableInput: false,
				search_val : ''
			}
		},

		mounted() {
			axios.get('/user/paginate').then(response => {
				this.users = response.data;
			});
		},

		methods: {

			paginate(url) {
				axios.get(url).then(response => {
					this.users = response.data;
				})
			},
			store(e) {
				axios.post(e.target.action, this.state).then(response => {
					this.errors = [];
					this.emptyState();
					this.message = 'User has been created.';
				}).catch(error => {
					if (! _.isEmpty(error.response)) {
						if (error.response.status = 422) {
							this.errors = error.response.data;
							this.showSweetAlert('User not created.','error');
							this.emptyState();
						}
					}
				});
				this.showModal = !this.showModal;
				this.refresh();
				this.showSweetAlert('User has been created.','success');

			},
			softDelete(id_user) {
				axios.get('/user/delete/' + id_user).then(response => {
					this.errors = [];

					this.emptyState();
					this.message = 'User has been deleted.';
				}).catch(error => {
					if (! _.isEmpty(error.response)) {
						if (error.response.status = 422) {
							this.errors = error.response.data;
						}
					}
				});
				this.refresh();
				this.showSweetAlert('User has been deleted.','success');
			},
			refresh(){
				axios.get('/user/paginate').then(response => {
					this.users = response.data;
				});
			},
			showSweetAlert(message='',type=''){
	            // Use sweetalret2
	            this.$swal({
							  text: message,
							  showConfirmButton: false,
							  timer: 1500,
							  type: type,
							  showCloseButton: true
							});
	        },
	        addUser(){
	        	this.emptyState();
				this.disableInput = false;
	        	this.showModal = true;
	        },
	        showUser(user){
	        	this.state = user;
	        	this.disableInput = true;
	        	this.showModal = true;
	        },
	        emptyState(){
	        	this.state = {
	        			id_user: '',
						name: '',
						email: ''
					}
	        },
	        search(){
	        	axios.get('/user/search/' + this.search_val).then(response => {
				this.users = response.data;
			});
	        }

		}
	}
</script>