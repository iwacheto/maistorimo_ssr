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
                        </div>

                        <!-- Titlebar -->
                        <div id="titlebar">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2>Редактиране на статия</h2>
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

                        <span v-if="article.commonError" class="error">{{article.commonError}}</span>

                        <!-- Title -->
                        <div class="row with-forms">
                            <div class="col-md-12">
                                <h5>
                                    Заглавие на статията
                                    <span class="required">*</span>
                                </h5>
                                <input class="search-field" type="text" v-model="article.title" />
                                <span
                                    v-if="article.titleError"
                                    class="error"
                                >{{article.titleError[0]}}</span>
                            </div>
                        </div>

                        <!-- Row -->
                        <div class="row with-forms">
                            <!-- Status -->
                            <div class="col-md-12">
                                <h5>Адрес на статията</h5>
                                <span
                                    v-if="article.titleError"
                                    class="error"
                                >{{article.urlError[0]}}</span>
                                <input
                                    class="search-field"
                                    type="text"
                                    v-model="article.url_address"
                                />
                            </div>
                        </div>

                        <!-- Row -->
                        <div class="row with-forms">
                            <!-- Status -->
                            <div class="col-md-12">
                                <h5>
                                    Категория на статията
                                    <span class="required">*</span>
                                </h5>
                                <select
                                    class="chosen-select-no-single"
                                    v-model="article.blog_category_id"
                                >
                                    <option value="null">Избери категория</option>
                                    <option
                                        v-for="c in categories"
                                        :key="c.id"
                                        :value="c.id"
                                        :selected="article.blog_category_id == c.id ? 'true' : 'false'"
                                    >
                                        {{ c.name
                                        }}
                                    </option>
                                </select>
                                <span
                                    v-if="article.categoryError"
                                    class="error"
                                >{{article.categoryError[0]}}</span>
                            </div>
                        </div>

                        <!-- Row -->
                        <div class="row with-forms">
                            <!-- Status -->
                            <div class="col-md-12">
                                <span
                                    v-if="article.descriptionError"
                                    class="error"
                                >{{article.descriptionError[0]}}</span>
                                <h5>Кратко описание</h5>

                                <input type="text" v-model="article.description" />
                            </div>
                        </div>
                    </div>

                    <!-- Row -->
                    <div class="add-listing-section">
                        <div class="add-listing-headline">
                            <h3>
                                <i class="sl sl-icon-doc"></i> Съдържание
                                <span class="required">*</span>
                            </h3>
                            <div class="row with-forms">
                                <!-- Status -->
                                <div class="col-md-12">
                                    <span
                                        v-if="article.contentError"
                                        class="error"
                                    >{{article.contentError[0]}}</span>
                                    <froala
                                        :tag="'textarea'"
                                        :config="config"
                                        v-model="article.content"
                                    ></froala>
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

                        <!--<gallery :images="images" :index="index" @close="index = null"></gallery>-->
                        <!--<div-->
                        <!--class="image"-->
                        <!--v-for="(image, imageIndex) in images"-->
                        <!--:key="imageIndex"-->
                        <!--@click="index = imageIndex"-->
                        <!--:style="{ backgroundImage: 'url(' + image + ')', width: '300px', height: '200px' }"-->
                        <!--v-if="image.deleted != 1"-->
                        <!--&gt;-->
                        <!--&lt;!&ndash;<a @click.stop="deleteImage(image)" class="button gray">&ndash;&gt;-->
                        <!--&lt;!&ndash;<i class="sl sl-icon-close"></i> Delete&ndash;&gt;-->
                        <!--&lt;!&ndash;</a>&ndash;&gt;-->
                        <!--</div>-->
                        <vue-dropzone
                            ref="myVueDropzone"
                            @vdropzone-success="imageUploaded"
                            @vdropzone-removed-file="removedImage"
                            id="dropzone"
                            :options="dropzoneOptions"
                        ></vue-dropzone>
                    </div>
                    <div class="add-listing-section margin-top-45">
                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <h3>
                                <i class="sl sl-icon-picture"></i> Главна снимка
                                <span class="required">*</span>
                            </h3>
                        </div>
                        <!-- Dropzone -->

                        <!--<gallery :images="mainImage" :index="index" @close="index = null"></gallery>-->
                        <!--<div-->
                        <!--class="image"-->
                        <!--v-for="(image, imageIndex) in mainImage"-->
                        <!--@click="index = imageIndex"-->
                        <!--:style="{ backgroundImage: 'url(' + image + ')', width: '300px', height: '200px' }"-->
                        <!--&gt;-->
                        <!--<a @click.stop="deleteMainImage(image)" class="button gray">-->
                        <!--<i class="sl sl-icon-close"></i> Delete-->
                        <!--</a>-->
                        <!--</div>-->
                        <vue-dropzone
                            ref="myVueDropzoneMain"
                            @vdropzone-success="mainImageUploaded"
                            @vdropzone-removed-file="removedMainImage"
                            id="dropzoneMainImage"
                            :options="dropzoneOptionsMain"
                        ></vue-dropzone>
                    </div>

                    <!-- Row -->
                    <div class="row with-forms">
                        <!-- Status -->
                        <div class="col-md-12">
                            <h5>Тагове</h5>
                            <vue-tags-input
                                v-model="article.tag"
                                :tags="tags"
                                @before-deleting-tag="deleteTag"
                                @before-adding-tag="addTag"
                                @tags-changed="newTags => article.tags = newTags"
                            />
                        </div>
                    </div>
                    <button @click="saveArticle" class="button preview">
                        Запази
                        <i class="fa fa-arrow-circle-right"></i>
                    </button>
                </div>
            </div>
        </div>
        <vue-toastr ref="mytoast"></vue-toastr>
    </div>
