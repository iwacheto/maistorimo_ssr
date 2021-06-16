<template>
  <div class="container margin-top-100">
    <div class="row">
      <div class="col-md-12">
        <div class="main-search-input gray-style margin-top-0 margin-bottom-10">
          <div class="main-search-input-item">
            <input type="text" v-model="title" placeholder="Какво търсите?" />
          </div>

          <div class="main-search-input-item location">
            <div id="autocomplete-container">
              <div
                class="pac-container pac-logo"
                style="display: none; width: 310px; position: absolute; left: 727px; top: 351px;"
              ></div>
              <input
                id="autocomplete-input"
                type="text"
                class
                placeholder="Град"
                v-model="city"
                @input="onChange"
              />
            </div>
            <a href="#">
              <i class="fa fa-map-marker"></i>
            </a>
          </div>

          <div class="main-search-input-item">
            <select data-placeholder="Категория" class="chosen-select" v-model="category">
              <option value="null">Всички категории</option>
              <option v-for="category in categories" :key="category.id" :value="category.id">
                {{
                category.title }}
              </option>
            </select>
          </div>
          <div class="search_button">
            <button class="button" @click="applyFilters">Намери</button>
          </div>
        </div>
      </div>
      <div
        class="col-md-12 infinite-list"
      >
        <!-- Listing Item -->
        <div v-for="project in projects" :key="project.id" class="col-lg-4 col-md-6">
          <router-link
            :to="'/project/details/' + project.id"
            class="listing-item-container compact"
          >
            <div class="listing-item">
              <img :src="project.project_galleries[0].url" alt />

              <div class="listing-badge now-open">Верифициран</div>

              <div class="listing-item-content">
                <h3>
                  {{ project.title }}
                  <i class="verified-icon"></i>
                </h3>
                <span v-for="tag in project.tags" :key="tag.id">#{{ tag.tag }}</span>
              </div>
              <span class="like-icon"></span>
            </div>
          </router-link>
        </div>
        <!-- Listing Item / End -->
      </div>
      <infinite-loading @infinite="infiniteHandler"></infinite-loading>
    </div>
  </div>
</template>


<script>
import { EventBus } from "../event-bus";
import infiniteScroll from "vue-infinite-scroll";
import InfiniteLoading from "vue-infinite-loading";
import axios from "axios";

var count = 0;

export default {
  props: ["filters", "category", "city", "title"],
  data() {
    return {
      categories: [],
      projects: [],
      projectsLoaded: [],
      limit: 5,
      busy: false,
      page: 1
    };
  },
  watch: {
    filters: {
      handler: function(newValue) {
        console.log(newValue);
        if (!newValue.title && newValue.category == "null") {
          EventBus.$emit("filter-reset");
        }
      },
      deep: true
    }
  },
  created() {
    this.getCategories();
  },
  mounted() {
    // this.getListings();
    // this.applyFilters();
    // this.infiniteHandler();
    // Detect when scrolled to bottom.
  },
  methods: {
     search() {
        axios
            .get("/projects", {
                params: {
                    filters: {
                        title: this.title,
                        category: this.category,
                        city: this.city,
                    },
                    page: this.page
                }
            })
            .then(res => {
                this.projects = res.data;
                this.page++;
            })
            .catch(err => {
                this.busy = false;
            });
    },
    applyFilters(page = 1) {
      this.page = 1;
      this.search();
    },
    async getCategories() {
      try {
        const res = await axios.get("/categories/get");

        this.categories = res.data;
      } catch (error) {
        console.log(error.response.data);
      }
    },
    async onChange() {
      this.isOpen = true;
      try {
        const res = await axios.get("autocomplete/search", {
          params: { searchQuery: this.city }
        });

        this.items = res.data;
      } catch (error) {
        console.log(error.response.data);
      }

      this.filterResults();
    },
    filterResults() {
      this.results = this.items.filter(
        item => item.city.toLowerCase().indexOf(this.city.toLowerCase()) > -1
      );
    },

    async infiniteHandler($state) {

        axios
            .get("/projects", {
                params: {
                    filters: {
                        title: this.title,
                        category: this.category,
                        city: this.city,
                    },
                    page: this.page
                }
            })
            .then(res => {
                if(res.data.length == 0) {
                    $state.complete();
                }
                this.page++;
                this.projects.push(...res.data);
                $state.loaded();
            })
            .catch(err => {
                this.busy = false;
            });
    }
    // Infinite loading
  },
  directives: { infiniteScroll },
  components: {
    InfiniteLoading
  }
};
</script>

<style scoped>
.autocomplete {
  position: relative;
  width: 130px;
}

.autocomplete-results {
  padding: 0;
  margin: 0;
  border: 1px solid #eeeeee;
  height: 120px;
  overflow: auto;
  background: #fff;
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
input#autocomplete-input {
  background-image: url(/images/marker-24.png);
  display: inline-block;
  height: 44px;
  background-repeat: no-repeat;
  background-position: 245px 0;
  vertical-align: middle;
}
.search_button {
  text-align: center;
}
</style>
