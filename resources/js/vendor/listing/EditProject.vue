<template>
    <div>
        <!-- DESKTOP PART -->
        <div class="desktop-part" v-if="!isMobile()">
            <!-- Titlebar -->
            <div id="titlebar">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Добави проект</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div id="add-listing">
                        <!-- Section -->
                        <div class="add-listing-section">
                            <!-- Headline -->
                            <div class="add-listing-headline">
                                <h3>
                                    <img src="/images/info-circle-solid.svg" alt="info icon" />
                                    Основна информация
                                </h3>
                            </div>

                            <!-- Title -->
                            <div class="section-with-forms">
                                <div class="with-forms">
                                    <div class="col-md-12">
                                        <h5>Заглавие на проекта</h5>
                                        <!-- <input class="search-field" v-model="project.title" type="text" value /> -->
                                        <input
                                            class="search-field"
                                            v-model="project.title"
                                            type="text"
                                            value
                                            @focus="makeFocus('title')"
                                        />

                                        <div class="autocomplete">
                                            <h5>Град</h5>
                                            <input
                                                type="text"
                                                v-model="search"
                                                @input="onChange"
                                                class="cityInput"
                                            />
                                            <ul v-show="isOpen" class="autocomplete-results">
                                                <li
                                                    v-for="(result, i) in results"
                                                    :key="i"
                                                    @click="setResult(result)"
                                                    class="autocomplete-result"
                                                >
                                                    {{ result.city }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="with-forms">
                                    <!-- Status -->
                                    <div class="col-md-12">
                                        <h5>Категория</h5>
                                        <select
                                            class="chosen-select-no-single"
                                            v-model="project.category"
                                        >
                                            <option value="null">Избери категория</option>
                                            <!-- <option v-for="c in categories" :key="c.id" :value="c.id">{{ c.title }}</option> -->
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

                                    <div class="col-md-12">
                                        <h5>Услуги</h5>
                                        <multiselect
                                          style="background: #ffffff; max-height: 290px; overflow: scroll; border: 0.75px solid #6BBF3F; box-shadow: 0px 2px 4px rgb(0 0 0 / 25%); border-radius: 10px; padding: 10px;"
                                          v-model="userServicesTags"
                                          tag-placeholder="Добави като нова услуга"
                                          placeholder="Добави услуга"
                                          label="text" 
                                          track-by="id" 
                                          :options="userServices" 
                                          :multiple="true" 
                                          :taggable="true" 
                                          @tag="addTag">
                                          <template slot="selection" slot-scope="{ values, isOpen }"><span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} брой услуги</span></template>
                                        </multiselect>
                                    </div>
                                </div>

                                <div class="with-forms">
                                    <div class="col-md-12">
                                        <h5>Ключови думи</h5>
                                        <vue-tags-input
                                            v-model="tag"
                                            :tags="tags"
                                            :autocomplete-items="filteredTags"
                                            @tags-changed="(newTags) => (project.tags = newTags)"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <google-map
                                    v-if="
                                        project.lat &&
                                        project.lng &&
                                        project.formatted_address &&
                                        project.raw_data
                                    "
                                    :lat="project.lat"
                                    :lng="project.lng"
                                    :formatted_address="project.formatted_address"
                                    :placeObj="project.raw_data"
                                />
                            </div>
                        </div>

                        <div class="add-listing-section section-details">
                            <div class="add-listing-headline">
                                <h3>
                                    <img src="/images/info-circle-solid.svg" alt="info icon" />
                                    Детайли
                                </h3>
                            </div>

                            <!-- Description -->
                            <div class="form-section">
                                <div class="form">
                                    <h5>Описание</h5>
                                    <div class="editor-item">
                                        <ckeditor
                                            :editor="editorConfig.editor"
                                            v-model="project.description"
                                            :config="editorConfig.editorConfig"
                                        ></ckeditor>
                                    </div>
                                </div>

                                <div class="galery-section">
                                    <h5><i class="sl sl-icon-picture"></i> Галерия</h5>

                                    <gallery
                                        :images="images"
                                        :index="index"
                                        @close="index = null"
                                    ></gallery>
                                    <div
                                        class="image"
                                        v-for="(image, imageIndex) in project.project_galleries"
                                        :key="imageIndex"
                                        @click="index = imageIndex"
                                        :style="{
                                            backgroundImage: 'url(' + image.url + ')',
                                            width: '300px',
                                            height: '200px',
                                        }"
                                    >
                                        <a
                                            @click.stop="deleteImage(imageIndex)"
                                            class="button del_btn"
                                        >
                                            <i class="sl sl-icon-close"></i> Delete
                                        </a>
                                    </div>
                                    <vue-dropzone
                                        ref="myVueDropzone"
                                        @vdropzone-success="imageUploaded"
                                        @vdropzone-drop="disableButton"
                                        id="dropzone"
                                        :options="dropzoneOptions"
                                    ></vue-dropzone>
                                </div>
                            </div>
                        </div>

                        <div class="button-part">
                            <button @click="editProject" class="button preview">Радактирай</button>
                        </div>
                    </div>
                </div>

                <!-- Copyrights -->
                <Copyrights />
            </div>
            <vue-toastr ref="mytoast"></vue-toastr>
        </div>

        <!-- MOBILE PART -->
        <div class="mobile-part" v-if="isMobile()">
            <AddProjectOrService />

            <MobileGreenMenuSmall />

            <div class="row">
                <!-- Titlebar -->
                <div id="titlebar">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Добави проект</h2>
                        </div>
                    </div>
                </div>

                <div class="horizontal-line"></div>

                <h3>
                    <img src="/images/info-circle-solid.svg" alt="info icon" /> Основна информация
                </h3>

                <div class="col-lg-12">
                    <div id="add-listing">
                        <!-- Section -->
                        <div class="add-listing-section">
                            <div class="section-with-forms">
                                <!-- Title -->
                                <div class="with-forms">
                                    <div class="col-md-12">
                                        <h5>Заглавие на проект</h5>
                                        <input
                                            class="search-field"
                                            v-model="project.title"
                                            type="text"
                                            value
                                        />

                                        <div class="autocomplete">
                                            <h5>Град</h5>
                                            <input
                                                type="text"
                                                v-model="search"
                                                @input="onChange"
                                                class="cityInput"
                                            />
                                            <ul v-show="isOpen" class="autocomplete-results">
                                                <li
                                                    v-for="(result, i) in results"
                                                    :key="i"
                                                    @click="setResult(result)"
                                                    class="autocomplete-result"
                                                >
                                                    {{ result.city }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="with-forms">
                                    <!-- Status -->
                                    <div class="col-md-12">
                                        <h5>
                                            Категория
                                            <!-- <span class="required">*</span> -->
                                        </h5>

                                        <select
                                            class="chosen-select-no-single"
                                            v-model="project.category"
                                            @focus="makeFocus('category')"
                                        >
                                            <!-- <option value="null">Избери категория</option> -->
                                            <option value="null">Избери категория</option>
                                            <!-- <optgroup
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
                                                  </optgroup> -->
                                            <!-- <option v-for="c in categories" :key="c.id" :value="c.id">{{ c.title }}</option> -->
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <h5>Избери услуга</h5>
                                        <div>
                                          <multiselect
                                              style="background: #ffffff; max-height: 210px; overflow: scroll; border: 0.75px solid #6BBF3F; box-shadow: 0px 2px 4px rgb(0 0 0 / 25%); border-radius: 10px; padding: 10px;"
                                              v-model="userServicesTags"
                                              tag-placeholder="Добави като нова услуга"
                                              placeholder="Добави услуга"
                                              label="text" 
                                              track-by="id" 
                                              :options="userServices" 
                                              :multiple="true" 
                                              :taggable="true" 
                                              @tag="addTag">
                                            <template slot="selection" slot-scope="{ values, isOpen }"><span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} брой услуги</span></template>
                                          </multiselect>
                                        </div>
                                    </div>
                                </div>

                                <div class="with-forms">
                                    <!-- Type -->
                                    <div class="col-md-12">
                                        <h5>
                                            Ключови думи
                                            <!-- <span class="required">*</span>
                      <i
                        class="tip"
                        data-tip-content="Максимум 15 ключови думи, описващи вашият бизнес"
                      ></i> -->
                                        </h5>
                                        <vue-tags-input
                                            v-model="tag"
                                            :tags="tags"
                                            :autocomplete-items="filteredTags"
                                            @tags-changed="(newTags) => (project.tags = newTags)"
                                        />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <google-map />
                                </div>

                                <div class="horizontal-line"></div>
                            </div>
                        </div>

                        <div class="add-listing-section section-details">
                            <!-- Headline -->
                            <div class="add-listing-headline">
                                <h3>
                                    <img src="/images/info-circle-solid.svg" alt="info icon" />
                                    Детайли
                                </h3>
                            </div>
                            <div class="form-section">
                                <!-- Description -->
                                <div class="form">
                                    <h5>Описание</h5>

                                    <div class="editor-item">
                                        <ckeditor
                                            :editor="editorConfig.editor"
                                            v-model="project.description"
                                            :config="editorConfig.editorConfig"
                                        ></ckeditor>
                                    </div>
                                </div>

                                <div class="galery-section">
                                    <!-- Headline -->

                                    <h5><i class="sl sl-icon-picture"></i> Галерия</h5>

                                    <!-- Dropzone -->
                                    <vue-dropzone
                                        ref="myVueDropzone"
                                        @vdropzone-success="imageUploaded"
                                        @vdropzone-drop="disableButton"
                                        id="dropzone"
                                        :options="dropzoneOptions"
                                    ></vue-dropzone>
                                </div>
                            </div>
                        </div>

                        <div class="button-part">
                            <button
                                @mouseover="showErrors"
                                @mouseleave="showAllErrors = !showAllErrors"
                                @click="createProject"
                                class="button preview"
                                :class="[isDisabled ? 'green' : '']"
                                :disabled="isDisabled"
                            >
                                Създай
                            </button>
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
import Multiselect from 'vue-multiselect';
import { VueTagsInput, createTag, createTags } from '@johmun/vue-tags-input';
import vue2Dropzone from 'vue2-dropzone';
import 'vue2-dropzone/dist/vue2Dropzone.min.css';
import VueGallery from 'vue-gallery';
import Snackbar from '../../global/components/Snackbar.vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import Copyrights from '../partials/Copyrights.vue';
import GoogleMap from '../../components/googleMap/GoogleMap';
import MobileGreenMenuSmall from '../partials/MobileGreenMenuSmall.vue';
import AddProjectOrService from '../partials/AddProjectOrService.vue';

