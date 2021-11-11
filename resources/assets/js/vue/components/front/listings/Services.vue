<template>
    <div class="container margin-top-30">
        <!-- Content
        ==================================================-->
        <div class="container">
            <button
                class="sidebar_menu"
                @click="showSidebar"
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
                                    <i class="fa fa-th-list"></i>
                                </a>
                                <a href="#" class="list" @click="className = true">
                                    <i class="fa fa-th"></i>
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
                            :class="[className ? 'col-lg-3 col-md-6' : 'col-lg-6 col-md-12']"
                        >
                            <router-link
                                :to="'/service/details/' + service.id"
                                class="listing-item-container compact"
                            >
                                <div class="listing-item" @click="scrollTop">
                                    <img :src="service.image_url" alt />

                                    <div class="listing-badge now-open">
                                        <img class="verificated-img" src="/images/very.svg" alt="verificated" >
                                    </div>

                                    <div class="listing-item-content">
                                        <h3>
                                            {{ service.name }}
                                            <!-- <i class="verified-icon"></i> -->
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
                                    <!-- <i class="verified-icon"></i> -->
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
            className: true,
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
        this.scrollTop(0,0);
    },
    watch: {
        filters: {
            handler: function (newValue) {},
            deep: true,
        },
        $route(to, from) {
            this.scrollTop(0,0);
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
        showSidebar() {
            this.show_sidebar = !this.show_sidebar;
            this.scrollTop(0,0);
        },
        scrollTop(x,y) {
            window.scrollTo(x, y);
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

<style scoped>
    .container {
        width: 100%;
    }

    div.fixed {
        width: 16%;
        background: linear-gradient(87.84deg, rgba(196, 196, 196, 0) -0.93%, rgba(233, 233, 233, 0.234457) 96.54%, #E4E3E3 134.75%);
    }

    .col-lg-9 {
        width: 84%;
    }

    .sidebar {
        margin-left: -3.5%;
        margin-bottom: 142px;
    }

    .widget {
        position: relative;
        margin-top: 28px;
    }

    .category_body {
        margin-left: 0px;
    }

    .category_sidebar div{
        margin-left: 0px;
        padding-left: 13px;
    }

    .category_sidebar .main_cats.active_category {
        background: #66B7A3;
        color: #fff;
        border: 1px solid #66B7A3;
        box-sizing: border-box;
        border-radius: 36px;
        min-height: 30px;
        max-width: 289px;
    }

    p.main_cats {
        padding-left: 13px;
        border: 1px solid #47B39C;
        box-sizing: border-box;
        border-radius: 36px;
        min-height: 37px;
        max-width: 289px;
        font-size: 14px;
    }

    .main_cats span {
        margin-right: 11px;
        margin-top: 2px;
        color: #DE5B4A;
    }

    .category_sidebar div {
        font-size: 12px;
        max-width: 289px;
        padding-left: 26px;
    }

    .category_sidebar div.active_category {
        color: #74AEA1;
    }

    .category_sidebar div.active_category span {
        margin-right: 11px;
        margin-top: 2px;
        color: #DE5B4A;
    }

    .col-lg-6 {
        width: 50%;
    }

    .col-lg-3 {
        width: 33%;
    }

    .col-lg-6.col-md-12 a.listing-item-container.compact div.listing-item div.listing-item-content {
        left: 120px;
    }

    .widget img {
        position: absolute;
        left: 15px;
        top: 8px;
    }

    .widget h3 {
        font-size: 17px;
        background-color: #276955;
        color: #fff;
        padding: 10px 0px;
        border-radius: 35px;
        text-transform: uppercase;
        font-weight: bold;
        max-width: 289px;
    }

    .widget .widget {
        margin-top: 50px;
        padding: 0px 10px;
    }

    .row.with-forms input {
        margin-bottom: 10px;
        max-width: 289px;
    }

    .main-search-input-item {
        border-right: unset;
    }

    .main-search-input-item input{
        border: 1px solid #74AEA1;
        box-sizing: border-box;
        border-radius: 34.5px;
        font-size: 14px;
        padding: 0px 22px;
        height: 36px !important;
    }

    input#autocomplete-nput {
        height: 36px;
    }

    .tags_heading {
        justify-content: flex-start;
        background: #276955;
        color: #fff;
        border: 1px solid #276955;
        box-sizing: border-box;
        border-radius: 36px;
        min-height: 40px;
        max-width: 289px;
        padding: 8px 18px;
        position: relative;
        font-size: 20px;
    }

    .tags_heading h3 {
        position: relative;
    }

    .tags_heading i {
        margin-right: 12px;
        transform: rotate(90deg);
    }

    .tags_heading span.show_tags {
        border: none;
        color: #C4C4C4;
        margin-left: 73px;
        position: absolute;
        right: 20px;
    }

    /* .margin-top-20.tags_heading span.show_tags {
        
    } */

    .checkboxes.one-in-row.margin-bottom-15 {
        margin-left: 25px;
    }

    .col-md-6.col-xs-6 {
        float: right;
        
    }

    .layout-switcher {
        display: flex;
        flex-direction: row-reverse;
        min-height: fit-content;
    }

    .layout-switcher a.grid {
        border: unset;
        color: #A7A7A7;
    }

    .layout-switcher a.grid:hover {
        border: unset;
        color: #276955;
        background-color: unset;
    }

    .layout-switcher a.list {
        border: unset;
        color: #A7A7A7;
        background-color: unset;
    }

    .layout-switcher a.list:hover {
        color: #276955;
    }
    a.listing-item-container.compact div.listing-item div.listing-badge.now-open {
            background-color: unset;
            width: unset;
            height: unset;
            transform: rotate(0deg);
            right: 0px;
            top: -2px;
    }

    .verified-icon {
        color: #276955;
    }

    .listing-item-container.compact {
        border-radius: 55px;
    }

    .listing-item-container.compact .listing-item {
        border-radius: 35px;
        position: relative;
    }

    .listing-item-content {
        min-height: 80px;
        /* min-width: 293px; */
        /* width: 325px; */
        width: 85%;
        background-color: #EFCA4E;
        color: #000;
        position: absolute;
        bottom: 0px;
        border-top-left-radius: 55px;
        border-top: 5px solid #fff;
        border-left: 5px solid #fff;
        left: 80px;
        display: flex;
        justify-content: center;
        align-items: center;
        padding-right: 0px;
    }

    @media screen and (max-width: 1680px) { 
        .listing-item-content {
            width: 82%;
            padding: 0px 20px;
        }

        .listing-item-content h3 {
            width: 90%;
            font-size: 18px;
        }
    }

    @media screen and (max-width: 1259px) {
        .col-lg-9 {
            margin-top: 25px;
        }

        .row.margin-bottom-25 {
            display: none;
        } 

        .listing-item-content {
            width: 80%;
        }

        .listing-item-content h3 {
            width: 97%;
        }

        .listing-item-content {
            left: 70px;
        }

        .widget img {
            left: 7px;
        }

        .tags_heading {
            font-size: 18px;
        }
    }

    @media screen and (max-width: 1190px) { 
        .sidebar h3 {
            font-size: 15px;
        }
    }

    @media screen and (max-width: 1118px) { 
        .sidebar h3 {
            font-size: 15px;
        }
    }

    @media screen and (max-width: 1100px) { 
        .sidebar h3.tags_heading {
            font-size: 19px;
        }
    }

    @media screen and (max-width: 1024px) { 
        .header-container.container.margin-top-60 {
            margin-top: 30px !important;
        }

        .sidebar h3 .show_tags {
            margin-left: 40px;
        }

        .margin-top-20.tags_heading span.show_tags {
            margin-left: 90px;
        }
    }

    @media screen and (max-width: 1000px) { 
        .col-lg-9  {
            width: 90%;
        }

        div.fixed {
            top: 90px;
            position: absolute;
        }

        .col-lg-9.col-md-9.col-sm-9.gallery_listing.gallery_listing_active {
            left: 215px;
            width: 75%;
        }

        .sidebar_menu.active_button {
            transform: translateX(-25px);
            z-index: 99;
        }
    }

    @media screen and (max-width: 990px) { 
        .col-lg-6 {
            width: 100%;
        }

        .col-lg-3 {
            width: 95%;
        }

        .col-lg-6.col-md-12 a.listing-item-container.compact div.listing-item div.listing-item-content {
            left: 170px;
        }

        .listing-item-content {
            left: 170px;
        }

        .widget .widget {
            margin-top: 0px;
        }
    }

    @media screen and (max-width: 940px) {
        .sidebar_menu.active_button {
            transform: translateX(-25px);
        }

        .col-lg-9.col-md-9.col-sm-9.gallery_listing.gallery_listing_active {
            width: 60%;
            left: 290px;
        }

        .col-lg-9.col-md-9.col-sm-9.gallery_listing.gallery_listing_active .row .listing-item-content {
           width: 76%;
        }

        /* .listing-item-content {
            width: 80%;
        } */
    }

    @media screen and (max-width: 819px) {
        .sidebar_menu.active_button {
            transform: translateX(-25px);
        }

        div.fixed {
            width: 38%;
        }

        .col-lg-9.col-md-9.col-sm-9.gallery_listing.gallery_listing_active {
            width: 58%;
        }
    }

    @media screen and (max-width: 768px) { 
        .sidebar_menu.active_button {
            transform: translateX(3px);
        }

        .col-lg-9  {
            width: 90%;
            left: 80px;
        }

        .margin-top-20.tags_heading span.show_tags {
            margin-left: 28px;
        }

        .widget {
            margin-top: 0px;
        }

        .widget .widget {
            margin-top: 0px;
        }

        .sidebar h3 {
            font-size: 18px;
        }

        .sidebar h3 img {
            width: 9%;
        }

        body p {
            font-size: 16px;
        }

        .margin-top-20.tags_heading {
            margin-top: 10px !important;
        }
    }

    @media screen and (max-width: 766px) {

        div.fixed.active_sidebar {
            width: 34% !important;
            top: 87px;
            z-index: 11;
        }

        .col-lg-9.col-md-9.col-sm-9.gallery_listing.gallery_listing_active {
            left: 166px !important;
        }

        .sidebar_menu.active_button {
            top: 88px;
        }

        div.fixed.active_sidebar .sidebar .widget .widget {
            margin-top: 0px;
            margin-left: 10px;
        }

        div.fixed.active_sidebar .sidebar .widget {
            margin-top: 58px;
        }

        .col-lg-9.col-md-9.col-sm-9.gallery_listing.gallery_listing_active {
            left: 180px;
            margin-top: 0px;
            padding-right: 0px;
        }

        div.fixed.active_sidebar .sidebar .widget {
            margin-top: 0px;
        }
    }

    @media screen and (max-width: 720px) { 
        .row.project_content {
            display: flex;
            flex-direction: column;
        }

        .col-lg-9.col-md-9.col-sm-9.gallery_listing.gallery_listing_active {
            left: unset !important;
            
        }

        .sidebar {
            margin-left: 9%;
        }

        .sidebar h3 {
            font-size: 16px;
        }

         p.main_cats {
            font-size: 15px;
        }

        .sidebar h3.tags_heading {
            font-size: 17px;
        }

        div.fixed.active_sidebar {
            position: static;
            width: 100% !important;
        }

        div.fixed.active_sidebar .sidebar {
            display: flex;
            flex-direction: column;
            flex-wrap: nowrap;
            align-content: center;
            justify-content: center;
            align-items: center;
        }

        .listing-item-content {
            justify-content: unset;
        }

        div.fixed.active_sidebar .sidebar .widget {
            width: 289px;
        }

        div.fixed.active_sidebar .sidebar .tags_heading {
            width: 289px;
        }

        .col-lg-9 {
            width: 88%;
        }

        .col-lg-9.col-md-9.col-sm-9.gallery_listing.gallery_listing_active {
            left: -10px;
            width: 75%;
        }

        .col-lg-9.col-md-9.col-sm-9.gallery_listing.gallery_listing_active .row .listing-item-content {
            width: 77%;
        }
    }

    @media screen and (max-width: 540px) {
        .col-lg-9.col-md-9.col-sm-9.gallery_listing.gallery_listing_active {
            left: -65px;
            width: 80%;
        }

        .col-lg-9 {
            left: 60px;
        }

        .col-lg-6.col-md-12 a.listing-item-container.compact div.listing-item div.listing-item-content {
            left: 110px;
        }
    }

    @media screen and (max-width: 530px) {
        .col-lg-9.col-md-9.col-sm-9.gallery_listing.gallery_listing_active {
            left: 0px;
        }

        .sidebar_menu {
            top: 85px;
        }

        p.main_cats {
            padding-top: 7px;
        }
    }

    @media screen and (max-width: 480px) {
        .listing-item-content {
            left: 90px;
        }
    }

    @media screen and (max-width: 414px) {
        .listing-item-content h3 {
            width: 80%;
        }
    }

    @media screen and (max-width: 375px) {
        .listing-item-content h3 {
            width: 85%;
            left: -15px;
            font-size: 18px;
        }

        .col-lg-9 {
            left: 55px;
        }
    }

    @media screen and (max-width: 360px) {
        .col-lg-9 {
            width: 90%;
        }

        .col-lg-9.col-md-9.col-sm-9 {
            left: 50px !important;
        }

        div.fixed.active_sidebar .sidebar .widget {
            margin-top: 25px;
        }
    }

    @media screen and (max-width: 320px) {
        .col-lg-9.col-md-9.col-sm-9.gallery_listing.gallery_listing_active {
            left: -37px;
            width: 90%;
        }

        .col-lg-9.col-md-9.col-sm-9.gallery_listing {
            left: 22px;
            width: 95%;
        }
    }
</style>