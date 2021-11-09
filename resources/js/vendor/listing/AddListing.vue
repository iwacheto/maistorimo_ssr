<template>
  <div>
    <!-- DESKTOP PART -->
    <div class="desktop-part">
      <!-- Titlebar -->
      <div id="titlebar">
        <div class="row">
          <div class="col-md-12">
            <h2>Добавяне на проекти</h2>
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
                  <img src="/images/info-circle-solid.svg" alt="info icon"> Основна информация
                </h3>
                <span v-if="project.commonError" class="error">{{project.commonError}}</span>
              </div>

              <div class="section-with-forms">
                <!-- Title -->
                <div class="with-forms">
                  <div class="col-md-12">
                    <h5>
                      Заглавие на проект
                      <!-- <span class="required">*</span>
                      <i class="tip" data-tip-content="Name"></i> -->
                    </h5>
                    <input
                      class="search-field"
                      v-model="project.title"
                      type="text"
                      value
                      @focus="makeFocus('title')"
                    />

                    <span v-if="error.titleError" class="error">Моля попълнете заглавието!</span>

                    <div class="autocomplete">
                      <h5>
                        Град
                        <!-- <span class="required">*</span>
                        <i
                          class="tip"
                          data-tip-content="Максимум 15 ключови думи, описващи вашият бизнес"
                        ></i> -->
                      </h5>
                      <span v-if="error.cityError" class="error">Моля попълнете градът!</span>
                      <input type="text" v-model="search" @input="onChange" class="cityInput" />
                      <ul v-show="isOpen" class="autocomplete-results">
                        <li
                          v-for="(result, i) in results"
                          :key="i"
                          @click="setResult(result)"
                          class="autocomplete-result"
                        >{{ result.city }}</li>
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
                      <!-- <option v-for="c in categories" :key="c.id" :value="c.id">{{ c.title }}</option> -->
                    </select>
                    <span v-if="error.categoryError" class="error">Моля изберете категория!</span>
                  </div>

                  <div class="col-md-12">
                    <h5>
                      Избери услуга
                      <!-- <i
                        class="tip"
                        data-tip-content="Максимум 15 ключови думи, описващи вашият бизнес"
                      ></i> -->
                    </h5>
                    <multiselect
                        class="multi_select_service"
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
                      @tags-changed="newTags => project.tags = newTags"
                    />
                    <span v-if="error.tagsError" class="error">Моля напишете ключова дума!</span>
                  </div>
                </div>

              </div>
              
              <div class="row">
                <div class="col-md-12">
                  <google-map />
                </div>
              </div>
            </div>
            <!-- Section / End -->

            <!-- Section -->
            <div class="add-listing-section section-details">
              <!-- Headline -->
              <div class="add-listing-headline">
                <h3>
                  <img src="/images/info-circle-solid.svg" alt="info icon"> Детайли
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
                  <span v-if="error.descriptionError" class="error">Моля добавете описание на проекта!</span>
                  <span v-if="desc_error" class="error">Описанието трябва да е поне с 15 букви!</span>
                </div>

                <div class="galery-section">
                  <!-- Headline -->
                    
                    <h5>
                      <i class="sl sl-icon-picture"></i> Галерия
                    </h5>
                    
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
            <!-- Section / End -->
            <div class="errors_body">
              <div class="errorsContent" v-if="showAllErrors">
                <!-- <button @click="showAllErrors=!showAllErrors" class="closeMsg">X</button> -->
                <p v-if="error.titleError" class="errorMsg">Моля попълнете заглавието!</p>
                <p v-if="error.cityError" class="errorMsg">Моля попълнете градът!</p>
                <p v-if="error.categoryError" class="errorMsg">Моля изберете категория!</p>
                <p v-if="error.tagsError" class="errorMsg">Моля напишете ключова дума!</p>
                <p v-if="error.serviceError" class="errorMsg">Моля изберете услуга!</p>
                <p v-if="error.descriptionError" class="errorMsg">Моля добавете описание на проекта!</p>
                <p v-if="error.imageError" class="errorMsg">Моля качете снимка на проекта!</p>
              </div>
            </div>
            
            <loader :active="loaderActive" :text="'Моля изчакайте!'" />

            <div class="button-part">
              <button
                @mouseover="showErrors"
                @mouseleave="showAllErrors=!showAllErrors"
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
        <Copyrights/>
      </div>
      <vue-toastr ref="mytoast"></vue-toastr>
    </div>




    <!-- MOBILE PART -->
    <div class="mobile-part">
      
      <AddProjectOrService/>

      <MobileGreenMenuSmall/>

      <div class="row">

        <!-- Titlebar -->
        <div id="titlebar">
          <div class="row">
            <div class="col-md-12">
              <h2>Добави на проект</h2>
            </div>
          </div>
        </div>

        <div class="horizontal-line"></div>

        <!-- Headline -->
        <h3>
          <img src="/images/info-circle-solid.svg" alt="info icon"> Основна информация
        </h3>
        <span v-if="project.commonError" class="error">{{project.commonError}}</span>

        <div class="col-lg-12">
          <div id="add-listing">
            <!-- Section -->
            <div class="add-listing-section">
              <div class="section-with-forms">
                <!-- Title -->
                <div class="with-forms">
                  <div class="col-md-12">
                    <h5>
                      Заглавие на проект
                      <!-- <span class="required">*</span>
                      <i class="tip" data-tip-content="Name"></i> -->
                    </h5>
                    <input
                      class="search-field"
                      v-model="project.title"
                      type="text"
                      value
                      @focus="makeFocus('title')"
                    />

                    <span v-if="error.titleError" class="error">Моля попълнете заглавието!</span>

                    <div class="autocomplete">
                      <h5>
                        Град
                        <!-- <span class="required">*</span>
                        <i
                          class="tip"
                          data-tip-content="Максимум 15 ключови думи, описващи вашият бизнес"
                        ></i> -->
                      </h5>
                      <span v-if="error.cityError" class="error">Моля попълнете градът!</span>
                      <input type="text" v-model="search" @input="onChange" class="cityInput" />
                      <ul v-show="isOpen" class="autocomplete-results">
                        <li
                          v-for="(result, i) in results"
                          :key="i"
                          @click="setResult(result)"
                          class="autocomplete-result"
                        >{{ result.city }}</li>
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
                      <!-- <option v-for="c in categories" :key="c.id" :value="c.id">{{ c.title }}</option> -->
                    </select>
                    <span v-if="error.categoryError" class="error">Моля изберете категория!</span>
                  </div>

                  <div class="col-md-12">
                    <h5>
                      Избери услуга
                    </h5>
                    <!-- <multiselect
                      class="multi_select_service"
                      v-model="userServicesTags"
                      label="text"
                      :multiple="true"
                      track-by="id"
                      :options="userServices"
                      placeholder=" "
                    ></multiselect> -->
                    <div>
                      <!-- <multiselect  
                      class="multi_select_service" 
                      v-model="userServicesTags" 
                      :options="userServices" 
                      :multiple="true" 
                      :close-on-select="false" 
                      :clear-on-select="false" 
                      :preserve-search="true"
                      :searchable="false"
                      :show-labels="true" 
                      placeholder=" " 
                      label="text" 
                      track-by="id" 
                      :preselect-first="true">
                        <template slot="selection" slot-scope="{ values, isOpen }"><span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} options selected</span></template>
                      </multiselect> -->

                      <multiselect
                        class="multi_select_service"
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
                      @tags-changed="newTags => project.tags = newTags"
                    />
                    <span v-if="error.tagsError" class="error">Моля напишете ключова дума!</span>
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
            <!-- Section / End -->

            

            <!-- Section -->
            <div class="add-listing-section section-details">
              <!-- Headline -->
              <div class="add-listing-headline">
                <h3>
                  <img src="/images/info-circle-solid.svg" alt="info icon"> Детайли
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
                  <span v-if="error.descriptionError" class="error">Моля добавете описание на проекта!</span>
                  <span v-if="desc_error" class="error">Описанието трябва да е поне с 15 букви!</span>
                </div>

                <div class="galery-section">
                  <!-- Headline -->
                    
                    <h5>
                      <i class="sl sl-icon-picture"></i> Галерия
                    </h5>
                    
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
            <!-- Section / End -->
            <div class="errors_body">
              <div class="errorsContent" v-if="showAllErrors">
                <!-- <button @click="showAllErrors=!showAllErrors" class="closeMsg">X</button> -->
                <p v-if="error.titleError" class="errorMsg">Моля попълнете заглавието!</p>
                <p v-if="error.cityError" class="errorMsg">Моля попълнете градът!</p>
                <p v-if="error.categoryError" class="errorMsg">Моля изберете категория!</p>
                <p v-if="error.tagsError" class="errorMsg">Моля напишете ключова дума!</p>
                <p v-if="error.serviceError" class="errorMsg">Моля изберете услуга!</p>
                <p v-if="error.descriptionError" class="errorMsg">Моля добавете описание на проекта!</p>
                <p v-if="error.imageError" class="errorMsg">Моля качете снимка на проекта!</p>
              </div>
            </div>

            <loader :active="loaderActive" :text="'Моля изчакайте!'" />

            <div class="button-part">
              <button
                @mouseover="showErrors"
                @mouseleave="showAllErrors=!showAllErrors"
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
        <Copyrights/>
      </div>
      <vue-toastr ref="mytoast"></vue-toastr>
    </div>

  </div>
