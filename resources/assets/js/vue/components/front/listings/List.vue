<template>
    <div class="header-container container margin-top-25">
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
                            <h3 class="margin-top-0 margin-bottom-10">Търсене</h3>

                            <div class="row with-forms">
                                <!-- Cities -->
                                <div class="col-md-12 main-search-input-item">
                                    <input
                                        type="text"
                                        v-model="filterQueries.title"
                                        placeholder="Какво търсите?"
                                        @keyup="searchTimeOut"
                                    />
                                    <span
                                        class="clear_data"
                                        v-if="filterQueries.title"
                                        @click="clearQuery('title')"
                                        >x</span
                                    >
                                </div>
                            </div>

                            <!-- Row -->
                            <div class="row with-forms">
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
                                    </div>
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
                            <!-- Row / End -->
                            <div class="widget">
                                <h3 class="margin-bottom-10">Категории</h3>
                                <div class="category_body">
                                    <div
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
                        <h3 class="margin-top-20 tags_heading">
                            Тагове
                            <span
                                class="show_tags"
                                @click="showTags = !showTags"
                                :class="[showTags ? 'active' : '']"
                            >
                                <span v-if="!showTags" class="close_tags">+</span>
                                <span v-else>-</span>
                            </span>
                        </h3>
                        <span v-if="showTags && selectTag.length > 0" class="tag_info">
                            {{ selectTag.length }} избран
                            <span v-if="selectTag.length > 1">и</span> таг
                            <span v-if="selectTag.length > 1">а</span>
                        </span>
                        <!-- More Search Options -->

                        <div class="checkboxes one-in-row margin-bottom-15" v-if="showTags">
                            <div v-for="tag in tags" :key="tag.id">
                                <input
                                    :id="tag.tag"
                                    type="checkbox"
                                    :name="tag.tag"
                                    :value="tag.tag"
                                    @change="applyTags(tag.tag)"
                                    v-model="selectTag"
                                />
                                <label :for="tag.tag">
                                    {{ tag.tag | lowercase }}
                                    <!-- <span v-if="checkTag(tag.id)">x</span> -->
                                </label>
                            </div>
                        </div>
                        <!-- Twenty Tags -->
                        <h3 class="tags_heading">
                            Други тагове
                            <span
                                class="show_tags"
                                @click="showTwentyTags = !showTwentyTags"
                                :class="[showTags ? 'active' : '']"
                            >
                                <span v-if="!showTags">+</span>
                                <span v-else>-</span>
                            </span>
                        </h3>
                        <div class="checkboxes one-in-row margin-bottom-15" v-if="showTwentyTags">
                            <div v-for="tag in TwentyTags" :key="tag.id">
                                <input
                                    :id="tag.tag"
                                    type="checkbox"
                                    :name="tag.tag"
                                    v-model="selectTag"
                                    :value="tag.id"
                                    @change="applyTags(tag.tag)"
                                />
                                <label :for="tag.tag">{{ tag.tag | lowercase }}</label>
                            </div>
                        </div>

                        <!-- Twenty Tags -->
                        <h3
                            v-if="showThirtyHeading"
                            @click="showThirtyTags = !showThirtyTags"
                            class="tags_heading"
                        >
                            Още тагове
                        </h3>
                        <div class="checkboxes one-in-row margin-bottom-15" v-if="showThirtyTags">
                            <div v-for="tag in ThirtyTags" :key="tag.id">
                                <input
                                    :id="tag.tag"
                                    type="checkbox"
                                    :name="tag.tag"
                                    :value="tag.tag"
                                />
                                <label :for="tag.tag">{{ tag.tag | lowercase }}</label>
                            </div>
                        </div>
                        <!-- Checkboxes / End -->
                        <!-- <br />
            <button class="button fullwidth" @click="applyFilters">Намери</button>
                        <br />-->
                        <!-- <button
              class="button fullwidth reset_button"
              @click="resetFilters"
              v-if="this.category!=undefined || this.city != undefined || this.title != undefined || this.selectTag.length>=1"
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
                            v-for="project in projects"
                            :key="project.id"
                            :class="[className ? 'col-lg-12 col-md-12' : 'col-lg-6 col-md-12']"
                        >
                            <router-link
                                :to="'/project/details/' + project.id"
                                class="listing-item-container compact"
                            >
                                <div class="listing-item">
                                    <img v-lazy="project.project_galleries[0].url" alt />

                                    <div class="listing-badge now-open">Верифициран</div>

                                    <div class="listing-item-content">
                                        <div class="numerical-rating" data-rating="3.5"></div>
                                        <h3>
                                            {{ project.title }}
                                            <i class="verified-icon"></i>
                                        </h3>
                                        <span v-for="tag in project.tags" :key="tag.id"
                                            >#{{ tag.tag }}</span
                                        >
                                    </div>
                                    <span class="like-icon"></span>
                                </div>
                            </router-link>
                        </div>
                        <div v-if="projects.length == 0" class="no_results">
                            <h3>Съжаляваме, но вашето търсене няма резултат</h3>
                            <p>Моля,опитайте с други критерий!</p>
                            <div class="listing-item">
                                <img src="/images/listing-item-03.jpg" alt />

                                <div class="listing-badge now-open">Некатегоризиран</div>

                                <div class="listing-item-content">
                                    <div class="numerical-rating" data-rating="0.5"></div>
                                    <h3>
                                        Не е намерено нищо
                                        <i class="verified-icon"></i>
                                    </h3>
                                </div>
                                <span class="like-icon"></span>
                            </div>
                        </div>
                        <!-- Listing Item / End -->
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
import VueLocalStorage from 'vue-localstorage';
import axios from 'axios';
import Vue from 'vue';
import Router from 'vue-router';
import vuescroll from 'vue-scrollto/src/scrollTo'

