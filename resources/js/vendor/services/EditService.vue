<template>
    <div>
        <div class="row">
            <div class="col-lg-12">
                <div id="add-article">
                    <!-- Section -->
                    <div class="add-listing-section">
                        <div class="add-listing-headline heading_admin">
                            <h3><i class="sl sl-icon-doc"></i> Основна информация</h3>
                            <a @click="goToProject" class="button preview project_link">
                                Виж Услугата
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                            <span v-if="service.commonError" class="error">{{
                                service.commonError
                            }}</span>
                        </div>

                        <!-- Titlebar -->
                        <div id="titlebar">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2>Редактиране на услуга</h2>
                                    <!-- Breadcrumbs -->
                                    <nav id="breadcrumbs">
                                        <ul>
                                            <li>
                                                <a href="#">Начало</a>
                                            </li>
                                            <li>
                                                <a href="#">Админ Панел</a>
                                            </li>
                                            <li>Редактиране на услуга</li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>

                        <span v-if="service.commonError" class="error">{{
                            service.commonError
                        }}</span>

                        <!-- Title -->
                        <div class="row with-forms">
                            <div class="col-md-12">
                                <h5>
                                    Заглавие на услугата
                                    <span class="required">*</span>
                                </h5>
                                <input class="search-field" type="text" v-model="service.name" />
                                <span v-if="service.titleError" class="error">{{
                                    service.titleError[0]
                                }}</span>
                            </div>
                        </div>

                        <!-- Row -->
                        <div class="add-listing-section">
                            <div class="add-listing-headline">
                                <h3>
                                    <i class="sl sl-icon-doc"></i> Описание 1
                                    <span class="required">*</span>
                                </h3>
                                <div class="row with-forms">
                                    <!-- Status -->
                                    <div class="col-md-12">
                                        <span v-if="service.firstDescriptionError" class="error">{{
                                            service.firstDescriptionError[0]
                                        }}</span>

                                        <label>Описание 1</label>
                                        <ckeditor
                                            :editor="editorConfig.editor"
                                            v-model="service.first_description"
                                            :config="editorConfig.editorConfig"
                                        ></ckeditor>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Row -->
                        <div class="add-listing-section">
                            <div class="add-listing-headline">
                                <h3><i class="sl sl-icon-doc"></i> Описание 2</h3>
                                <div class="row with-forms">
                                    <!-- Status -->
                                    <div class="col-md-12">
                                        <span v-if="service.secondDescriptionError" class="error">{{
                                            service.secondDescriptionError[0]
                                        }}</span>

                                        <label>Текст за Нас - Компания</label>
                                        <ckeditor
                                            :editor="editorConfig.editor"
                                            v-model="service.second_description"
                                            :config="editorConfig.editorConfig"
                                        ></ckeditor>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Location -->
                        <div class="add-listing-section">
                            <div class="add-listing-headline">
                                <h3><i class="sl sl-icon-doc"></i>Изберете локация</h3>
                                <div class="row with-forms">
                                    <!-- Status -->
                                    <div class="col-md-12">
                                        <div class="checkboxes in-row margin-bottom-20">
                                            <input
                                                id="check-a"
                                                type="checkbox"
                                                name="check"
                                                v-model="allCountries"
                                            />
                                            <label for="check-a">В цялата страна</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12" v-if="!allCountries">
                                        <vue-tags-input
                                            v-model="location"
                                            :tags="cities"
                                            :autocomplete-items="filteredTags"
                                            @before-deleting-tag="
                                                (location) => deleteLocation(location)
                                            "
                                            @tags-changed="(newTags) => (service.cities = newTags)"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Status -->
                        <div class="add-listing-section">
                            <div class="add-listing-headline">
                                <h3 class="select_heading">
                                    <i class="im im-icon-Add-Window"></i> Категория
                                    <span class="required">*</span>
                                </h3>
                                <div class="row with-forms">
                                    <div class="col-md-6"></div>
                                    <!-- Status -->
                                    <select class="chosen-select-no-single" v-model="selected">
                                        <option value>Избери категория</option>
                                        <optgroup
                                            :label="mainCategory.title"
                                            v-for="mainCategory in categories"
                                            :key="mainCategory.id"
                                        >
                                            <option
                                                :value="category.id"
                                                v-for="category in mainCategory.children"
                                                :key="category.id"
                                            >
                                                {{ category.title }}
                                            </option>
                                            <option value="21">Друга</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Section -->
                        <div class="add-listing-section margin-top-45">
                            <div class="add-listing-headline">
                                <h3>
                                    <i class="sl sl-icon-picture"></i> Главна снимка
                                    <span class="required">*</span>
                                </h3>
                            </div>

                            <!-- Dropzone -->
                            <vue-dropzone
                                ref="myVueDropzoneMain"
                                @vdropzone-success="mainImageUploaded"
                                @vdropzone-removed-file="removedMainImage"
                                id="dropzoneMainImage"
                                :options="dropzoneOptionsMain"
                            ></vue-dropzone>
                        </div>
                        <!-- Section / End -->

                        <!-- Row -->

                        <button @click="saveService" class="button preview">
                            Редактирай
                            <i class="fa fa-arrow-circle-right"></i>
                        </button>
                    </div>
                </div>
            </div>
            <vue-toastr ref="mytoast"></vue-toastr>
        </div>
    </div>
