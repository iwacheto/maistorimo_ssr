<template>
    <div class="container margin-top-30">
        <!-- Content
        ==================================================-->
        <div class="container">
            <button
                class="sidebar_menu"
                @click="show_sidebar = !show_sidebar"
                :class="[show_sidebar ? 'active_button' : '']"
            >
                <span :class="[show_sidebar ? 'active_span' : '']"></span>
                <span :class="[show_sidebar ? 'active_span' : '']"></span>
                <span :class="[show_sidebar ? 'active_span' : '']"></span>
            </button>
            <div class="row project_content">
                <!-- Sidebar
                ==================================================-->
                <div
                    class="col-lg-3 col-md-3 col-sm-3 fixed"
                    :class="[show_sidebar ? 'active_sidebar' : '']"
                >
                    <div class="sidebar">
                        <!-- Widget -->
                        <div class="widget">
                            <h3 class="margin-top-0 margin-bottom-30">Търсене</h3>

                            <!-- Row -->
                            <div class="row with-forms">
                                <!-- Cities -->
                                <div class="col-md-12 main-search-input-item">
                                    <input
                                        type="text"
                                        v-model="filterQueries.title"
                                        placeholder="Какво търсите?"
                                        @keyup="searchTimeOut()"
                                    />
                                    <span
                                        class="clear_data"
                                        v-if="filterQueries.title"
                                        @click="clearQuery('title')"
                                        >x</span
                                    >
                                </div>
                            </div>
                            <!-- Row / End -->

                            <!-- Row -->
                            <div class="row with-forms">
                                <!-- Type -->

                                <div class="main-search-input-item location col-md-12">
                                    <div id="autocomplete-container">
                                        <div
                                            class="pac-container pac-logo"
                                            style="
                                                display: none;
                                                width: 310px;
                                                position: absolute;
                                                left: 727px;
                                                top: 351px;
                                            "
                                        ></div>
                                        <input
                                            id="autocomplete-input"
                                            type="text"
                                            class
                                            placeholder="Град"
                                            v-model="filterQueries.city"
                                            @input="onChange"
                                            autocomplete="off"
                                        />
                                        <span
                                            class="clear_data"
                                            v-if="filterQueries.city"
                                            @click="clearQuery('city')"
                                            >x</span
                                        >
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
                                <!-- Categories -->
                                <div class="widget">
                                    <h3 class="margin-bottom-10">Категории</h3>
                                    <div class="category_body">
                                        <!-- <span
                      class="clear_data main_category"
                      v-if="clearCategory"
                      @click="clearQuery('mainCategory')"
                                        >x</span>-->
                                        <!-- <span
                      class="clear_data cat_button"
                      v-if="filterQueries.category"
                      @click="clearQuery('category')"
                                        >x</span>-->
                                        <div
                                            :class="[
                                                filterQueries.mainCategory == category.title
                                                    ? 'active_category'
                                                    : '',
                                            ]"
                                            v-for="category in categories"
                                            :key="category.id"
                                            class="category_sidebar"
                                            @click="
                                                applyMainCategory(category.children, category.title)
                                            "
                                        >
                                            <p
                                                :class="{ active_category: isActiveCat(category) }"
                                                class="main_cats"
                                            >
                                                {{ category.title }}
                                                <span
                                                    class="main_category"
                                                    v-if="isActiveCat(category)"
                                                    @click.stop="clearQuery('mainCategory')"
                                                    >x</span
                                                >
                                            </p>
                                            <div
                                                class="category_body"
                                                :class="[
                                                    filterQueries.category == cat.title
                                                        ? 'active_category'
                                                        : '',
                                                ]"
                                                v-for="cat in category.children"
                                                :key="cat.id"
                                                @click.stop="applyCategory(cat.title)"
                                            >
                                                {{ cat.title }}
                                                <span
                                                    class="cat_button"
                                                    v-if="filterQueries.category == cat.title"
                                                    @click.stop="clearQuery('category')"
                                                    >x</span
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Row / End -->
                        </div>
                        <!-- Widget / End -->

                        <!-- <br />
            <button class="button fullwidth" @click="applyFilters">Намери</button>
            <br />
            <button
              class="button fullwidth reset_button"
              @click="resetFilters"
              v-if="filters.category!='' || filters.city != null || filters.title != null"
                        >Нулирай</button>-->
                    </div>
                </div>
                <!-- Sidebar / End -->

                <div
                    class="col-lg-9 col-md-9 col-sm-9 gallery_listing"
                    :class="[show_sidebar ? 'gallery_listing_active' : '']"
                >
                    <!-- Sorting / Layout Switcher -->
                    <div class="row margin-bottom-25">
                        <div class="col-md-6 col-xs-6">
                            <!-- Layout Switcher -->
                            <div class="layout-switcher">
                                <a href="#" class="grid active" @click="className = false">
                                    <i class="fa fa-th"></i>
                                </a>
                                <a href="#" class="list" @click="className = true">
                                    <i class="fa fa-align-justify"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Sorting / Layout Switcher / End -->

                    <div class="row">
                        <!-- Listing Item -->
                        <div
                            v-for="service in services"
                            :key="service.id"
                            :class="[className ? 'col-lg-12 col-md-12' : 'col-lg-6 col-md-12']"
                        >
                            <router-link
                                :to="'/service/details/' + service.id"
                                class="listing-item-container compact"
                            >
                                <div class="listing-item" @click="scrollTop">
                                    <img :src="service.image_url" alt />

                                    <div class="listing-badge now-open">Верифицирана</div>

                                    <div class="listing-item-content">
                                        <h3>
                                            {{ service.name }}
                                            <i class="verified-icon"></i>
                                        </h3>
                                    </div>
                                </div>
                            </router-link>
                        </div>
                        <!-- Listing Item / End -->
                    </div>
                    <!-- <div class="row" v-else>
            <h4>Съжаляваме,но вашето търсене не намери резултат,моля опитайте с други данни,благодарим ви.</h4>
                    </div>-->
                    <div v-if="services.length == 0" class="no_results">
                        <h3>Съжаляваме, но вашето търсене няма резултат</h3>
                        <p>Моля,опитайте с други критерий!</p>
                        <div class="listing-item">
                            <img src="/images/listing-item-03.jpg" alt />

                            <div class="listing-badge now-open">Некатегоризиран</div>

                            <div class="listing-item-content">
                                <h3>
                                    Не е намерено нищо
                                    <i class="verified-icon"></i>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <client-only placeholder="Loading...">
                <infinite-loading
                    @infinite="infiniteHandler"
                    ref="infiniteLoading"
                ></infinite-loading>
            </client-only>
        </div>
    </div>
