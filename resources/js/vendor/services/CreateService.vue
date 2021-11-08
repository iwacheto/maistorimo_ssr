<template>
  <div>

    <!-- DESKTOP PART -->
    <div class="desktop-part">
      <!-- Titlebar -->
      <div id="titlebar">
        <div class="row">
          <div class="col-md-12">
            <h2>Добавяне на услуга</h2>
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
                  <img src="/images/info-circle-solid.svg" alt="info icon"> Основна информация
                </h3>
                <span v-if="error.commonError" class="error">{{error.commonError}}</span>
              </div>

              <!-- Title -->
              <div class="section-with-forms">

                <div class="with-forms">
                  <div class="col-md-12">
                    <span v-if="error.titleError" class="error error_service">Заглавието е задължително!</span>
                    <h5>
                      Заглавие на услугата
                    </h5>
                    <input class="search-field" type="text" v-model="service.title" />
                  </div>

                  <div class="col-md-12">
                    <span v-if="error.categoryError" class="error">Моля, изберете категория!</span>
                    <h5>Категория</h5>


                    <select class="chosen-select-no-single" v-model="service.category">
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

                <div class="galery-section">
                  <!-- <span v-if="error.imageError" class="error">Моля, качете снимка на услугата</span> -->
                  <h5>
                    <i class="sl sl-icon-picture"></i> Главна снимка
                  </h5>

                  <vue-dropzone
                      ref="myVueDropzone"
                      @vdropzone-success="mainImageUploaded"
                      @vdropzone-drop="disableButton"
                      id="dropzone"
                      :options="dropzoneOptions"
                    ></vue-dropzone>
                </div>
              </div>

              <div class="add-listing-section section-details">
                <div class="add-listing-headline">
                  <h5>Описание 1</h5>
                  <div class="row with-forms">
                    <!-- Status -->
                    <div class="col-md-12">
                      <span v-if="error.firstDescriptionError" class="error">Моля напишете описание!</span>

                      <!-- <label>Описание 1</label> -->
                      <ckeditor
                        :editor="editorConfig.editor"
                        v-model="service.firstDescription"
                        :config="editorConfig.editorConfig"
                      ></ckeditor>
                    </div>
                  </div>
                </div>

                <div class="add-listing-headline">
                  <h5>Описание 2</h5>
                  <div class="row with-forms">
                    <!-- Status -->
                    <div class="col-md-12">
                      <!-- <span
                        v-if="service.secondDescriptionError"
                        class="error"
                      >{{service.secondDescriptionError[0]}}</span>-->
                      <!-- <label>Текст за Нас - Компания</label> -->
                      <ckeditor
                        :editor="editorConfig.editor"
                        v-model="service.secondDescription"
                        :config="editorConfig.editorConfig"
                      ></ckeditor>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Row -->

              <loader :active="loaderActive" :text="'Моля изчакайте!'" />

              <!-- Row -->
              <div class="button-part">
                <button @click="createService" class="button preview">
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

    <!-- MOBILE  PART -->
    <div class="mobile-part">

      <AddProjectOrService/>

      <MobileGreenMenuSmall/>

      <div class="row">

        <!-- Titlebar -->
        <div id="titlebar">
          <div class="row">
            <div class="col-md-12">
              <h2>Добавяне на услуга</h2>
            </div>
          </div>
        </div>

        <div class="horizontal-line"></div>

        <h3>
          <img src="/images/info-circle-solid.svg" alt="info icon"> Основна информация
        </h3>
        <span v-if="error.commonError" class="error">{{error.commonError}}</span>

        <div class="col-lg-12">
          <div id="add-article">
            <!-- Section -->
            <div class="add-listing-section">
              <div class="section-with-forms">
                <div class="with-forms">
                  <div class="col-md-12">
                    <span v-if="error.titleError" class="error error_service">Заглавието е задължително!</span>
                    <h5>
                      Заглавие на услугата
                    </h5>
                    <input class="search-field" type="text" v-model="service.title" />
                  </div>

                  <div class="col-md-12">
                    <span v-if="error.categoryError" class="error">Моля, изберете категория!</span>
                    <h5>Категория</h5>


                    <select class="chosen-select-no-single" v-model="service.category">
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

                <div class="galery-section">
                  <!-- <span v-if="error.imageError" class="error">Моля, качете снимка на услугата</span> -->
                  <h5>
                    <i class="sl sl-icon-picture"></i> Главна снимка
                  </h5>

                  <vue-dropzone
                      ref="myVueDropzone"
                      @vdropzone-success="mainImageUploaded"
                      @vdropzone-drop="disableButton"
                      id="dropzone"
                      :options="dropzoneOptions"
                    ></vue-dropzone>
                </div>
              </div>

              <div class="add-listing-section section-details">
                <div class="add-listing-headline">
                  <h5>Описание 1</h5>
                  <div class="row with-forms">
                    <!-- Status -->
                    <div class="col-md-12">
                      <span v-if="error.firstDescriptionError" class="error">Моля напишете описание!</span>

                      <!-- <label>Описание 1</label> -->
                      <ckeditor
                        :editor="editorConfig.editor"
                        v-model="service.firstDescription"
                        :config="editorConfig.editorConfig"
                      ></ckeditor>
                    </div>
                  </div>
                </div>

                <div class="add-listing-headline">
                  <h5>Описание 2</h5>
                  <div class="row with-forms">
                    <!-- Status -->
                    <div class="col-md-12">
                      <!-- <span
                        v-if="service.secondDescriptionError"
                        class="error"
                      >{{service.secondDescriptionError[0]}}</span>-->
                      <!-- <label>Текст за Нас - Компания</label> -->
                      <ckeditor
                        :editor="editorConfig.editor"
                        v-model="service.secondDescription"
                        :config="editorConfig.editorConfig"
                      ></ckeditor>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Row -->

              <loader :active="loaderActive" :text="'Моля изчакайте!'" />

              <!-- Row -->
              <div class="button-part">
                <button @click="createService" class="button preview">
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
  </div>