</template>

<script>
import Multiselect from "vue-multiselect";
import { VueTagsInput, createTag, createTags } from "@johmun/vue-tags-input";
import vue2Dropzone from "vue2-dropzone";
import GoogleMap from "../../components/googleMap/GoogleMap";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import MobileGreenMenuSmall from '../partials/MobileGreenMenuSmall.vue';
import AddProjectOrService from '../partials/AddProjectOrService.vue';
import Copyrights from '../partials/Copyrights.vue';
import "vue2-dropzone/dist/vue2Dropzone.min.css";
import Loader from '../../components/Loader.vue'; // TsB - loader
import loaderMixin from '../mixins/loader'; // TsB - loader

export default {
  data() {
    return {
      isDisabled: false,
      showAllErrors: false,
      isCreated: true,
      categories: [],
      dropzoneOptions: {
        url: "/vendor/galleries/uploadImage",
        thumbnailWidth: 150,
        maxFilesize: 15,
        headers: { "My-Awesome-Header": "header value" }
      },
      userServices: [],
      userServicesTags: [],
      project: {
        category: null,
        title: "",
        description: "",
        short_description: "",
        tags: [],
        city: "",
        images: [],
        lng: false,
        lat: false,
        formatted_address: "",
        raw_data: {}
      },
      desc_error: false,
      allErrors: false,
      error: {
        titleError: false,
        cityError: false,
        categoryError: false,
        descriptionError: false,
        commonError: false,
        tagsError: false,
        imageError: false
      },
      editorConfig: {
        editor: ClassicEditor,
        editorData: "<p>Content of the editor.</p>",
        editorConfig: {
          // The configuration of the editor.
        }
      },
      autocompleteItems: [],
      tag: "",
      tags: [],
      message: "",
      snackbar: false,
      search: "",
      results: [],
      isOpen: false,
      items: [],
      categoryItems: []
    };
  },
  mixins: [loaderMixin], // TsB - loader
  computed: {
    filteredTags() {
      return this.autocompleteItems.filter(i => {
        return i.text.toLowerCase().indexOf(this.tag.toLowerCase()) !== -1;
      });
    }
  },
  mounted() {
    this.$refs.mytoast.defaultPosition = "toast-top-center";
    this.$refs.mytoast.defaultStyle = { top: "80px" };
    this.getTags();
    this.getCategories();
    this.getServices();
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

    showErrors() {
      this.showAllErrors = !this.showAllErrors;
      if (!this.project.title) {
        this.error.titleError = true;
      }
      if (this.search == "") {
        this.error.cityError = true;
      } else {
        this.error.cityError = false;
      }
      if (!this.project.description) {
        this.error.descriptionError = true;
      } else {
        this.error.descriptionError = false;
      }
      if (!this.project.category) {
        this.error.categoryError = true;
      } else {
        this.error.categoryError = false;
      }
      if (this.project.tags.length < 1) {
        this.error.tagsError = true;
      } else {
        this.error.tagsError = false;
      }
      // if (this.userServicesTags.length < 1) {
      //   this.error.serviceError = true;
      // } else {
      //   this.error.serviceError = false;
      // }
      if (this.project.images.length < 1) {
        this.error.imageError = true;
      } else {
        this.error.imageError = false;
      }
      if (
        this.error.titleError !== true &&
        this.error.descriptionError != true &&
        this.error.categoryError !== true &&
        this.error.tagsError != true &&
        this.error.serviceError !== true &&
        this.error.imageError !== true
      ) {
        this.allErrors = true;
      }
    },
    getServices() {
      axios.get("/vendor/service/getForSelect").then(({ data }) => {
        this.userServices = data.map(a => {
          return { text: a.name, id: a.id };
        });
        console.log(this.userServices);
      });
    },
    addService(service) {
      this.tags.push(service.tag);
      // this.tags.push(tag.tag);
      this.service = "";
    },
    deleteService(service) {
      this.userServicesTags.splice(service.index, 1);
    },
    getTags() {
      axios.get("/vendor/tags/get").then(({ data }) => {
        this.autocompleteItems = data;
      });
    },
    imageUploaded(file, response) {
      console.log('imageUploaded');
      this.project.images.push(response);
      console.log(response);
      this.isDisabled = false;
    },
    disableButton() {
      this.isDisabled = true;
    },
    getCategories() {
      axios.get("/categories/getcat").then(({ data }) => {
        this.categories = data;
        // let newCategories=[];
        // let arr=[];
        // data.forEach(elem=>{
        //  newCategories.push(elem.children)
        // })
        // arr = Array.prototype.concat.apply([], newCategories);
      });
    },
    scrollToError() {
      setTimeout(function() {
        // let elem = document.querySelector(".error");
        // const y = elem.getBoundingClientRect();
        // elem.scrollIntoView({ behavior: "smooth", block: "center" });

        // TsB
        let elem = document.querySelector(".error");
        if (!elem) {return}
        if (elem) {
          const y = elem.getBoundingClientRect();
          elem.scrollIntoView({ behavior: "smooth", block: "center" });
        }
      }, 500);
    },
    setResult(result) {
      this.search = result.city;
      this.project.city = result.id;
      this.isOpen = false;
    },
    async createProject() {
      let position = this.$store.getters.position;
      this.project.lat = position.lat;
      this.project.lng = position.lng;
      this.project.formatted_address = position.formatted_address;
      this.project.raw_data = position.raw_data;
      this.project.userServices = this.userServicesTags;
      this.allErrors = true; //TsB - loader
      // console.log(this.allErrors);
      if (this.allErrors == false) {
        return;
      }

      try {
        if (this.isCreated) {
          this.showLoader(); //TsB - loader
          console.log('after showLoader');
          this.isCreated = false;
          const res = await axios.post("/vendor/projects/add", this.project);
          this.$refs.mytoast.s("Проектът бе създаден успешно!");
          setTimeout(() => {
            this.$router.push({ name: "ProjectsList" });
            this.isCreated = true;
          }, 3000);
          this.hideLoader(); // TsB - loader
          console.log('after hideLoader');
        }
      } catch (error) {
        this.isCreated = true;
        if (error.response.data.errors.description) {
          this.desc_error = true;
          this.scrollToError();
        }
        if (error.response.data.errors.title) {
          this.error.titleError = true;
          this.scrollToError();
        }
        if (error.response.data.errors.city) {
          this.error.cityError = true;
          this.scrollToError();
        }
        if (error.response.data.errors.category) {
          this.error.categoryError = true;
          this.scrollToError();
        }
        if (error.response.data.errors.tags) {
          this.error.tagsError = true;
          this.scrollToError();
        }
        if (error.response.data.errors.images) {
          this.error.imageError = true;
          this.scrollToError();
        }
      }

      // console.log(this.project);
    },
    makeFocus(name) {
      if (name === "title") {
        this.error.titleError = false;
      }
      if (name === "description") {
        this.error.descriptionError = false;
      }
      if (name === "category") {
        this.error.categoryError = false;
      }
      this.error.commonError = false;
    },
    async onChange() {
      this.isOpen = true;
      try {
        const res = await axios.get("autocomplete/search", {
          params: { searchQuery: this.search }
        });

        this.items = res.data;
      } catch (error) {
        console.log(error.response.data);
      }
      this.filterResults();
    },
    filterResults() {
      this.results = this.items.filter(
        item => item.city.toLowerCase().indexOf(this.search.toLowerCase()) > -1
      );
    }
  },
  watch: {
    items: function(val, oldValue) {
      // actually compare them
      if (val.length !== oldValue.length) {
        this.results = val;
        this.isLoading = false;
      }
    }
  },
  components: {
    VueTagsInput,
    vueDropzone: vue2Dropzone,
    GoogleMap,
    MobileGreenMenuSmall,
    AddProjectOrService,
    Multiselect,
    Copyrights,
    Loader, // TsB - loader
  }
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

.multiselect__input {
  border: none !important;
}
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

  .col-lg-12 {
    margin: 0px;
    padding: 0px;
    background-color: #f8f8f8;
  }

  #add-listing {
    margin: 0px 26px;
    background: #FFFFFF;
    border: 0.25px solid #9EA3BD;
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
    border-bottom: 1px solid #CACACA;
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
    border-bottom: 1px solid #CACACA;
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

  .col-md-12 input, .col-md-12 select {
    background: #FFFFFF;
    border: 0.25px solid #6BBF3F;
    box-sizing: border-box;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
    border-radius: 5px;
    height: 40px;
  }

  .col-md-12 select { 
    margin: 6px 0px;
    padding: 0px;
  }

  .vue-tags-input {
    /* height: 71px; */
    background: #FFFFFF;
    /* border: 0.25px solid #6BBF3F; */
    box-sizing: border-box;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
    border-radius: 5px;
  }

  .vue-tags-input .ti-input {
    background: #FFFFFF;
    border: 0.25px solid #6BBF3F;
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
    border-top: 1px solid #CACACA;
    border-bottom: unset;
  }

  .add-listing-section.section-details .add-listing-headline {
    margin: 0px;
  }

  .dropzone {
    margin-top: 0px;
    background: #FFFFFF;
    border: 0.25px solid #6BBF3F;
    box-sizing: border-box;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
    border-radius: 5px;
  }

  .form div:nth-child(2) {
    background: #FFFFFF;
    border: 0.25px solid #6BBF3F;
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
    background: #6BBF3F;
    border-radius: 20px;
    font-size: 20px;
    line-height: 23px;
    width: 354px;
    height: 43px;
  }
}