</template>

<script>
import InfiniteLoading from 'vue-infinite-loading';
import ClientOnly from 'vue-client-only';
import { project_services_functions } from '../mixins/project_services_functions';
import axios from 'axios';
import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);
var count = 0;

export default {
    metaInfo() {
        return {
            meta: [],
        };
    },
    mixins: [project_services_functions],
    data() {
        return {
            city: '',
            title: '',
            filters: {
                category: null,
                city: null,
                title: null,
                mainCategory: [],
            },
            filterQueries: {
                title: null,
                city: null,
                category: null,
                mainCategory: [],
            },
            selectTag: [],
            projects: [],
            services: [],
            projectsLoaded: [],
            limit: 5,
            busy: false,
            page: 1,
            className: false,
            show_sidebar: false,
            results: [],
            isOpen: false,
            serCategories: [],
        };
    },
    created() {
        this.setFilters();
    },
    mounted() {
        window.scrollTo(0, 0);
    },
    watch: {
        filters: {
            handler: function (newValue) {},
            deep: true,
        },
        $route(to, from) {
            window.scrollTo(0, 0);
            let query = this.$route.query;
            if (Object.keys(query).length === 0) {
                this.page = 1;
                this.$router.push({ query: {} });
                Vue.nextTick(() => {
                    this.$router.push({ path: '/services' });
                    this.infiniteHandler();
                });
            } else {
                if (to.fullPath == from.fullPath) return;
                this.page = 1;
                this.search(query);
            }
        },
    },
    methods: {
        scrollTop() {
            window.scrollTo(0, 0);
        },
        async onChange() {
            this.isOpen = true;
            try {
                const res = await axios.get('/autocomplete/search', {
                    params: { searchQuery: this.city },
                });
                this.items = res.data;
            } catch (error) {
                console.log(error.response.data);
            }
            this.filterResults();
        },
        async getServicesCategory() {
            try {
                const responce = await axios.get('/service_category');
                this.serCategories = responce.data;
            } catch (error) {
                console.log(error);
            }
        },
        search(query) {
            // console.log("Search");
            axios
                .get('/services_all', {
                    params: {
                        filters: query,
                        page: this.page,
                    },
                })
                .then((res) => {
                    this.services = res.data;
                    this.page++;
                })
                .catch((err) => {
                    this.busy = false;
                });
        },
        applyFilters(page = 1) {
            let query = this.filterQueries;
            this.page = 1;
            this.search(query);
        },
        async infiniteHandler($state) {
            axios
                .get('/services_all', {
                    params: {
                        filters: this.filterQueries,
                        page: this.page,
                    },
                })
                .then((res) => {
                    if (res.data.length == 0) {
                        $state.complete();
                    }
                    this.page++;
                    this.services.push(...res.data);
                    $state.loaded();
                })
                .catch((err) => {
                    this.busy = false;
                });
        },
        resetFilters() {
            this.filterQueries.category = '';
            this.filterQueries.city = null;
            this.filterQueries.title = null;
        },
    },
    computed: {
        categories() {
            return this.$store.state.serviceCategories;
        },
    },
    components: {
        ClientOnly,
        InfiniteLoading,
    },
};
</script>
