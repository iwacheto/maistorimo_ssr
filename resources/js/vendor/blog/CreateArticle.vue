<template>
	<div>
		<div class="row">
			<div class="col-lg-12">
				<div id="add-article">
					<!-- Section -->
					<div class="add-listing-section">
						<div class="add-listing-headline">
							<h3>
								<i class="sl sl-icon-doc"></i> Основна информация
							</h3>
							<span v-if="article.commonError" class="error">
								{{article.commonError}}
								</span>
						</div>

						<!-- Titlebar -->
						<div id="titlebar">
							<div class="row">
								<div class="col-md-12">
									<h2>Добавяне на статия</h2>
									<!-- Breadcrumbs -->
									<nav id="breadcrumbs">
										<ul>
											<li>
												<a href="#">Начало</a>
											</li>
											<li>
												<a href="#">Админ Панел</a>
											</li>
											<li>Добавяне на статия</li>
										</ul>
									</nav>
								</div>
							</div>
						</div>

						<span v-if="article.commonError" class="error">
								{{article.commonError}}
								</span>

						<!-- Title -->
						<div class="row with-forms">

							<div class="col-md-12">

								<h5>Заглавие на статията<span class="required">*</span></h5>
								<input class="search-field" type="text" v-model="article.title">
								<span v-if="article.titleError" class="error">
									{{article.titleError[0]}} Test
								</span>
							</div>
						</div>

						<!-- Row -->
						<div class="row with-forms">
							<!-- Status -->
							<div class="col-md-12">

								<h5>Адрес на статията<span class="required">*</span></h5>
								<span v-if="article.urlError" class="error">
									{{article.urlError[0]}}
								</span>
								<input class="search-field" type="text" v-model="article.url_address">

							</div>
						</div>

						<!-- Row -->
						<div class="row with-forms">
							<!-- Status -->
							<div class="col-md-12">
								<h5>Категория на статията<span class="required">*</span></h5>
								<select class="chosen-select-no-single" v-model="article.category">
									<option value="null">Избери категория</option>
									<option v-for="c in categories" :key="c.id" :value="c.id">{{ c.name }}</option>
								</select>
								<span v-if="article.categoryError" class="error">
									{{article.categoryError[0]}}
								</span>
							</div>
						</div>

						<!-- Row -->
						<div class="row with-forms">
							<!-- Status -->
							<div class="col-md-12">


								<span v-if="article.descriptionError" class="error">
									{{article.descriptionError[0]}}
								</span>
								<h5>Кратко описание</h5>

								<input type="text" v-model="article.description">
							</div>
						</div>
					</div>

					<!-- Row -->
					<div class="add-listing-section">
						<div class="add-listing-headline">
							<h3>
								<i class="sl sl-icon-doc"></i> Съдържание<span class="required">*</span>
							</h3>
							<div class="row with-forms">
								<!-- Status -->
								<div class="col-md-12">
									<span v-if="article.contentError" class="error">
									{{article.contentError[0]}}
								</span>
									<froala :tag="'textarea'" :config="config" v-model="article.content"></froala>
								</div>
							</div>
						</div>
					</div>
					<!-- Section -->
					<div class="add-listing-section margin-top-45">
						<!-- Headline -->
						<div class="add-listing-headline">
							<h3>
								<i class="sl sl-icon-picture"></i> Галерия
							</h3>
						</div>

						<!-- Dropzone -->
						<vue-dropzone
								ref="myVueDropzone"
								@vdropzone-success="imageUploaded"
								@vdropzone-removed-file="removedImage"
								id="dropzone"
								:options="dropzoneOptions"></vue-dropzone>

						<div class="add-listing-headline">
							<h3>
								<i class="sl sl-icon-picture"></i> Главна снимка<span class="required">*</span>
							</h3>
						</div>

						<!-- Dropzone -->
						<vue-dropzone
								ref="myVueDropzone"
								@vdropzone-success="mainImageUploaded"
								@vdropzone-removed-file="removedMainImage"
								id="dropzoneMainImage"
								:options="dropzoneOptionsMain"
						></vue-dropzone>
					</div>
					<!-- Section / End -->


					<!-- Row -->
					<div class="row with-forms">
						<!-- Status -->
						<div class="col-md-12">
							<h5>
								Тагове
							</h5>
							<vue-tags-input
									v-model="article.tag"
									:tags="article.tags"
									@tags-changed="newTags => article.tags = newTags"
							/>

						</div>
					</div>
					<button @click="createArticle" class="button preview">
						Create
						<i class="fa fa-arrow-circle-right"></i>
					</button>
				</div>
			</div>
		</div>
		<vue-toastr ref="mytoast"></vue-toastr>
	</div>