</template>

<script>
import { VueTagsInput, createTag, createTags } from '@johmun/vue-tags-input';
import vue2Dropzone from 'vue2-dropzone';
import 'vue2-dropzone/dist/vue2Dropzone.min.css';
import VueGallery from 'vue-gallery';
import Snackbar from '../partials/Snackbar';
import axios from 'axios';

export default {
    name: 'EditArticle',
    props: ['id'],
    data() {
        return {
            article: {
                title: '',
                content: '',
                category: null,
                url_address: '',
                description: '',
                tags: [],
                images: [],
                mainImage: [],
                titleError: false,
                categoryError: false,
                descriptionError: false,
                commonError: false,
            },

            dropzoneOptions: {
                url: '/vendor/galleries/uploadImage',
                thumbnailWidth: 150,
                addRemoveLinks: true,
                maxFilesize: 0.5,
                headers: { 'My-Awesome-Header': 'header value' },
            },
            dropzoneOptionsMain: {
                url: '/vendor/galleries/uploadImage',
                maxFiles: 1,
                thumbnailWidth: 150,
                maxFilesize: 0.5,
                addRemoveLinks: true,
                headers: { 'My-Awesome-Header': 'header value' },
            },
            tag: '',
            tags: [],

            index: null,
            images: [],
            mainImage: [],
            categories: [],

            config: {},
        };
    },
    mounted() {
        this.getCategories();
        this.getArticle();
        this.$refs.myVueDropzoneMain.disable();
    },
    methods: {
        checkIfMainImageExist() {
            let mainImageFlag = false;
            this.article.article_galleries.filter(image => {
                Object.keys(image).map(el => {
                    if (el == 'main' && image[el] == 1) {
                        if (!image['deleted']) {
                            return (mainImageFlag = true);
                        }
                    }
                    //ell will hold keys
                    // Getting the value of the keys should be as simple as obj[el]
                });
            });
            return mainImageFlag;
        },
        async saveArticle() {
            if (!this.checkIfMainImageExist()) {
                return (this.article.commonError = 'There should have a main image');
            }
            if (
                !this.article.description ||
                !this.article.title ||
                !this.article.blog_category_id
            ) {
                return (this.article.commonError = "There sholudn't have an empty fields");
            }
            try {
                const res = await axios.post('/vendor/blog/articles/edit/' + this.id, this.article);

                this.$refs.mytoast.s('Статията бе редактирана успешно!');
                setTimeout(() => {
                    this.$router.push({ name: 'ArticleList' });
                }, 3000);
            } catch (error) {
                if (error.response.data.errors.title) {
                    this.article.titleError = error.response.data.errors.title;
                }
                if (error.response.data.errors.description) {
                    this.article.descriptionError = error.response.data.errors.description;
                }
                if (error.response.data.errors.category) {
                    this.article.categoryError = error.response.data.errors.category;
                }

                console.log(error.response.data.errors);
            }
        },
        async getArticle() {
            try {
                const res = await axios.get('/vendor/blog/articles/' + this.id);
                this.article = res.data;

                for (var i in this.article.article_galleries) {
                    if (this.article.article_galleries[i].main) {
                        this.mainImage[0] = this.article.article_galleries[i].url;
                        var file = {
                            size: 123,
                            name: this.article.article_galleries[i].name,
                            type: 'image/jpg',
                        };

                        this.$refs.myVueDropzoneMain.manuallyAddFile(file, this.mainImage[0]);
                    } else {
                        this.images[i] = this.article.article_galleries[i].url;
                        var file = {
                            size: 123,
                            name: this.article.article_galleries[i].name,
                            type: 'image/jpg',
                        };

                        this.$refs.myVueDropzone.manuallyAddFile(file, this.images[i]);
                    }
                }
                let tags = [];
                for (var i in this.article.tags) {
                    tags.push(this.article.tags[i].name);
                }
                this.tags = createTags(tags, [{ type: 'length', rule: /[0-9]/ }]);
            } catch (error) {
                console.log(error);
            }
        },
        async getCategories() {
            try {
                const res = await axios.get('/vendor/blog/categories');

                this.categories = res.data;
            } catch (error) {
                console.log(error);
            }
        },
        addTag(tag) {
            this.article.tags.push(tag.name);
            this.tags.push(tag.name);
            this.tag = '';
        },
        deleteTag(tag) {
            this.article.tags[tag.index + this.deletedTagsCount]['deleted'] = 1;
            this.tags.splice(tag.index, 1);
            this.deletedTagsCount++;
        },
        deleteImage(imageURL) {
            console.log(imageURL);
            console.log(this.article.article_galleries);
            return;
            this.article.article_galleries[index]['deleted'] = 1;
            this.images.splice(index, 1);
        },
        deleteMainImage(imageURL) {
            this.article.article_galleries.map((image, index) => {
                if (image.url == imageURL) {
                    this.$refs.myVueDropzoneMain.removeFile(image);
                    return (image['deleted'] = 1);
                }
            });
            this.mainImage.splice(0, 1);
            // this.$refs.myVueDropzoneMain.removeFile(imageURL);
            this.$refs.myVueDropzoneMain.enable();
        },
        imageUploaded(file, response) {
            this.article.article_galleries.push({ url: response.url, name: file.name });

            // this.images.push(response.url);
        },
        mainImageUploaded(file, response) {
            this.article.article_galleries.push({
                url: response.url,
                name: file.name,
                main: 1,
            });

            // this.article.mainImage = response;
            // this.mainImage.push(this.article.mainImage.url);
            this.$refs.myVueDropzoneMain.disable();
        },
        removedMainImage(file, error, xhr) {
            this.article.article_galleries.map(image => {
                if (file.name === image.name && image.name) {
                    return (image['deleted'] = 1);
                }
            });

            this.$refs.myVueDropzoneMain.enable();
        },
        removedImage(file, error, xhr) {
            this.article.article_galleries.map(image => {
                if (file.name === image.name) {
                    return (image['deleted'] = 1);
                }
            });

            // this.$refs.myVueDropzoneMain.enable();
        },
    },
    watch: {},
    components: {
        VueTagsInput,
        vueDropzone: vue2Dropzone,
        gallery: VueGallery,
        snackbar: Snackbar,
    },
};
</script>

<style scoped>
</style>