</template>

<script>
import Snackbar from '../../global/components/Snackbar';
import vue2Dropzone from 'vue2-dropzone';
import 'vue2-dropzone/dist/vue2Dropzone.min.css';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import { VueTagsInput, createTags } from '@johmun/vue-tags-input';

export default {
    name: 'EditService',
    props: ['id'],
    data() {
        return {
            serCategories: [],
            categories: [],
            cities: [],
            allCities: [],
            autocompleteItems: [],
            location: '',
            selected: '',
            category: '',
            defaultService: {
                second_description: '',
                mainImage: [],
                titleError: false,
                categoryError: false,
                urlError: false,
                descriptionError: false,
                commonError: false,
            },
            service: {},
            allCountries: false,
            editorConfig: {
                editor: ClassicEditor,
                editorData: '<p>Content of the editor.</p>',
                editorConfig: {
                    // The configuration of the editor.
                },
            },
            dropzoneOptionsMain: {
                url: '/vendor/galleries/uploadImage',
                maxFiles: 1,
                addRemoveLinks: true,
                thumbnailWidth: 150,
                maxFilesize: 15,
                headers: { 'My-Awesome-Header': 'header value' },
            },
        };
    },
    mounted() {
        this.getService();
        this.$refs.mytoast.defaultPosition = 'toast-top-center';
        this.$refs.mytoast.defaultStyle = { top: '80px' };
        this.$refs.myVueDropzoneMain.disable();
        // this.getServicesCategory();
        this.getCategories();
        this.getCities();
    },
    methods: {
        goToProject() {
            window.open('/service/details/' + this.service.id, '_blank');
        },
        getCategories() {
            axios.get('/categories/getcat').then(({ data }) => {
                this.categories = data;
            });
        },
        async getCities() {
            try {
                const responce = await axios.get('/vendor/service/get-cities');
                this.allCities = responce.data;
                this.autocompleteItems = responce.data.map((element) => {
                    return {
                        text: element.city,
                    };
                });
            } catch (error) {
                console.log(error);
            }
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
        mainImageUploaded(file, response) {
            this.service.mainImage.push({
                url: response.url,
                name: file.name,
            });

            // this.article.mainImage = response;
            // this.mainImage.push(this.article.mainImage.url);
            this.$refs.myVueDropzoneMain.disable();
        },
        deleteLocation(location) {
            console.log(location.tag.id);
            // this.project.tags[tag.index + this.deletedTagsCount]['deleted'] = 1;
            this.cities = this.cities.filter((el) => el.id !== location.tag.id);
            // this.deletedTagsCount++;
        },
        removedMainImage(file, error, xhr) {
            this.service.mainImage = [];
            this.$refs.myVueDropzoneMain.enable();
        },
        async getService() {
            try {
                const res = await axios.get('/vendor/service/' + this.id);
                this.selected = res.data[0].category ? res.data[0].category.id : 0;
                this.service = { ...this.defaultService, ...res.data[0] };

                if (res.data[0].cities.length > 0) {
                    const transformedCities = res.data[0].cities.map((element) => {
                        return {
                            text: element.city,
                            id: element.id,
                        };
                    });
                    this.cities = createTags(transformedCities, [
                        { type: 'length', rule: /[0-9]/ },
                    ]);
                }

                if (res.data[0].second_description == null) {
                    this.service.second_description = '';
                }
                this.service.mainImage.push({
                    url: this.service.image_url,
                    name: this.service.image_name,
                });
                // this.service.mainImage[0]['url'] = this.service.image_url;
                // this.service.mainImage[0]['name'] = this.service.image_name;
                var file = {
                    size: 123,
                    name: this.service.image_name,
                    type: 'image/jpg',
                };

                this.$refs.myVueDropzoneMain.manuallyAddFile(file, this.service.mainImage[0].url);
            } catch (error) {
                console.log(error);
            }
        },
        async saveService() {
            if (this.service.mainImage.length == 0) {
                return (this.service.commonError = 'There should have a main image');
            }
            if (!this.service.first_description || !this.service.name) {
                return (this.service.commonError = "There sholudn't have an empty fields");
            }
            if (this.allCountries) {
                this.service.all_country = 1;
                this.service.cities = [];
            } else {
                this.service.all_country = 0;
                this.service.cities.forEach((element) => {
                    if (!element.id)
                        element.id = this.allCities.filter((el) => el.city === element.text)[0].id;
                });
            }
            console.log(this.service);
            try {
                const res = await axios.put('/vendor/service/' + this.id, this.service);

                this.$refs.mytoast.s('Услугата бе редактирана успешно!');
                setTimeout(() => {
                    this.$router.push({ name: 'ServicesList' });
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
            }
        },
    },

    watch: {
        selected() {
            this.service.service_id = this.selected;
        },
    },

    components: {
        vueDropzone: vue2Dropzone,
        VueTagsInput,
        snackbar: Snackbar,
    },

    computed: {
        filteredTags() {
            return this.autocompleteItems.filter((i) => {
                return i.text.toLowerCase().indexOf(this.location.toLowerCase()) !== -1;
            });
        },
    },
};
</script>

<style scoped>
.select_heading {
    padding: 20px 0;
}
select.chosen-select-no-single option {
    padding: 8px 0;
}
.vue-tags-input {
    max-width: 100%;
}
</style>
