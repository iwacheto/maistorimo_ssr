<template>
	<div>
		<div class="row">
			<!-- Listings -->
			<div class="col-lg-12 col-md-12">
				<div class="dashboard-list-box margin-top-0">
					<h4>Статии</h4>
					<ul>
						<li v-for="(a, index) in articles" :key="a.id">
							<div class="list-box-listing">
								<div class="list-box-listing-img">
									<a href="#">
										<img :src="getMainImage(a.article_galleries)" alt>
									</a>
								</div>
								<div class="list-box-listing-content">
									<div class="inner">
										<h3>
											<a href="#">{{ a.title }}</a>
										</h3>
									</div>
								</div>
							</div>
							<div class="buttons-to-right">
								<router-link v-if="a.url_address" class="button gray"
											 :to="'/blog/articles/edit/' +  a.id">
									<i class="sl sl-icon-note"></i>
								</router-link>
								<router-link v-else class="button gray" :to="'/blog/articles/edit/' +  a.id">
									<i class="sl sl-icon-note"></i>
								</router-link>
								<a @click="alertDeleteArticle(a.id, index)" class="button gray">
									<i class="sl sl-icon-close"></i>
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
		name: "ArticlesList",
		data() {

			return {
				articles: []
			}
		},
		mounted() {
			this.getArticles();
			this.$refs.mytoast.defaultPosition = "toast-top-center";
			this.$refs.mytoast.defaultStyle = {'top': '80px'};
		},
		computed: {},
		methods: {
			getMainImage(gallery) {
				let mainImage = gallery.filter((image, index) => {
					return image.main == 1;
				});
				return mainImage[0]['url'];
			},
			async getArticles() {
				try {
					const res = await axios.get('/vendor/blog/articles');
					console.log(res.data);
					this.articles = res.data;
				}
				catch (error) {
					console.log(error);
				}

			},
			async deleteArticle(id, index) {
				try {
					const res = await axios.delete("/vendor/blog/articles/" + id);
					this.articles.splice(index, 1);
					this.$refs.mytoast.s(
						"Статията бе изтрита успешно!"
					);
				}
				catch (error) {
					console.log(error)
				}

			},

			async alertDeleteArticle(id, index) {
				const result = await this.$swal({
					title: "Наистина ли искате да изтриете тази статия?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					confirmButtonText: "Yes, Delete it!"
				});
				console.log(result.value)
				if (result.value) { // <-- if confirmed
					this.deleteArticle(id, index);
				}

			},
		}
	}
</script>

<style scoped>

</style>