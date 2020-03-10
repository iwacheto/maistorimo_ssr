<template>
    <div>
        <div
            class="main-search-container centered"
            v-bind:style="{ backgroundImage: 'url(images/main-search-background-01.webp)' }"
        >
            <FrontSearch></FrontSearch>
        </div>

        <!-- Fullwidth Section -->
        <section class="fullwidth padding-bottom-20" data-background-color="#f8f8f8">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="headline centered margin-top-35">
                            <strong class="headline-with-separator">Популярни проекти</strong>
                        </h3>
                    </div>
                </div>
            </div>

            <!-- Carousel / Start -->

            <!-- <div class="simple-fw-slick-carousel custom_slider_2 dots-nav"> -->
            <div class="custom_slider_2 dots-nav">
                <!-- Listing Item -->
                <div class="fw-carousel-item" v-for="project in projects" :key="project.id">
                    <!-- <a href="listings-single-page.html" class="listing-item-container compact"> -->
                    <router-link :to="'project/details/'+project.id" tag="a" class="carousel_link">
                        <div class="listing-item">
                            <!-- <img v-lazy="project.url" alt /> -->
                            <img :src="project.url" alt />

                            <div class="listing-badge now-open">Верифициран</div>

                            <div class="listing-item-content">
                                <div class="numerical-rating" :data-rating="project.count"></div>
                                <h3>
                                    {{ project.title }}
                                    <i class="verified-icon"></i>
                                </h3>
                            </div>
                            <span class="like-icon"></span>
                        </div>
                    </router-link>
                    <!-- </a> -->
                </div>
                <!-- Listing Item / End -->
            </div>
            <!-- Carousel / End -->
        </section>
        <!-- Fullwidth Section -->
        <section class="fullwidth margin-top-25 padding-bottom-40" data-background-color="#f8f8f8">
            <div>
                <div class="row front_heading">
                    <!-- Last 5 projects -->
                    <div class="col-md-12">
                        <div class="col-md-12 all">
                            <router-link class="see-all" :to="'/listings'">Виж всички проекти</router-link>
                        </div>
                    </div>

                    <div id="search-results" class="col-md-12">
                        <h3 class="headline centered margin-top-75">
                            <strong class="headline-with-separator">Популярни услуги</strong>
                        </h3>
                        <SearchResults></SearchResults>
                    </div>
                </div>
            </div>
        </section>

        <footer>
            <cookie-law theme="dark-lime" v-if="closeCookie">
                <div slot="message">
                    <p>
                        Използваме "бисквитки", за да предоставим по-добро разглеждане на сайта ни, да анализираме трафика и да персонализираме съдържанието.
                        Ако продължиш да използваш сайта, потвърждаваш, че приемаш използването на "бисквитки". Ако не си съгласен, научи повече.
                    </p>
                    <div class="cookie_buttons_content">
                        <button class="skew" @click="closeCookie=!closeCookie">
                            <span>Приемам</span>
                        </button>
                        <button class="skew" @click="generelTerms">
                            <span>Научи повече</span>
                        </button>
                    </div>
                </div>
            </cookie-law>
        </footer>
    </div>
</template>

<script>
import SearchResults from '../partials/SearchResults';
import FrontSearch from '../partials/Search';
import { EventBus } from '../event-bus';
import CookieLaw from 'vue-cookie-law';
import axios from 'axios';

export default {
    data() {
        return {
            categories: [],
            // jsonld,
            // closeCookie:true,
            projects: [],
        };
    },
    created() {
        this.getCategories();
        this.getProjects();
    },
    methods: {
        setSession() {
            axios
                .get('/set_session')
                .then(res => {})
                .catch(err => {
                    console.log(res);
                });
        },
        generelTerms() {
            this.$router.push({ path: '/general_terms' });
        },
        async getCategories() {
            try {
                const res = await axios.get('/categories/get');
                this.categories = res.data;
                this.$store.state.categories = this.categories;
            } catch (error) {
                console.log(error.response.data);
            }
        },
        getCookies() {
           
            let localCookies = document.cookie;
            let localCookies='Pesho';
        
            if (localCookies) {
                // this.closeCookie = false;
                 console.log(localCookies)
            }
        },
        setCategory(category) {
            if (category === 'all') {
                EventBus.$emit('filter-reset');
            } else {
                // document.getElementById('search-results').scrollIntoView();
                let filters = { category: category.id, title: false };
                EventBus.$emit('filter-applied', filters);
            }
        },
        getProjects() {
            axios
                .get('/last_projects')
                .then(responce => {
                    this.projects = responce.data;
                    this.$nextTick(function() {
                        $('.custom_slider_2')
                            .not('.slick-initialized')
                            .slick({
                                infinite: true,
                                slidesToShow: 5,
                                slidesToScroll: 1,
                                dots: true,
                                arrows: false,
                                autoplay: true,
                                autoplaySpeed: 2000,
                                responsive: [
                                    {
                                        breakpoint: 1610,
                                        settings: {
                                            slidesToShow: 4,
                                        },
                                    },
                                    {
                                        breakpoint: 1365,
                                        settings: {
                                            slidesToShow: 3,
                                        },
                                    },
                                    {
                                        breakpoint: 1024,
                                        settings: {
                                            slidesToShow: 2,
                                        },
                                    },
                                    {
                                        breakpoint: 767,
                                        settings: {
                                            slidesToShow: 1,
                                        },
                                    },
                                ],
                            });
                    });
                })
                .catch(err => console.log(error));
        },
    },
    watch: {
        projects() {},
    },
    components: {
        SearchResults,
        FrontSearch,
        CookieLaw,
    },
    mounted() {
        this.setSession();
        this.getCookies();
    },
};
</script>