@media only screen and (max-width: 990px) {
  .mobile-part {
    display: flex;
    flex-direction: column;
    background-color: #FFFFFF;
    overflow: hidden;
  }

  .desktop-part {
    display: none;
  }

  .mobile-part .row {
    background-color: #F7F7F7;
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
    border: 1px solid #CACACA;
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
    background: #FFFFFF;
    border: 0.75px solid #6BBF3F;
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
    background: #FFFFFF;
    border: 0.75px solid #6BBF3F;
    box-sizing: border-box;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
    border-radius: 10px;
    /* max-width: 347px; */
  }

  /* .multi_select_service.multiselect--active {
    list-style-type: none;
    text-decoration: none;
  } */

  .vue-tags-input {
    max-width: unset;
    background: #FFFFFF;
    border: 0.75px solid #6BBF3F;
    box-sizing: border-box;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
    border-radius: 10px;
    max-height: 74px;
  }
  .add-listing-headline {
    background-color: unset;
    border-bottom: unset ;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 0px;
  }

  .editor-item {
    background: #FFFFFF;
    border: 0.75px solid #6BBF3F;
    box-sizing: border-box;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
    border-radius: 10px;
  }

  #dropzone {
    background: #FFFFFF;
    border: 0.75px solid #6BBF3F;
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
    color: #FFFFFF;
    background: #6BBF3F;
    border-radius: 20px;
  }
}
</style>
