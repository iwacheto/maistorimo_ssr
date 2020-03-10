<template>
  <div class="container">
    <div class="main-search-inner">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2>Майсторимо</h2>
            <h4>Намери своя Майстор сега!</h4>
            <div class="highlighted-categories main_search">
              <!-- Box -->
              <!-- <a
                href="javascript:;"
                class="highlighted-category"
                :class="[page=='listings']? 'active_search_link' : ''"
                @click="changeClass('listings')"
              >-->
              <a
                href="javascript:;"
                class="highlighted-category"
                @click="changeClass('listings')"
                :class="[page=='listings' ? 'active_search_link': '']"
              >
                <i class="im im-icon-Home"></i>
                <h4>Проекти</h4>
              </a>

              <!-- Box -->
              <a
                href="javascript:;"
                class="highlighted-category"
                @click="changeClass('services')"
                :class="[page=='services' ? 'active_search_link': '']"
              >
                <i class="im im-icon-Hamburger"></i>
                <h4>Услуги</h4>
              </a>
            </div>
            <div class="main-search-input">
              <div class="main-search-input-item">
                <input type="text" placeholder="Какво търсите?" v-model="filters.title" />
              </div>

              <div class="main-search-input-item location">
                <div id="autocomplete-container" v-click-outside="closeAutocomplete">
                  <input
                    id="autocomplete-input"
                    type="text"
                    class
                    placeholder="Град"
                    v-model="filters.city"
                    @input="onChange"
                    autocomplete="off"
                  />
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

              <div class="main-search-input-item">
                <select
                  data-placeholder="Категория"
                  v-model="filters.category"
                >
                  <option value="null">Всички категории</option>
                  <optgroup
                    :label="mainCategory.title"
                    v-for="mainCategory in projectCategories"
                    :key="mainCategory.id"
                  >
                    <option
                      v-for="category in mainCategory.children"
                      :key="category.id"
                      :value="category.title"
                    >
                      {{
                      category.title }}
                    </option>
                  </optgroup>
                </select>
              </div>
              
              <button class="button" @click="applyFilters">Намери</button>
            </div>
          </div>
        </div>
        <!--</div>-->
        <!--</div>-->
        <!-- Featured Categories - End -->
        <!-- poster="images/main-search-video-poster.jpg" -->
      </div>
    </div>

    <div class="video-container">
      <video loop autoplay muted class="main_video">
        <source src="construction_video.webm" type="video/mp4" />
      </video>
    </div>
  </div>
</template>

<script>
import { EventBus } from "../event-bus";
import axios from "axios";

export default {
  name: "Search",
  created() {
    // this.getCategories();
    this.page = "listings";
  },
  computed: {
    projectCategories() {
      //  console.log(this.$store.state.projectCategories, 'Pesho')
      if (this.page == "listings") {
        return this.$store.state.projectCategories;
      } else if (this.page == "services") {
        return this.$store.state.serviceCategories;
      }
    }
  },
  watch: {
    filters: {
      handler: function(newValue) {
        if (!newValue.title && newValue.category == "null") {
          EventBus.$emit("filter-reset");
        }
      },
      deep: true
    },
    items: function(val, oldValue) {
      if (val.length !== oldValue.length) {
        this.results = val;
        this.isLoading = false;
      }
    }
  },
  data() {
    return {
      categories: [],
      page: null,
      results: [],
      isOpen: false,
      items: [],
      isActive: "projects",
      filters: {
        category: null,
        city: null,
        title: null
        // mainCategory: []
      }
    };
  },
  methods: {
    changeClass(val) {
      this.isActive = val;
      this.page = val;
    },
    async getCategories() {
      
    },
    applyFilters() {
      let object = this.filters;
      let objToPush = {};
      for (const property in object) {
        if (object[property]) {
          objToPush[property] = object[property];
        }
      }
      this.$router.push({
        path: this.page,
        query: objToPush
      });
    },
    async onChange() {
      this.isOpen = true;
      try {
        const res = await axios.get("autocomplete/search", {
          params: { searchQuery: this.filters.city }
        });

        this.items = res.data;
      } catch (error) {
        console.log(error.response.data);
      }

      this.filterResults();
    },
    setResult(result) {
      this.filters.city = result.city;
      // this.project.city = result.id;
      this.isOpen = false;
    },
    filterResults() {
      this.results = this.items.filter(
        item =>
          item.city.toLowerCase().indexOf(this.filters.city.toLowerCase()) > -1
      );
    },
    closeAutocomplete(event) {
      this.isOpen = false;
    }
  },

  events: {}
};
</script>

