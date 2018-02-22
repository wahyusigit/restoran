<template>
	<div>
		<div v-if="message" class="alert alert-success">
			{{ message }}
		</div>

		<form @submit.prevent="store" action="/daftarmenu" method="post">
			<div :class="['form-group', errors.nama_menu ? 'has-error' : '']">
				<label>Nama Makanan/Minuman</label>
				<input v-model="state.nama_menu" type="text" class="form-control">
				<span v-if="errors.nama_menu" class="label label-danger">{{ errors.nama_menu[0] }}</span>
			</div>

			<div :class="['form-group', errors.email ? 'has-error' : '']">
				<label>Email</label>
				<input v-model="state.email" type="email" class="form-control">
				<span v-if="errors.email" class="label label-danger">{{ errors.email[0] }}</span>
			</div>

			<div class="form-group">
				<button class="btn btn-primary">Submit</button>
				<router-link :to="{ name: 'daftarMenuIndex' }">Back to index</router-link>
			</div>
		</form>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				errors: [],
				daftarmenu: [],
				state: {
					nama_menu: '',
					jenis_menu: ''
				},
				message : ''
			}
		},

		methods: {
			store(e) {
				axios.post(e.target.action, this.state).then(response => {
					this.errors = [];

					this.state = {
						nama_menu: '',
						jenis_menu: ''
					}

					this.message = 'Menu Makanan/Minuman sudah ada.';
				}).catch(error => {
					if (! _.isEmpty(error.response)) {
						if (error.response.status = 422) {
							this.errors = error.response.data;
						}
					}
				});
			}
		}
	}
</script>