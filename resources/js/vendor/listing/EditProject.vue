<template>
  <div>
    <!-- Titlebar -->
    <div id="titlebar">
      <div class="row">
        <div class="col-md-12 heading_admin">
          <h2>Добави проект</h2>
          <a @click="goToProject" class="button preview project_link">
            Виж Проекта
            <i class="fa fa-arrow-circle-right"></i>
          </a>
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
            </div>

            <!-- Title -->
            <div class="row with-forms">
              <div class="col-md-12">
                <h5>
                  Заглавие на проекта
                  <span class="required">*</span>
                  <i class="tip" data-tip-content="Име на вашият бизнес"></i>
                </h5>
                <input class="search-field" v-model="project.title" type="text" value />
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
                <select class="chosen-select-no-single" v-model="project.category">
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
                    >{{ category.title }}</option>
                    <option value="21">Друга</option>
                  </optgroup>
                </select>
              </div>

              <!-- Type -->
              <div class="col-md-6">
                <h5>
                  Ключови думи
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
                <google-map
                  v-if="project.lat && project.lng && project.formatted_address && project.raw_data"
                  :lat="project.lat"
                  :lng="project.lng"
                  :formatted_address="project.formatted_address"
                  :placeObj="project.raw_data"
                />
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
            </div>
          </div>
          <!-- Section / End -->

          <!-- Section -->
          <div class="add-listing-section margin-top-45">
            <!-- Headline -->
            <div class="add-listing-headline">
              <h3>
                <i class="sl sl-icon-picture"></i> Галерия
              </h3>
            </div>

            <!-- Dropzone -->

            <gallery :images="images" :index="index" @close="index = null"></gallery>
            <div
              class="image"
              v-for="(image, imageIndex) in project.project_galleries"
              :key="imageIndex"
              @click="index = imageIndex"
              :style="{ backgroundImage: 'url(' + image.url + ')', width: '300px', height: '200px' }"
              v-if="image.deleted != 1"
            >
              <a @click.stop="deleteImage(imageIndex)" class="button del_btn">
                <i class="sl sl-icon-close"></i> Delete
              </a>
              
            </div>
            <vue-dropzone
              ref="myVueDropzone"
              @vdropzone-success="imageUploaded"
              id="dropzone"
              :options="dropzoneOptions"
            ></vue-dropzone>
          </div>
          <!-- Section / End -->

          <a @click="editProject" class="button preview">
            Радактирай
            <i class="fa fa-arrow-circle-right"></i>
          </a>
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
import "vue2-dropzone/dist/vue2Dropzone.min.css";
import VueGallery from "vue-gallery";
import Snackbar from "../../global/components/Snackbar.vue";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

import GoogleMap from "../../components/googleMap/GoogleMap";

export default {
  props: ["id"],
  data() {
    return {
      service: "",
      categories: [],
      userServices: [],
      userServicesTags: [],
      project: {
        category: null,
        title: "",
        description: "",
        short_description: "",
        selectedServices: [],
        tags: [],
        images: [],
        titleError: false,
        categoryError: false,
        descriptionError: false,
        commonError: false
      },
      dropzoneOptions: {
        url: "/vendor/galleries/uploadImage",
        thumbnailWidth: 150,
        maxFilesize: 0.5,
        headers: { "My-Awesome-Header": "header value" },
         addRemoveLinks: true
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
      index: null,
      images: [],
      tags: [],
      deletedTagsCount: 0,
      message: ""
    };
  },
  mounted() {
    this.$refs.mytoast.defaultPosition = "toast-top-center";
    this.$refs.mytoast.defaultStyle = { top: "80px" };
    this.getCategories();
    this.getTags();
    this.getProject();
    this.getServices();
  },
  computed: {
    filteredTags() {
      return this.autocompleteItems.filter(i => {
        return i.text.toLowerCase().indexOf(this.tag.toLowerCase()) !== -1;
      });
    }
  },
  methods: {
    goToProject() {
      window.open("/project/details/" + this.project.id, "_blank");
    },
    getServices() {
      axios.get("/vendor/service/getForSelect").then(({ data }) => {
        this.userServices = data.map(a => {
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
      this.service = "";
    },
    deleteTag(tag) {
      this.project.tags[tag.index + this.deletedTagsCount]["deleted"] = 1;
      this.tags.splice(tag.index, 1);
      this.deletedTagsCount++;
    },
    deleteService(service) {
      this.userServicesTags.splice(service.index, 1);
    },
    deleteImage(index) {
      this.project.project_galleries[index]["deleted"] = 1;
      this.images.splice(index, 1);
    },
    async getProject() {
      try {
        const res = await axios.get("/vendor/projects/get/" + this.id);

        this.project = res.data;
        // @remove="updateSelectedServices"
        // this.project.selectedServices = [];

        let userServicesTags = [];
        for (var i in this.project.project_services) {
          this.userServicesTags.push({
            id: this.project.project_services[i]["service"]["id"],
            text: this.project.project_services[i]["service"]["name"]
          });
        }
        // this.userServicesTags = createTags(userServicesTags, [{type: "length", rule: /[0-9]/}]);

        let data = {
          lng: this.project.lng,
          lat: this.project.lat,
          formatted_address: this.project.formatted_address,
          raw_data: this.project.raw_data
        };
        this.$store.commit("changePosition", data);
        for (var i in this.project.project_galleries) {
          this.images[i] = this.project.project_galleries[i].url;
        }
        let tags = [];
        for (var i in this.project.tags) {
          tags.push({
            text: this.project.tags[i].tag.tag,
            id: this.project.tags[i].tag.id
          });
        }
        this.project.tags = tags;
        this.tags = createTags(tags, [{ type: "length", rule: /[0-9]/ }]);
      } catch (error) {
        console.log(error);
      }
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
          "/vendor/projects/" + this.project.id + "/edit",
          this.project
        );
         this.$refs.myVueDropzone.removeAllFiles();
        this.$refs.mytoast.s("Проектът бе редактиран успешно!");
        // setTimeout(() => {
        // 	this.$router.push({name: 'ProjectsList'})
        // }, 3000);
      } catch (error) {
        if (error.response.data.errors.title) {
          this.project.titleError = error.response.data.errors.title;
        }
        if (error.response.data.errors.description) {
          this.project.descriptionError =
            error.response.data.errors.description;
        }
        if (error.response.data.errors.category) {
          this.project.categoryError = error.response.data.errors.category;
        }

        console.log(error.response.data.errors);
      }
    },
    getTags() {
      axios.get("/vendor/tags/get").then(({ data }) => {
        this.autocompleteItems = data;
      });
    },
    getCategories() {
      axios.get("/categories/getcat").then(({ data }) => {
        this.categories = data;
      });
    }
  },
  components: {
    VueTagsInput,
    vueDropzone: vue2Dropzone,
    gallery: VueGallery,
    snackbar: Snackbar,
    GoogleMap,
    Multiselect
  }
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>
.image {
  float: left;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center center;
  border: 1px solid #ebebeb;
  margin: 5px;
}
</style>
