<template>
  <div>
    <!-- Titlebar -->
    <div id="titlebar">
      <div class="row">
        <div class="col-md-12">
          <h2>Добави проект</h2>
          <!-- Breadcrumbs -->
          <nav id="breadcrumbs">
            <ul>
              <li>
                <a href="#">Начало</a>
              </li>
              <li>
                <a href="#">Табло</a>
              </li>
              <li>Добави проект</li>
            </ul>
          </nav>
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
                <i class="sl sl-icon-doc"></i> Основна информация
              </h3>
              <span v-if="project.commonError" class="error">{{project.commonError}}</span>
            </div>

            <!-- Title -->
            <div class="row with-forms">
              <div class="col-md-12">
                <h5>
                  Заглавие на проект
                  <span class="required">*</span>
                  <i class="tip" data-tip-content="Name"></i>
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
                    <span class="required">*</span>
                    <i
                      class="tip"
                      data-tip-content="Максимум 15 ключови думи, описващи вашият бизнес"
                    ></i>
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

            <!-- Row -->
            <div class="row with-forms">
              <!-- Status -->
              <div class="col-md-6">
                <h5>
                  Категория
                  <span class="required">*</span>
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

              <!-- <div class="autocomplete">
                  <h5>
                    Категории
                    <span class="required">*</span>
                    <i
                      class="tip"
                      data-tip-content="Максимум 15 ключови думи, описващи вашият бизнес"
                    ></i>
                  </h5>
                   <span v-if="error.categoryError" class="error">Моля изберете категория!</span>
                  <input type="text" v-model="search" @input="onChange" class="cityInput" />
                  <ul v-show="isOpen" class="autocomplete-results">
                    <li
                      v-for="(result, i) in results"
                      :key="i"
                      @click="setResult(result)"
                      class="autocomplete-result"
                    >{{ result.city }}</li>
                  </ul>
              </div>-->

              <!-- Type -->
              <div class="col-md-6">
                <h5>
                  Ключови думи
                  <span class="required">*</span>
                  <i
                    class="tip"
                    data-tip-content="Максимум 15 ключови думи, описващи вашият бизнес"
                  ></i>
                </h5>
                <vue-tags-input
                  v-model="tag"
                  :tags="tags"
                  :autocomplete-items="filteredTags"
                  @tags-changed="newTags => project.tags = newTags"
                />
                <!-- <vue-tags-input
                  v-model="tag"
                  :tags="project.tags"
                  @tags-changed="newTags => project.tags = newTags"
                />-->
                <span v-if="error.tagsError" class="error">Моля напишете ключова дума!</span>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <h5>
                  Услуги
                  <i
                    class="tip"
                    data-tip-content="Максимум 15 ключови думи, описващи вашият бизнес"
                  ></i>
                </h5>
                <multiselect
                  class="multi_select_service"
                  v-model="userServicesTags"
                  label="text"
                  :multiple="true"
                  track-by="id"
                  :options="userServices"
                ></multiselect>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <google-map />
              </div>
            </div>
            <!-- Row / End -->
          </div>
          <!-- Section / End -->

          <!-- Section -->
          <div class="add-listing-section margin-top-45">
            <!-- Headline -->
            <div class="add-listing-headline">
              <h3>
                <i class="sl sl-icon-docs"></i> Детайли
              </h3>
            </div>

            <!-- Description -->
            <div class="form">
              <h5>
                Описание
                <span class="required">*</span>
              </h5>

              <ckeditor
                :editor="editorConfig.editor"
                v-model="project.description"
                :config="editorConfig.editorConfig"
              ></ckeditor>
              <!-- <textarea
                class="WYSIWYG"
                name="summary"
                cols="40"
                rows="3"
                id="summary"
                spellcheck="true"
                v-model="project.description"
                @focus="makeFocus('description')"
              ></textarea>-->
              <span v-if="error.descriptionError" class="error">Моля добавете описание на проекта!</span>
              <span v-if="desc_error" class="error">Описанието трябва да е поне с 15 букви!</span>
            </div>
          </div>
          <!-- Section / End -->

          <!-- Section -->
          <div class="add-listing-section margin-top-45">
            <!-- Headline -->
            <div class="add-listing-headline">
              <h3>
                <i class="sl sl-icon-picture"></i> Галерия
                <span class="required">*</span>
              </h3>
            </div>

            <!-- Dropzone -->
            <vue-dropzone
              ref="myVueDropzone"
              @vdropzone-success="imageUploaded"
              @vdropzone-drop="disableButton"
              id="dropzone"
              :options="dropzoneOptions"
            ></vue-dropzone>
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

          <button
            @mouseover="showErrors"
            @mouseleave="showAllErrors=!showAllErrors"
            @click="createProject"
            class="button preview"
            :class="[isDisabled ? 'green' : '']"
            :disabled="isDisabled"
          >
            Създай
            <i class="fa fa-arrow-circle-right"></i>
          </button>
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
import Multiselect from "vue-multiselect";
import { VueTagsInput, createTag, createTags } from "@johmun/vue-tags-input";
import vue2Dropzone from "vue2-dropzone";
import GoogleMap from "../../components/googleMap/GoogleMap";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

import "vue2-dropzone/dist/vue2Dropzone.min.css";

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
      this.project.images.push(response);
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
        let elem = document.querySelector(".error");
        const y = elem.getBoundingClientRect();
        elem.scrollIntoView({ behavior: "smooth", block: "center" });
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
      if (this.allErrors == false) {
        return;
      }

      try {
        if (this.isCreated) {
          this.isCreated = false;
          const res = await axios.post("/vendor/projects/add", this.project);
          this.$refs.mytoast.s("Проектът бе създаден успешно!");
          setTimeout(() => {
            this.$router.push({ name: "ProjectsList" });
            this.isCreated = true;
          }, 3000);
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
    Multiselect
  }
};
</script>

<style scoped>
.autocomplete {
  position: relative;
  width: 130px;
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
</style>
