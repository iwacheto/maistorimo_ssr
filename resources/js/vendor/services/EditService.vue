<template>
    <div>
        <!-- Titlebar -->
        <div id="titlebar">
            <div class="row">
                <div class="col-md-12">
                    <h2>Редактиране на услуга</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="add-article">
                    <!-- Section -->
                    <div class="add-listing-section">
                        <div class="add-listing-headline">
                            <h3>
                                <img src="/images/info-circle-solid.svg" alt="info icon" /> Основна
                                информация
                            </h3>
                            <!-- <a @click="goToProject" class="button preview project_link">
                Виж Услугата
                <i class="fa fa-arrow-circle-right"></i>
              </a> -->
                            <span v-if="service.commonError" class="error">{{
                                service.commonError
                            }}</span>
                        </div>

                        <!-- Title -->
                        <div class="section-with-forms">
                            <div class="with-forms">
                                <div class="col-md-12">
                                    <h5>Заглавие на услугата</h5>
                                    <input
                                        class="search-field"
                                        type="text"
                                        v-model="service.name"
                                    />
                                    <span v-if="service.titleError" class="error">{{
                                        service.titleError[0]
                                    }}</span>
                                </div>

                                <div class="col-md-12">
                                    <h5>Категория</h5>

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

                            <!-- Section -->
                            <div class="galery-section">
                                <h5><i class="sl sl-icon-picture"></i> Главна снимка</h5>

                                <!-- Dropzone -->
                                <vue-dropzone
                                    ref="myVueDropzoneMain"
                                    @vdropzone-success="mainImageUploaded"
                                    @vdropzone-removed-file="removedMainImage"
                                    id="dropzoneMainImage"
                                    :options="dropzoneOptionsMain"
                                ></vue-dropzone>
                            </div>
                        </div>

                        <!-- Row -->
                        <div class="add-listing-section section-details">
                            <div class="add-listing-headline">
                                <h5>Описание 1</h5>
                                <div class="row with-forms">
                                    <div class="col-md-12">
                                        <span v-if="service.firstDescriptionError" class="error">{{
                                            service.firstDescriptionError[0]
                                        }}</span>
                                        <ckeditor
                                            :editor="editorConfig.editor"
                                            v-model="service.first_description"
                                            :config="editorConfig.editorConfig"
                                        ></ckeditor>
                                    </div>
                                </div>
                            </div>

                            <div class="add-listing-headline">
                                <h5>Описание 2</h5>
                                <div class="row with-forms">
                                    <div class="col-md-12">
                                        <span v-if="service.secondDescriptionError" class="error">{{
                                            service.secondDescriptionError[0]
                                        }}</span>
                                        <ckeditor
                                            :editor="editorConfig.editor"
                                            v-model="service.second_description"
                                            :config="editorConfig.editorConfig"
                                        ></ckeditor>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Status -->
                        <div class="button-part">
                            <button @click="saveService" class="button preview">Редактирай</button>
                        </div>
                    </div>
                </div>

                <!-- Copyrights -->
                <Copyrights />
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
import Copyrights from '../partials/Copyrights.vue';
import {VueTagsInput, createTag, createTags} from "@johmun/vue-tags-input";

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
        Copyrights,
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

.row {
    margin-left: unset;
    margin-right: unset;
}

span.error {
    font-size: 14px;
}

@media screen and (min-width: 991px) {
    #titlebar {
        margin-bottom: 0px;
        padding-top: 29px;
    }

    #titlebar h2 {
        font-style: normal;
        font-weight: 500;
        font-size: 25px;
        line-height: 29px;
        color: #276955;
        margin: 0px 0px 40px 0px;
    }

    /* .row {
    margin-left: unset;
    margin-right: unset;
    width: 100%;
  } */

    .col-lg-12 {
        margin: 0px;
        padding: 0px;
        background-color: #f8f8f8;
    }

    #add-article {
        margin: 0px 26px;
        background: #ffffff;
        border: 0.25px solid #9ea3bd;
        box-sizing: border-box;
        box-shadow: 0px 2px 10px rgb(0 0 0 / 25%);
        border-radius: 7px;
    }

    .add-listing-section {
        box-shadow: unset;
        border-radius: 7px;
        padding: unset;
    }

    .add-listing-section.section-details {
        display: flex;
        flex-direction: row;
    }

    .add-listing-headline {
        border-top: 7px;
        /* border-bottom: 1px solid #CACACA; */
        border-bottom: unset;
        width: unset;
        left: unset;
        margin: unset;
    }

    .add-listing-section.section-details .add-listing-headline {
        padding: 25px 18px;
    }

    .add-listing-headline h3 {
        font-style: normal;
        font-weight: normal;
        font-size: 20px;
        line-height: 23px;
        color: #276955;
    }

    .section-with-forms {
        display: flex;
        flex-direction: row;
        padding-left: 25px;
        padding-bottom: 36px;
        border-bottom: 1px solid #cacaca;
        border-top: 1px solid #cacaca;
    }

    .section-with-forms .with-forms:nth-child(1) {
        width: 34%;
    }

    .section-with-forms .galery-section {
        width: 30%;
    }

    .with-forms {
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    .autocomplete {
        width: 100%;
    }

    #add-article h5 {
        font-style: normal;
        font-weight: bold;
        font-size: 17px;
        line-height: 20px;
        color: #276955;
        margin-left: 28px;
    }

    .col-md-12 input,
    .col-md-12 select {
        background: #ffffff;
        border: 0.25px solid #6bbf3f;
        box-sizing: border-box;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 5px;
        height: 40px;
        max-width: 330px;
    }

    .col-md-12 select {
        margin: 6px 0px;
        padding: 0px;
        max-width: 330px;
    }

    .multi_select_service {
        position: relative;
        background: #ffffff;
        border: 0.25px solid #6bbf3f;
        box-sizing: border-box;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 5px;
        height: 40px;
        padding: 5px;
    }

    .vue-tags-input {
        height: 71px;
        background: #ffffff;
        border: 0.25px solid #6bbf3f;
        box-sizing: border-box;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 5px;
    }

    .vue-tags-input .ti-input {
        background: #ffffff;
        border: 0.25px solid #6bbf3f;
        box-sizing: border-box;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 5px;
    }

    .cityInput {
        min-width: unset;
    }

    .galery-section {
        display: flex;
        flex-direction: column;
        width: 45%;
        margin-left: 20px;
    }

    .form {
        margin-right: 20px;
    }

    .form-section {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        margin: 0px 35px;
    }

    .add-listing-section.section-details .add-listing-headline:nth-child(1) {
        /* border-top: 1px solid #CACACA; */
        border-bottom: unset;
    }

    .add-listing-section.section-details .add-listing-headline {
        margin: 0px;
    }

    .dropzone {
        margin-top: 0px;
        background: #ffffff;
        border: 0.25px solid #6bbf3f;
        box-sizing: border-box;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 5px;
    }

    .form div:nth-child(2) {
        background: #ffffff;
        border: 0.25px solid #6bbf3f;
        box-sizing: border-box;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 5px;
    }

    .button-part {
        width: 100%;
        margin-top: 56px;
        margin-bottom: 61px;
        display: flex;
        flex-direction: column;
    }

    .button-part button {
        margin: 0px auto;
        background: #6bbf3f;
        border-radius: 20px;
        font-size: 20px;
        line-height: 23px;
        width: 354px;
        height: 43px;
    }

    @media screen and (max-width: 991px) {
    }
}
</style>
