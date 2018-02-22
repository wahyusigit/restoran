<template>
	<div class="row">

		<div v-if="notFound" class="col-md-12">
			<div  class="alert alert-warning">
				{{ message }}
			</div>			
		</div>

        <div v-if="! notFound" class="col-xs-12 col-sm-6 col-md-12">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-12">
                        <h4>
                            {{ daftarmenu.nama_menu }}
                        </h4>
                        <p>
                            <i class="glyphicon glyphicon-envelope"></i>{{ daftarmenu.jenis_menu }}
                            <br />

                            <i class="glyphicon glyphicon-gift"></i>{{ daftarmenu.created_at }}</p>
                        <!-- Split button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary">
                                Social</button>
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span><span class="sr-only">Social</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Twitter</a></li>
                                <li><a href="https://plus.google.com/+Jquery2dotnet/posts">Google +</a></li>
                                <li><a href="https://www.facebook.com/jquery2dotnet">Facebook</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Github</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <router-link :to="{ name: 'daftarMenuIndex' }">Back to index</router-link>
        </div>
    </div>
</template>

<script>
	export default {
		data() {
			return {
				notFound: false,
				message: '',
				daftarmenu: []
			}
		},

		mounted() {
			// get by user id
			const url = "/daftarmenu/" + this.$route.params.id_menu;
			axios.get(url).then(response => {
				this.daftarmenu = response.data;
				this.notFound = false;
				console.log(this.daftarmenu);
			}).catch(error => {
				if (error.response.status == 404) {
					this.notFound = true;
					this.message = error.response.data.message;
				}
			});
		}
	}
</script>

<style type="text/css" scoped>
body{
	padding-top:30px;
}

.glyphicon {  margin-bottom: 10px;margin-right: 10px;}

small {
	display: block;
	line-height: 1.428571429;
	color: #999;
}
</style>