</template>

<script>
	import {VueTagsInput, createTag, createTags} from "@johmun/vue-tags-input";
	import vue2Dropzone from "vue2-dropzone";

	export default {
		name: "CreateArticle",
		data() {

			return {
				article: {
					title: '',
					content: '',
					category: '',
					url_address: '',
					description: '',
					tag: '',
					tags: [],
					images: [],
					mainImage: {},
					titleError: false,
					categoryError: false,
					urlError: false,
					descriptionError: false,
					commonError: false
				},
				categories: [],
				dropzoneOptions: {
					url: "/vendor/galleries/uploadImage",
					thumbnailWidth: 150,
					maxFilesize: 15,
					headers: {"My-Awesome-Header": "header value"}
				},
				dropzoneOptionsMain: {
					url: "/vendor/galleries/uploadImage",
					maxFiles: 1,
					thumbnailWidth: 150,
					maxFilesize: 15,
					headers: {"My-Awesome-Header": "header value"}
				},


				config: {}

			}
		},
		mounted() {
			this.getCategories();
			this.$refs.mytoast.defaultPosition = "toast-top-center";
			this.$refs.mytoast.defaultStyle = {'top': '80px'};

		},
		methods: {

			isEmpty(obj) {
				for (var key in obj) {
					if (obj.hasOwnProperty(key))
						return false;
				}
				return true;
			},
			async createArticle() {

				if (this.isEmpty(this.article.mainImage)) {
					return this.article.commonError = 'There should have a main image';
				}

				if (!this.article.description || !this.article.title || !this.article.category) {

					return this.article.commonError = 'There sholudn\'t have an empty fields';
				}
				try {
					const res = await
						axios
							.post("/vendor/blog/create-article", this.article);

					this.$refs.mytoast.s(
						"Статията бе създадена успешно!"
					);
					setTimeout(() => {
						this.$router.push({name: 'ArticlesList'})
					}, 3000);


				} catch (error) {
					console.log(error.response);
					if (error.response.data.errors.title) {
						this.article.titleError = error.response.data.errors.title
					}
					if (error.response.data.errors.description) {
						this.article.descriptionError = error.response.data.errors.description
					}
					if (error.response.data.errors.url_address) {
						this.article.urlError = error.response.data.errors.url
					}
					if (error.response.data.errors.category) {
						this.article.categoryError = error.response.data.errors.category
					}
					if (error.response.data.errors.content) {
						this.article.contentError = error.response.data.errors.content
					}

					console.log(error.response.data.errors);

				}


			},
			imageUploaded(file, response) {
				console.log(file);
				this.article.images.push({url: response.url, name: file.name});
			},
			mainImageUploaded(file, response) {
				this.article.mainImage = {url: response.url, name: file.name};
			},
			removedMainImage(file, error, xhr) {
				this.mainImage.splice(0, 1);
				this.$refs.myVueDropzoneMain.enable();
			},
			removedImage(file, error, xhr) {

				console.log(file);
				return;
				this.article.article_galleries[parseInt(file.name, 10)]["deleted"] = 1;
				this.$refs.myVueDropzoneMain.enable();
			},
			async getCategories() {
				try {
					const res = await
						axios.get('/vendor/blog/categories');
					console.log(res.data);
					this.categories = res.data;
				}
				catch (error) {
					console.log(error);
				}
			}
		},
		components: {
			VueTagsInput,
			vueDropzone: vue2Dropzone
		}
	}

</script>

<style scoped>
	h3 {
		margin-bottom: 10px;
	}
	button.button.preview{
		margin-bottom: 40px;
	}
</style>
