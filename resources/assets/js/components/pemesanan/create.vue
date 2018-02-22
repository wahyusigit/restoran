<template>
	<div>
		<div v-if="message" class="alert alert-success">
			{{ message }}
		</div>

		<form @submit.prevent="store" action="/pemesanan/add" method="post">
			<div class="row">
				<div class="col-md-4">
					<div :class="['form-group', errors.no_pemesanan ? 'has-error' : '']">
						<label>No. Pemesanan</label>
						<input v-model="state.no_pemesanan" type="text" class="form-control input-lg" readonly="readonly">
						<span v-if="errors.no_pemesanan" class="label label-danger">{{ errors.no_pemesanan[0] }}</span>
					</div>
					<div :class="['form-group', errors.no_meja_pemesanan ? 'has-error' : '']">
						<label>No. Meja</label>
						<input v-model="state.no_meja_pemesanan" type="text" class="form-control input-lg">
						<span v-if="errors.no_meja_pemesanan" class="label label-danger">{{ errors.no_meja_pemesanan[0] }}</span>
					</div>
					<div :class="['form-group', errors.tgl_pemesanan ? 'has-error' : '']">
						<label>Tanggal</label>
						<input v-model="state.tgl_pemesanan" type="date" class="form-control" value="2018-02-16">
						<span v-if="errors.tgl_pemesanan" class="label label-danger">{{ errors.tgl_pemesanan[0] }}</span>
					</div>
				</div>
				<div class="col-md-8">
					<div class="row">
						<div class="form-group col-md-6">
							<label>Nama Makanan / Minuman</label>
							<v-autocomplete :change="loadAutocomplete()" v-model="item" :get-label="getLabel" :item-selected="itemSelected" :item-clicked="itemClicked" :items="items" :component-item='template'>
			  				</v-autocomplete>
						</div>
						<div class="form-group col-md-3">
							<label>Qty</label>
							<input v-model="qty" type="number" class="form-control">
						</div>
						<div class="form-group col-md-3">
							<button @click="addRow(item)" type="button" class="btn btn-app"><i class="fa fa-plus"></i></button>
						</div>
					</div>
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th class="text-center">No.</th>
								<th class="col-md-4 text-center">Nama Menu</th>
								<th class="col-md-2 text-center">Jenis Menu</th>
								<th class="col-md-1 text-center">Qty</th>
								<th class="col-md-2 text-center">Harga</th>
								<th class="col-md-2 text-center">Subtotal</th>
								<th class="col-md-1 text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(detail, index) in pemesanandetails">
								<td>{{ index+1 }}<input v-model="detail.id_menu" type="hidden" class="form-control input-sm" readonly="readonly"></td>
								<td><input v-model="detail.nama_menu" type="text" class="form-control input-sm text-left text-capitalize" readonly="readonly"></td>
								<td><input v-model="detail.jenis_menu" type="text" class="form-control input-sm text-left text-capitalize" readonly="readonly"></td>
								<td><input v-model="detail.qty" type="text" class="form-control input-sm text-center"></td>
								<td><input v-model="detail.harga" type="text" class="form-control input-sm text-right" readonly="readonly"></td>
								<td><input v-model="detail.subtotal" type="text" class="form-control input-sm text-right" readonly="readonly"></td>
								<td><button @click="removeRow(index, detail.subtotal)" type="button" class="btn btn-default"><i class="fa fa-trash"></i></button></td>
							</tr>
							<tr>
								<td colspan="4"></td>
								<td class="text-right">Total: </td>
								<td class="text-right h4">{{ total }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="form-group clearfix">
				<div class="pull-right">
					<button class="btn btn-primary">Simpan<i class="fa fa-save"></i></button>	
				</div>
				<div class="pull-left">
					<router-link :to="{ name: 'pemesananIndex' }">
						<button type="button" class="btn btn-default"><i class="fa fa-arrow-left"></i>Kembali</button>
					</router-link>
				</div>
			</div>
		</form>
		
	</div>
</template>

<script>
	import css from 'v-autocomplete/dist/v-autocomplete.css';
	import ItemTemplate from '../../components/ItemTemplate.vue';
	var numeral = require("numeral");
  	Vue.filter("formatNumber", function (value) {
    	return numeral(value).format('0,0');
  	});

	export default {
		data() {
			return {
				errors: [],
				pemesanan: [],
				pemesanandetails: [],
				state: {
					no_pemesanan:'',
					id_user:1,
					no_meja_pemesanan:'',
					tgl_pemesanan:'',
					ttl_hrg_pemesanan:'',
					status_pembayaran:'',
					status_pemesanan:'',
				},
				message : '',

				item: {
						id_menu:'',
						nama_menu:'',
						jenis_menu:'',
						qty:'',
						harga:'',
						subtotal:''
				},
				itemx: '',
				items: [],
				template: ItemTemplate,

				selected_item : '',
				qty : '',
				subtotal : 0,
				total : 0,
			}
		},
		mounted() {
			axios.get('/pemesanan/add').then(response => {
				this.state.no_pemesanan = response.data;
			});

			axios.get('/daftarmenu/datas').then(response => {
				this.items = response.data;
			});
		},
		methods: {
			store(e) {
				axios.post(e.target.action, this.state).then(response => {
					this.errors = [];

					this.state = {
						no_pemesanan:'',
						id_user:1,
						no_meja_pemesanan:'',
						tgl_pemesanan:'',
						ttl_hrg_pemesanan:'',
						status_pembayaran:'',
						status_pemesanan:'',
					}

					this.message = 'Menu Makanan/Minuman sudah ada.';
				}).catch(error => {
					if (! _.isEmpty(error.response)) {
						if (error.response.status = 422) {
							this.errors = error.response.data;
						}
					}
				});
			},

			loadAutocomplete(item){
				// this.item.nama_menu = 'asddddd';
				
				// axios.get('/daftarmenu/datas').then((response) => {
					// this.items = response;
				// });
			},

	        getLabel(item) {
	        	this.item.nama_menu = item.nama_menu;	
	        	return item.nama_menu;
		    },

		    updateItems(text) {
				axios.get('/daftarmenu/datas').then((response) => {
					alert('asd');
					this.items = response;
				});
		    },

		    itemClicked(item) {
		    	console.log(item);
		    	// this.getLabel(item);
		    	// return this.selected_item = item;
		    },

		    itemSelected() {
		    	console.log(this);
		    	// this.getLabel(item);
		    	// return this.selected_item = item;
		    },

		    addRow(item){
		    	
		    	this.subtotal = item.harga * this.qty;
		    	this.total = this.total + this.subtotal;
				this.pemesanandetails.push(
					{
						id_menu : item.id_menu,
						nama_menu : item.nama_menu,
						jenis_menu : item.jenis_menu,
						qty : this.qty, 
						harga : item.harga,
						subtotal : this.subtotal,
					});
				this.qty = '';
				this.item = '';
			},
			removeRow(index, subtotal){
				this.total = this.total - subtotal;
				this.pemesanandetails.splice(index, 1)
			},
		}
	}
</script>