export default {
    props: ['id'],
    data() {
        return {
            service: '',
            categories: [],
            userServices: [],
            userServicesTags: [],
            project: {
                category: null,
                title: '',
                description: '',
                short_description: '',
                selectedServices: [],
                tags: [],
                images: [],
                titleError: false,
                categoryError: false,
                descriptionError: false,
                commonError: false,
            },
            dropzoneOptions: {
                url: '/vendor/galleries/uploadImage',
                thumbnailWidth: 150,
                maxFilesize: 0.5,
                headers: { 'My-Awesome-Header': 'header value' },
                addRemoveLinks: true,
            },
            editorConfig: {
                editor: ClassicEditor,
                editorData: '<p>Content of the editor.</p>',
                editorConfig: {
                    // The configuration of the editor.
                },
            },
            autocompleteItems: [],
            tag: '',
            index: null,
            images: [],
            tags: [],
            deletedTagsCount: 0,
            message: '',
        };
    },
    mounted() {
        this.$refs.mytoast.defaultPosition = 'toast-top-center';
        this.$refs.mytoast.defaultStyle = { top: '80px' };
        this.getCategories();
        this.getTags();
        this.getProject();
        this.getServices();
    },
    computed: {
        filteredTags() {
            return this.autocompleteItems.filter((i) => {
                return i.text.toLowerCase().indexOf(this.tag.toLowerCase()) !== -1;
            });
        },
    },
    methods: {
        // TsB
        addTag (newTag) {
          const tag = {
            name: newTag,
            code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
          }
          this.userServices.push(tag)
          this.userServicesTags.push(tag)
        },
        isMobile() {
            if (
                /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                    navigator.userAgent
                )
            ) {
                return true;
            } else {
                return false;
            }
        },
        goToProject() {
            window.open('/project/details/' + this.project.id, '_blank');
        },
        getServices() {
            axios.get('/vendor/service/getForSelect').then(({ data }) => {
                this.userServices = data.map((a) => {
                    return { text: a.name, id: a.id };
                });
            });
        },
        addTag(tag) {
            this.project.tags.push(tag.text);
            // this.tags.autocompleteItems(tag.tag);
            // this.tag = "";
        },
        addService(service) {
            this.userServicesTags.push(service.tag);
            // this.tags.push(tag.tag);
            this.service = '';
        },
        deleteTag(tag) {
            console.log(tag);
            this.project.tags[tag.index + this.deletedTagsCount]['deleted'] = 1;
            this.tags.splice(tag.index, 1);
            this.deletedTagsCount++;
        },
        deleteService(service) {
            this.userServicesTags.splice(service.index, 1);
        },
        deleteImage(index) {
            this.project.project_galleries[index]['deleted'] = 1;
            this.images.splice(index, 1);
        },
        async getProject() {
            try {
                const res = await axios.get('/vendor/projects/get/' + this.id);

                this.project = res.data;
                // @remove="updateSelectedServices"
                // this.project.selectedServices = [];

                let userServicesTags = [];
                for (var i in this.project.project_services) {
                    this.userServicesTags.push({
                        id: this.project.project_services[i]['service']['id'],
                        text: this.project.project_services[i]['service']['name'],
                    });
                }
                // this.userServicesTags = createTags(userServicesTags, [{type: "length", rule: /[0-9]/}]);
                let data = {
                    lng: this.project.lng,
                    lat: this.project.lat,
                    formatted_address: this.project.formatted_address,
                    raw_data: this.project.raw_data,
                };
                this.$store.commit('changePosition', data);
                for (var i in this.project.project_galleries) {
                    this.images[i] = this.project.project_galleries[i].url;
                }
                let tags = [];
                for (var i in this.project.tags) {
                    tags.push({
                        text: this.project.tags[i].tag.tag,
                        id: this.project.tags[i].tag.id,
                    });
                }

                this.project.tags = tags;
                this.tags = createTags(tags, [{ type: 'length', rule: /[0-9]/ }]);
            } catch (error) {
                console.log(error);
            }
            console.log(this.project);
        },
        imageUploaded(file, response) {
            this.project.project_galleries.push(response);
        },
        async editProject() {
            let position = this.$store.getters.position;

            this.project.lat = position.lat;
            this.project.lng = position.lng;
            this.project.formatted_address = position.formatted_address;
            this.project.raw_data = position.raw_data;
            this.project.userServicesTags = this.userServicesTags;

            try {
                const res = await axios.post(
                    '/vendor/projects/' + this.project.id + '/edit',
                    this.project
                );
                this.$refs.myVueDropzone.removeAllFiles();
                this.$refs.mytoast.s('Проектът бе редактиран успешно!');
                // setTimeout(() => {
                // 	this.$router.push({name: 'ProjectsList'})
                // }, 3000);
            } catch (error) {
                if (error.response.data.errors.title) {
                    this.project.titleError = error.response.data.errors.title;
                }
                if (error.response.data.errors.description) {
                    this.project.descriptionError = error.response.data.errors.description;
                }
                if (error.response.data.errors.category) {
                    this.project.categoryError = error.response.data.errors.category;
                }

                console.log(error.response.data.errors);
            }
        },
        getTags() {
            axios.get('/vendor/tags/get').then(({ data }) => {
                this.autocompleteItems = data;
            });
        },
        getCategories() {
            axios.get('/categories/getcat').then(({ data }) => {
                this.categories = data;
            });
        },
    },
    components: {
        VueTagsInput,
        vueDropzone: vue2Dropzone,
        gallery: VueGallery,
        snackbar: Snackbar,
        GoogleMap,
        Multiselect,
        MobileGreenMenuSmall,
        AddProjectOrService,
        Copyrights,
    },
};
</script>