Vue.use(vuescroll)

Vue.use(Router);
Vue.use(VueLocalStorage);

var count = 0;

export default {
    metaInfo() {
        return {
            meta: [],
        };
    },
    mixins: [project_services_functions],
    // props: ['filters', 'category', 'city', 'title'],
    data() {
        return {
            tags: [],
            // routhWatcher: true,
            showTags: false,
            TwentyTags: [],
            showTwentyTags: false,
            ThirtyTags: [],
            showThirtyHeading: false,
            showThirtyTags: false,
            selectTag: [],
            mainCategory: [],
            projects: [],
            projectsLoaded: [],
            limit: 5,
            busy: false,
            page: 1,
            className: false,
            show_sidebar: false,
            results: [],
            isOpen: false,
            filterQueries: {
                title: null,
                city: null,
                category: null,
                tags: [],
                mainCategory: [],
            },
        };
    },
    computed: {
        categories() {
            return this.$store.state.projectCategories;
        },
    },
    created() {
        this.setFilters();
        // console.log(this.$store.state)
    },
    mounted() {
        window.scrollTo(0, 0);
       this.getTags();
    },
    methods: {
        searchTimeOut() {
            if (this.timer) {
                clearTimeout(this.timer);
                this.timer = null;
            }
            this.timer = setTimeout(() => {
                this.pushToRouter('title', this.filterQueries.title);
            }, 800);
        },
        applyTags(val) {
            this.pushToRouter('tags', this.selectTag);
        },
        showTwenty() {
            this.showTwentyTags = true;
            // this.showThirtyHeading = true;
        },
        search(query) {
            // this.$refs.infiniteLoading.stop()
            axios
                .get('/projects', {
                    params: {
                        filters: query,
                        page: this.page,
                    },
                })
                .then((res) => {
                    this.projects = res.data;
                    this.page++;
                })
                .catch((err) => {
                    this.busy = false;
                });
        },
        applyFilters() {
            if (this.timer) {
                clearTimeout(this.timer);
                this.timer = null;
            }
            this.timer = setTimeout(() => {
                this.$router.push({
                    path: '/listings',
                    query: { title: this.title },
                });
                this.filters.title = '';
            }, 1200);
        },

        getTags() {
            axios
                .get('all_tags')
                .then((res) => {
                    if (res.data.length < 10) {
                        this.tags = res.data;
                    } else if (res.data.length > 10 && res.data.length < 20) {
                        let newTag = res.data;
                        const tag = newTag.sort(function (a, b) {
                            return b.project_tags_count - a.project_tags_count;
                        });
                        this.tags = tag.slice(0, 10);
                        this.TwentyTags = tag.slice(10, 20);
                    } else if (res.data.length > 20 && res.data.length < 30) {
                        let newTag = res.data;
                        const tag = newTag.sort(function (a, b) {
                            return b.project_tags_count - a.project_tags_count;
                        });
                        this.tags = tag.slice(0, 10);
                        this.TwentyTags = tag.slice(10, 20);
                        this.ThirtyTags = tag.slice(20, newTag.length);
                    } else {
                        let newTag = res.data;
                        const tag = newTag.sort(function (a, b) {
                            return b.project_tags_count - a.project_tags_count;
                        });
                        this.tags = tag.slice(0, 10);
                        this.TwentyTags = tag.slice(10, 20);
                        this.ThirtyTags = tag.slice(20, 30);
                    }
                })
                .catch((err) => console.log(err));
        },
        infiniteHandler($state) {
            this.filters = {};
            axios
                .get('/projects', {
                    params: {
                        filters: {
                            title: this.filterQueries.title,
                            mainCategory: this.filterQueries.mainCategory,
                            category: this.filterQueries.category,
                            city: this.filterQueries.city,
                            tags: this.selectTag,
                        },
                        page: this.page,
                    },
                })
                .then((res) => {
                    if (res.data.length == 0) {
                        $state.complete();
                    }
                    this.page++;
                    this.projects.push(...res.data);
                    $state.loaded();
                })
                .catch((err) => {
                    this.busy = false;
                });
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
        // Infinite loading
        resetFilters() {
            this.category = null;
            this.city = null;
            this.title = null;
            this.selectTag = [];
        },
    },
    filters: {
        lowercase: function (value) {
            return (value = value.toLowerCase());
        },
    },
    watch: {
        filterQueries: {
            handler: function (newValue) {},
            deep: true,
        },
        $route(to, from) {
            window.scrollTo(0, 0);
            let query = this.$route.query;
            if (Object.keys(query).length === 0) {
                this.selectedMain = '';
                this.page = 1;
                this.$router.push({ query: {} });
                Vue.nextTick(() => {
                    this.$router.push({ path: '/listings', query: {} });
                    this.infiniteHandler();
                });
            } else {
                if (to.fullPath == from.fullPath) return;
                this.page = 1;
                this.search(query);
            }
        },
    },
    components: {
        ClientOnly,
        InfiniteLoading,
    },
};
</script>
