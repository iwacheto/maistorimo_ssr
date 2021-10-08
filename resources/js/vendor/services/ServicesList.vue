<template>
	<div>

		<AddProjectOrService/>

    	<MobileGreenMenuSmall/>

		<div class="row">
			<!-- Listings -->
			<div class="col-lg-12 col-md-12">
				<div class="dashboard-list-box margin-top-0">
					<h1>Твоите услуги</h1>
					<span>{{ servicesNumber }}</span>
					<ul>
						<li v-for="(service, index) in services" :key="service.id">
							<div class="list-box-listing">
								<div class="list-box-listing-img">
									<router-link :to="'service/edit/' + service.id">
										<img :src="service.image_url" alt>
									</router-link>
								</div>
								<div class="list-box-listing-content">
									<div class="inner">
										<h3>
                                            <router-link :to="'service/edit/' + service.id">{{ service.name }}</router-link>
										</h3>
									</div>
								</div>
							</div>
							<div class="buttons-to-right">
								<router-link class="button gray" :to="'/projects/edit/' + service.id">
									<img src="/images/edit-icon.svg" alt="edit icon">
								</router-link>

								<div class="ver_line"></div>

								<a @click="alertDeleteService(service.id, index)" class="button gray">
									<img src="/images/delete-icon.svg" alt="delete icon">
								</a>

								<div class="ver_line"></div>

								<a target="_blank" :href="'/project/details/'+service.id" class="button gray">
									<img src="/images/web-icon.svg" alt="web site icon">
								</a>
							</div>
						</li>
					</ul>
				</div>

			</div>

			<!-- Copyrights -->
			<div class="col-md-12">
				<div class="copyrights">© 2019 Maistorimo All Rights Reserved.</div>
			</div>
		</div>
		<vue-toastr ref="mytoast"></vue-toastr>
	</div>
</template>

<script>
	import 'sweetalert2/src/sweetalert2.scss'
	import MobileGreenMenuSmall from '../partials/MobileGreenMenuSmall.vue';
	import AddProjectOrService from '../partials/AddProjectOrService.vue';

	export default {
		name: "ServicesList",
		data() {

			return {
				services: [],
				servicesNumber: 0,
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
					
					this.services = res.data;
					// console.log(this.services);
					this.servicesNumber = this.services.length;
					
				}
				catch (error) {
					// console.log(error);
				}

			},
			async deleteService(id, index) {
				try {
					const res = await axios.delete('/vendor/service/' + id + "/delete");
					this.services.splice(index, 1);
					this.$refs.mytoast.s(
						"Услугата бе изтрита успешно!"
					);
				}
				catch (error) {
					console.log(error)
				}

			},
// Наистина ли искате да изтриете тази услуга?
			async alertDeleteService(id, index) {
				const result = await this.$swal({
					title: "Изтриване на услуга",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					confirmButtonText: "Потвърди",
					cancelButtonText: "Откажи"
				});
				console.log(result.value)

				if (result.value) { // <-- if confirmed
					this.deleteService(id, index);
				}

			},
		},
  		components: {
			MobileGreenMenuSmall,
			AddProjectOrService
		}
	}
</script>

<style scoped>

	@media (max-width: 990px) {
		.row {
			background-color: #F7F7F7;
			border-top-left-radius: 25px;
			border-top-right-radius: 25px;
			margin-left: 0px;
			margin-right: 0px;
		}

		.col-lg-12.col-md-12 {
			background-color: #F7F7F7;
			border-top-left-radius: 25px;
			border-top-right-radius: 25px;
		}
		.dashboard-list-box {
			box-shadow: unset;
		}

		h1 {
			background-color: #276955;
			padding: 14px 0px 18px 23px;
			font-style: normal;
			font-weight: normal;
			font-size: 17px;
			line-height: 20px;
			color: #FFFFFF;
			border-radius: 25px;
			margin-left: 18px;
			margin-right: 18px;
			margin-top: 33px;
			box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
			position: relative;
		}
		.dashboard-list-box span {
			position: absolute;
			background-color: #FFFFFF;
			/* padding-top: 13px;
			padding-bottom: 16px;
			padding-left: 20px;
			padding-right: 18px; */
			width: 49px;
			padding: 13px 18px 16px 15px;
			font-style: normal;
			font-weight: 500;
			font-size: 20px;
			line-height: 23px;
			color: #276955;
			top: 0px;
			right: 33px;
			border-radius: 25px;
		}

		.dashboard-list-box ul {
			background-color: #F7F7F7;
		}

		.list-box-listing {
			box-shadow: 0px 2px 4px rgb(0 0 0 / 25%);
			border-radius: 25px;
			padding: 0px;
			max-height: unset;
		}

		.list-box-listing-img {
			position: relative;
			border-radius: 25px;
			height: 150px;
			max-width: unset;
		}

		.list-box-listing-img img {
			border-radius: 25px;
		
		}

		.list-box-listing-img a::before {
			background-color: rgba(22, 22, 22, -0.9);
			box-sizing: border-box;
			box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
		}

		.list-box-listing-content {
			position: absolute;
			z-index: 99;
			top: 114px;
			left: 0px;
			background: #FFFFFF;
			border-radius: 0px 16px 0px 19px;
			width: 250px;
			height: 36px; 
			box-sizing: border-box;
			box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
			border-top: 2px solid #E8E6E6;
			border-right: 2px solid #E8E6E6;
			padding-top: 0px;
			padding-left: 0px;  
		}

		.list-box-listing-content .inner {
			margin-top: 9px;
		}

		.list-box-listing-content .inner h3 {
			font-style: normal;
			font-weight: 500;
			font-size: 12px;
			line-height: 14px;
			color: #276955;
			bottom: 0px;
			margin-left: 14px;
		}

		.buttons-to-right {
			display: flex;
			width: 125px;
			background-color: #276955;
			border-radius: 57px;
			box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
		}

		.dashboard-list-box .button.gray {
			background-color: #276955;
			color: #FFFFFF;
			padding: 8px 11px;
		}

		.dashboard-list-box .button.gray img {
			max-width: unset;
			margin: 0px auto;
			margin-left: -2px;
		}

		.ver_line {
			width: 1px;
			height: 23px;
			margin: 9px auto;
			background-color: #ffffff;
		}
	}

	@media (max-width: 360px) {
		.list-box-listing-content {
			width: 220px;
		}
	}

	@media (max-width: 320px) {
		.list-box-listing-content {
			width: 200px;
		}
	}
</style>