<style scoped>
.mobile-part {
    display: none;
}

.desktop-part {
    display: flex;
    flex-direction: column;
}

.image {
    float: left;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    border: 1px solid #ebebeb;
    margin: 5px;
}

/* .multiselect__input {
    border: none !important;
} */

.autocomplete-results {
    padding: 0;
    margin: 0;
    border: 1px solid #eeeeee;
    height: 120px;
    overflow: auto;
    min-width: 280px;
    display: flex;
    flex-direction: column;
}

.autocomplete-result {
    list-style: none;
    text-align: left;
    padding: 4px 2px;
    cursor: pointer;
}

.autocomplete-result:hover {
    background-color: #4aae9b;
    color: white;
}
.green {
    background: #71e7b2;
    background: #94ecc4;
}
.danger {
    background: coral;
}
.cityInput {
    min-width: 300px;
    margin-bottom: 0 !important;
}
.error {
    font-size: 14px;
    padding-left: 25px;
    min-width: 200px;
}

.row {
    margin-left: unset;
    margin-right: unset;
    width: 100%;
}

@media screen and (min-width: 991px) {
    #titlebar {
        margin-bottom: 0px;
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

    #add-listing {
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

    .add-listing-headline {
        border-top: 7px;
        border-bottom: 1px solid #cacaca;
        width: unset;
        left: unset;
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
    }

    .with-forms {
        display: flex;
        flex-direction: column;
        width: 33%;
    }

    .autocomplete {
        width: 100%;
    }

    #add-listing h5 {
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
    }

    .col-md-12 select {
        margin: 6px 0px;
        padding: 0px;
    }

    /* .multi_select_service {
        position: relative;
        background: #ffffff;
        border: 0.25px solid #6bbf3f;
        box-sizing: border-box;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 5px;
        height: 51px;
    } */

    .vue-tags-input {
        /* height: 71px; */
        background: #ffffff;
        /* border: 0.25px solid #6BBF3F; */
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

    .add-listing-section.section-details {
        display: flex;
        flex-direction: column;
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
        border-top: 1px solid #cacaca;
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

@media only screen and (max-width: 990px) {
    .mobile-part {
        display: flex;
        flex-direction: column;
        background-color: #ffffff;
    }

    .desktop-part {
        display: none;
    }

    .mobile-part .row {
        background-color: #f7f7f7;
        border-radius: 25px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    #titlebar {
        background-color: unset;
        padding: 17px 0px 21px 0px;
        margin-bottom: 0px;
    }

    #titlebar .col-md-12 {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    #titlebar h2 {
        font-style: normal;
        font-weight: 500;
        font-size: 20px;
        line-height: 23px;
        color: #276955;
    }

    .horizontal-line {
        width: 80%;
        border: 1px solid #cacaca;
    }

    .mobile-part .row h3 {
        font-style: normal;
        font-weight: normal;
        font-size: 17px;
        line-height: 20px;
        color: #276955;
    }

    .add-listing-section {
        background-color: unset;
        box-shadow: unset;
    }

    #add-listing h5 {
        font-style: normal;
        font-weight: bold;
        font-size: 17px;
        line-height: 20px;
        color: #276955;
        margin: 21px 0px 10px 20px;
    }

    #add-listing input {
        height: 49px;
        background: #ffffff;
        border: 0.75px solid #6bbf3f;
        box-sizing: border-box;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 10px;
        /* max-width: 347px; */
    }

    .autocomplete {
        width: unset;
    }

    #add-listing select {
        height: 49px;
        background: #ffffff;
        border: 0.75px solid #6bbf3f;
        box-sizing: border-box;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 10px;
        /* max-width: 347px; */
    }

    /* .multi_select_service {
        height: 60px;
        background: #ffffff;
        border: 0.75px solid #6bbf3f;
        box-sizing: border-box;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 10px;
        padding: 10px;
    } */

    .vue-tags-input {
        max-width: unset;
        background: #ffffff;
        border: 0.75px solid #6bbf3f;
        box-sizing: border-box;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 10px;
        max-height: 74px;
    }
    .add-listing-headline {
        background-color: unset;
        border-bottom: unset;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 0px;
    }

    .editor-item {
        background: #ffffff;
        border: 0.75px solid #6bbf3f;
        box-sizing: border-box;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 10px;
    }

    #dropzone {
        background: #ffffff;
        border: 0.75px solid #6bbf3f;
        box-sizing: border-box;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 10px;
    }

    .button-part {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .button-part button {
        width: 155px;
        font-style: normal;
        font-weight: normal;
        font-size: 14px;
        line-height: 16px;
        color: #ffffff;
        background: #6bbf3f;
        border-radius: 20px;
    }
}
</style>
