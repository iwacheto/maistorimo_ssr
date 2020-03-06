<template>
    <div>
        <div class="row">
            <div class="col-lg-12">
                <div id="add-article">
                    <!-- Section -->
                    <div class="add-listing-section">
                        <div class="add-listing-headline">
                            <div id="titlebar">
                                <h3>
                                    <i class="sl sl-icon-doc"></i> Основна информация
                                </h3>
                            </div>
                            <span v-if="error.commonError" class="error">{{error.commonError}}</span>
                        </div>

                        <!-- Titlebar -->

                        <div class="row">
                            <div class="col-md-12">
                                <h2>Добавяне на услуга</h2>
                                <!-- Breadcrumbs -->
                                <nav id="breadcrumbs">
                                    <ul>
                                        <li>
                                            <a href="/">Начало</a>
                                        </li>
                                        <li>
                                            <a href="/admin">Админ Панел</a>
                                        </li>
                                        <li>Добавяне на услуга</li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                        <!-- Title -->
                        <div class="row with-forms">
                            <div class="col-md-12">
                                <!-- <p v-if="error.titleError" class="error_service">Заглавието е задължително!</p> -->
                                <span
                                    v-if="error.titleError"
                                    class="error error_service"
                                >Заглавието е задължително!</span>
                                <h5>
                                    Заглавие на услугата
                                    <span class="required">*</span>
                                </h5>
                                <input class="search-field" type="text" v-model="service.title" />
                            </div>
                        </div>

                        <div class="row with-forms">
                            <div class="col-md-12">
                                <div class="add-listing-section">
                                    <div class="add-listing-headline category_mobile">
                                        <span
                                            v-if="error.categoryError"
                                            class="error"
                                        >Моля, изберете категория!</span>
                                        <div class="col-md-6">
                                            <h3 class="mb-20">
                                                <i class="im im-icon-Add-Window"></i> Категория
                                                <span class="required">*</span>
                                            </h3>
                                            <div class="row with-forms">
                                                <select
                                                    class="chosen-select-no-single"
                                                    v-model="service.category"
                                                >
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
                                                        >{{ category.title }}</option>
                                                        <option value="21">Друга</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                        <span
                                            v-if="error.firstDescriptionError"
                                            class="error"
                                        >Моля напишете описание!</span>

                                        <label>Описание 1</label>
                                        <ckeditor
                                            :editor="editorConfig.editor"
                                            v-model="service.firstDescription"
                                            :config="editorConfig.editorConfig"
                                        ></ckeditor>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Row -->
                        <div class="add-listing-section">
                            <div class="add-listing-headline">
                                <h3>
                                    <i class="sl sl-icon-doc"></i> Описание 2
                                </h3>
                                <div class="row with-forms">
                                    <!-- Status -->
                                    <div class="col-md-12">
                                        <!-- <span
                      v-if="service.secondDescriptionError"
                      class="error"
                                        >{{service.secondDescriptionError[0]}}</span>-->
                                        <label>Текст за Нас - Компания</label>
                                        <ckeditor
                                            :editor="editorConfig.editor"
                                            v-model="service.secondDescription"
                                            :config="editorConfig.editorConfig"
                                        ></ckeditor>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section -->
                        <div class="add-listing-section margin-top-45">
                            <div class="add-listing-headline">
                                <span
                                    v-if="error.imageError"
                                    class="error"
                                >Моля, качете снимка на услугата</span>
                                <h3>
                                    <i class="sl sl-icon-picture"></i> Главна снимка
                                    <span class="required">*</span>
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

                        <button @click="createService" class="button preview">
                            Създай
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
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import vue2Dropzone from 'vue2-dropzone';
import axios from 'axios';

export default {
    name: 'CreateService',
    data() {
        return {
            categories: [],
            isCreated: true,
            editorConfig: {
                editor: ClassicEditor,
                editorData: '<p>Content of the editor.</p>',
                editorConfig: {
                    // The configuration of the editor.
                },
            },
            serCategories: [],
            category: '',
            service: {
                title: '',
                firstDescription: '',
                secondDescription: '',
                category: '',
                mainImage: {},
            },
            error: {
                commonError: false,
                titleError: false,
                firstDescriptionError: false,
                categoryError: false,
                imageError: false,
            },
            dropzoneOptionsMain: {
                url: '/vendor/galleries/uploadImage',
                 maxFiles: 1,
                addRemoveLinks: true,
                thumbnailWidth: 150,
                maxFilesize: 0.5,
                headers: { 'My-Awesome-Header': 'header value' },
            },
        };
    },
    mounted() {
        this.$refs.mytoast.defaultPosition = 'toast-top-center';
        this.$refs.mytoast.defaultStyle = { top: '80px' };
        // this.setToken();
        this.getCategories();
    },
    methods: {
        getCategories() {
            axios.get('/categories/getcat').then(({ data }) => {
                this.categories = data;
            });
        },
        async getServicesCategory() {
            try {
                const responce = await axios.get('/vendor/service_category');
                this.serCategories = responce.data;
            } catch (error) {
                console.log(error);
            }
        },
        isEmpty(obj) {
            for (var key in obj) {
                if (obj.hasOwnProperty(key)) return false;
            }
            return true;
        },
        async createService() {
            if (!this.service.title) {
                this.error.titleError = true;
                this.scrollToError();
            }
            if (!this.service.firstDescription) {
                this.error.firstDescription = true;
                this.scrollToError();
            }
            if (!this.service.category) {
                this.error.categoryError = true;
                this.scrollToError();
            }
            if (!this.service.mainImage) {
                this.error.imageError = true;
                this.scrollToError();
            } else {
                try {
                    if (this.isCreated) {
                        this.isCreated = false;
                        const res = await axios.post('/vendor/service', this.service);
                        this.$refs.mytoast.s('Услугата бе създадена успешно!');
                        setTimeout(() => {
                            this.$router.push({ name: 'ServicesList' });
                            this.isCreated = true;
                        }, 3000);
                    }
                } catch (error) {
                    console.log(error);
                    this.isCreated = true;
                }
            }
        },
        scrollToError() {
            setTimeout(function() {
                let elem = document.querySelector('.error');
                const y = elem.getBoundingClientRect();
                elem.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }, 500);
        },
        mainImageUploaded(file, response) {
            this.service.mainImage = { url: response.url, name: file.name}
            
        
        },
        removedMainImage(file, error, xhr) {
            this.service.mainImage.splice(0, 1);
        },
    },
    components: {
        vueDropzone: vue2Dropzone,
    },
};
</script>

<style scoped>
span.error {
    font-size: 14px;
}
</style>
