<template>
	<div>
		<div class="row">
			<!-- Listings -->
			<div class="col-lg-12 col-md-12">
				<div class="dashboard-list-box margin-top-0">
					<h4>Услуги</h4>
					<ul>
						<li v-for="(service, index) in services" :key="service.id">
							<div class="list-box-listing">
								<div class="list-box-listing-img">
									<router-link tag="a" :to="'service/edit/' + service.id">
										<img :src="service.image_url" alt>
									</router-link>
								</div>
								<div class="list-box-listing-content">
									<div class="inner">
										<h3>
                                            <router-link tag="a" :to="'service/edit/' + service.id">{{ service.name }}</router-link>

											<!-- <a href="#">{{ service.name }}</a> -->
										</h3>
									</div>
								</div>
							</div>
							<div class="buttons-to-right">
								<router-link class="button gray" :to="'/service/edit/' +  service.id">
									<i class="sl sl-icon-note"></i>
								</router-link>
								<a @click="alertDeleteService(service.id, index)" class="button gray">
									<i class="sl sl-icon-close"></i>
								</a>
								<a target="_blank" :href="'/service/details/'+service.id" class="button gray">
									<i class="sl sl-icon-globe"></i>
								</a>
							</div>
						</li>
					</ul>
				</div>

			</div>
		</div>
		<vue-toastr ref="mytoast"></vue-toastr>
	</div>
</template>

<script>
	import 'sweetalert2/src/sweetalert2.scss'

	export default {
		name: "ServicesList",
		data() {

			return {
				services: []
			}
		},
		mounted() {
			this.getServices();
			this.$refs.mytoast.defaultPosition = "toast-top-center";
			this.$refs.mytoast.defaultStyle = {'top': '80px'};
		},
		computed: {},
		methods: {
			async getServices() {
				try {
					const res = await axios.get('/vendor/service');
					console.log(res.data);
					this.services = res.data;
				}
				catch (error) {
					console.log(error);
				}

			},
			async deleteService(id, index) {
				try {
					const res = await axios.delete('/vendor/service/' + id);
					this.services.splice(index, 1);
					this.$refs.mytoast.s(
						"Услугата бе изтрита успешно!"
					);
				}
				catch (error) {
					console.log(error)
				}

			},

			async alertDeleteService(id, index) {
				const result = await this.$swal({
					title: "Наистина ли искате да изтриете тази услуга?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					confirmButtonText: "Yes, Delete it!"
				});
				console.log(result.value)

				if (result.value) { // <-- if confirmed
					this.deleteService(id, index);
				}

			},
		}
	}
</script>

<style scoped>

</style>
