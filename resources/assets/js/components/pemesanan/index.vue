<template>
	<div class="table-responsive">
		<!-- <button v-on:click="showSweetAlert">Hello world</button>
		<alert v-if="message" type="success">
			<strong>Berhasil</strong>
			{{ message }}
		</alert> -->


		<router-link to="/pemesanan/create" class="btn btn-primary">
			<i class="fa fa-plus"></i>Pemesanan
		</router-link>
		<hr>
		<table class="table">
			<thead>
				<tr>
					<th>No.</th>
					<th>Nama</th>
					<th>Jenis</th>
					<th>Harga</th>
					<th>Status</th>
					<th class="text-center">Actions</th>
				</tr>
			</thead>

			<tbody>
				<tr v-for="(pemesanan, index) in daftarmenus.data">
					<td>{{ daftarmenus.from + index }}</td>
					<td>{{ pemesanan.nama_menu }} </td>
					<td>{{ pemesanan.jenis_menu }} </td>
					<td>{{ pemesanan.harga }} </td>
					<td>{{ pemesanan.status_menu }} </td>
					<td>{{ pemesanan.email }} </td>
					<td class="text-center">
						<button @click="showPemesanan(pemesanan)" class="btn btn-default btn-sm"><i class="fa fa-folder-o"></i></button>
						<button @click="softDelete(pemesanan.id_menu)" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> </button>
					</td>
				</tr>
			</tbody>
		</table>
		
		<ul class="pagination">
			<li v-if="daftarmenus.prev_page_url">
				<a @click.prevent="paginate(daftarmenus.prev_page_url)" :href="daftarmenus.prev_page_url">&laquo; Previous</a>
			</li>
			<li v-if="daftarmenus.next_page_url">
				<a @click.prevent="paginate(daftarmenus.next_page_url)" :href="daftarmenus.next_page_url">Next &raquo;</a>
			</li>
		</ul>

		<modal title="modalTitle" :show.sync="showModal" :backdrop="false" effect="zoom" >
		    <div slot="modal-header" class="modal-header">
		      <h4 class="modal-title">{{ modalTitle }}</b></h4>
		    </div>
		    <div slot="modal-body" class="modal-body">
		    	<form @submit.prevent="store" action="/pemesanan" method="post">
				<input type="hidden" name="id_menu" v-model="state.id_menu" >
		        <div :class="['form-group', errors.nama_menu ? 'has-error' : '']">
		          <label>Nama Menu</label>
		          <input v-model="state.nama_menu" type="text" class="form-control" :disabled="disableInput">
		          <span v-if="errors.nama_menu" class="label label-danger">{{ errors.nama_menu[0] }}</span>
		        </div>

		        <div :class="['form-group', errors.jenis_menu ? 'has-error' : '']">
		          <label>Jenis Menu</label>
		          <!-- <input v-model="state.jenis_menu" type="text" class="form-control" :disabled="disableInput"> -->
		          <select v-model="state.jenis_menu" class="form-control text-capitalize" :disabled="disableInput">>
					<option disabled :value="state.jenis_menu">{{ state.jenis_menu }}</option>
					<option value="minuman">Minuman</option>
					<option value="makanan">Makanan</option>
				  </select>
		          <span v-if="errors.jenis_menu" class="label label-danger">{{ errors.jenis_menu[0] }}</span>
		        </div>

		        <div :class="['form-group', errors.harga ? 'has-error' : '']">
		          <label>Harga</label>
		          <input v-model="state.harga" type="text" class="form-control" :disabled="disableInput">
		          <span v-if="errors.harga" class="label label-danger">{{ errors.harga[0] }}</span>
		        </div>

		        <div :class="['form-group', errors.status_menu ? 'has-error' : '']">
		          <label>Status</label>
		          <!-- <input v-model="state.status_menu" type="text" class="form-control" :disabled="disableInput"> -->
		          <select v-model="state.status_menu" class="form-control text-capitalize" :disabled="disableInput">>
					<option disabled :value="state.status_menu">{{ state.status_menu }}</option>
					<option value="ready">Ready</option>
					<option value="not ready">Not Ready</option>
				  </select>
		          <span v-if="errors.status_menu" class="label label-danger">{{ errors.status_menu[0] }}</span>
		        </div>

		        <!-- <div :class="['form-group', errors.email ? 'has-error' : '']">
		          <label>Email</label>
		          <input v-model="state.email" type="email" class="form-control" :disabled="disableInput">
		          <span v-if="errors.email" class="label label-danger">{{ errors.email[0] }}</span>
		        </div> -->
		        <div class="form-group clearfix">
		        	<button @click="showModal = false" type="button" class="btn btn-default pull-left"><i class="fa fa-close"></i>Close</button>
			      	<button type="submit" class="btn btn-primary pull-right" v-if="disableInput === false">Simpan<i class="fa fa-save"></i></button>
			      	<button type="button" @click="disableInput = false" class="btn btn-default pull-right" v-if="disableInput === true">Ubah<i class="fa fa-edit"></i></button>
		      	</div>
		        </form>
		    </div>
		    <div slot="modal-footer" class="modal-footer">
		      
		      <!-- <router-link :to="{ name: 'daftarmenuIndex' }">
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
				daftarmenus: [],
				errors: [],
				pemesanan: [],
				state: {
					no_pemesanan:'',
					id_user:'',
					no_meja_pemesanan:'',
					tgl_pemesanan:'',
					ttl_hrg_pemesanan:'',
					status_pembayaran:'',
					status_pemesanan:'',
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
				search_val : '',

				
			}
		},

		mounted() {
			axios.get('/pemesanan/paginate').then(response => {
				this.daftarmenus = response.data;
			});
		},

		methods: {
			paginate(url) {
				axios.get(url).then(response => {
					this.daftarmenus = response.data;
				})
			},
			store(e) {
				axios.post(e.target.action, this.state).then(response => {
					this.errors = [];
					this.emptyState();
					this.message = 'Pemesanan has been created.';
				}).catch(error => {
					if (! _.isEmpty(error.response)) {
						if (error.response.status = 422) {
							this.errors = error.response.data;
							this.showSweetAlert('Pemesanan not created.','error');
							this.emptyState();
						}
					}
				});
				this.showModal = !this.showModal;
				this.refresh();
				this.showSweetAlert('Pemesanan has been created.','success');

			},
			softDelete(id_menu) {
				axios.get('/pemesanan/delete/' + id_menu).then(response => {
					this.errors = [];

					this.emptyState();
					this.message = 'Pemesanan has been deleted.';
				}).catch(error => {
					if (! _.isEmpty(error.response)) {
						if (error.response.status = 422) {
							this.errors = error.response.data;
						}
					}
				});
				this.refresh();
				this.showSweetAlert('Pemesanan has been deleted.','success');
			},
			refresh(){
				axios.get('/pemesanan/paginate').then(response => {
					this.daftarmenus = response.data;
				});
				this.search_val = '';
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
	        addPemesanan(){
	        	this.emptyState();
				this.disableInput = false;
	        	this.showModal = true;
	        },
	        showPemesanan(pemesanan){
	        	this.state = pemesanan;
	        	this.disableInput = true;
	        	this.showModal = true;
	        },
	        emptyState(){
	        	this.state = {
						no_pemesanan:'',
						id_user:'',
						no_meja_pemesanan:'',
						tgl_pemesanan:'',
						ttl_hrg_pemesanan:'',
						status_pembayaran:'',
						status_pemesanan:'',
					}
	        },
	        search(){
	        	axios.get('/pemesanan/search/' + this.search_val).then(response => {
				this.daftarmenus = response.data;
			});
	        },
		}
	}

</script>