</template>
<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
import Copyrights from '../partials/Copyrights.vue';
import MobileGreenMenuSmall from '../partials/MobileGreenMenuSmall.vue';
import AddProjectOrService from '../partials/AddProjectOrService.vue';
import Loader from '../../components/Loader.vue'; // TsB - loader
import loaderMixin from '../mixins/loader'; // TsB - loader

export default {
  name: "CreateService",
  data() {
    return {
      categories: [],
      isCreated: true,
      editorConfig: {
        editor: ClassicEditor,
        editorData: "<p>Content of the editor.</p>",
        editorConfig: {
          // The configuration of the editor.
        }
      },
      serCategories: [],
      category: "",
      service: {
        title: "",
        firstDescription: "",
        secondDescription: "",
        category: "",
        mainImage: {},
        all_country: 1
      },
      error: {
        commonError: false,
        titleError: false,
        firstDescriptionError: false,
        categoryError: false,
        imageError: false
      },
      dropzoneOptions: {
        url: "/vendor/galleries/uploadImage",
        maxFiles: 1,
        addRemoveLinks: true,
        thumbnailWidth: 150,
        maxFilesize: 15,
        headers: { "My-Awesome-Header": "header value" }
      }
    };
  },
  mixins: [loaderMixin], // TsB - loader
  mounted() {
    this.$refs.mytoast.defaultPosition = "toast-top-center";
    this.$refs.mytoast.defaultStyle = { top: "80px" };
    // this.getServicesCategory();
    this.getCategories();
  },
  methods: {
    getCategories() {
      axios.get("/categories/getcat").then(({ data }) => {
        this.categories = data;
      });
    },
    async getServicesCategory() {
      try {
        const responce = await axios.get("/vendor/service_category");
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
            this.showLoader(); //TsB - loader
            this.isCreated = false;
            const res = await axios.post("/vendor/service", this.service);
            this.$refs.mytoast.s("Услугата бе създадена успешно!");
            setTimeout(() => {
              this.$router.push({ name: "ServicesList" });
              this.isCreated = true;
            }, 3000);
            this.hideLoader(); // TsB - loader
          }
        } catch (error) {
          console.log(error);
          this.isCreated = true;
        }
      }
    },
    scrollToError() {
      setTimeout(function() {
        let elem = document.querySelector(".error");
        const y = elem.getBoundingClientRect();
        elem.scrollIntoView({ behavior: "smooth", block: "center" });
      }, 500);
    },
    mainImageUploaded(file, response) {
      this.service.mainImage = { url: response.url, name: file.name };
    },
    removedMainImage(file, error, xhr) {
      this.service.mainImage.splice(0, 1);
    }
  },
  components: {
    vueDropzone: vue2Dropzone,
    Copyrights,
    MobileGreenMenuSmall,
    AddProjectOrService,
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
    border-bottom: 1px solid #CACACA;
    border-top: 1px solid #CACACA;
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
  .col-md-12 input, .col-md-12 select {
    background: #FFFFFF;
    border: 0.25px solid #6BBF3F;
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
    background: #FFFFFF;
    border: 0.25px solid #6BBF3F;
    box-sizing: border-box;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
    border-radius: 5px;
    height: 40px;
    padding: 5px;
  }
  .vue-tags-input {
    height: 71px;
    background: #FFFFFF;
    border: 0.25px solid #6BBF3F;
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
  @media screen and (max-width: 991px) {
  }
}

@media only screen and (max-width: 990px) {
  .mobile-part {
    display: flex;
    flex-direction: column;
    background-color: #FFFFFF;
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

  #add-article h5 {
    font-style: normal;
    font-weight: bold;
    font-size: 17px;
    line-height: 20px;
    color: #276955;
    margin: 21px 0px 10px 20px;
  }

  #add-article input {
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

  #add-article select {
    height: 49px;
    background: #FFFFFF;
    border: 0.75px solid #6BBF3F;
    box-sizing: border-box;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
    border-radius: 10px;
    /* max-width: 347px; */
  }

  .multi_select_service {
    height: 49px;
    background: #FFFFFF;
    border: 0.75px solid #6BBF3F;
    box-sizing: border-box;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
    border-radius: 10px;
    padding: 10px;
  }

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
