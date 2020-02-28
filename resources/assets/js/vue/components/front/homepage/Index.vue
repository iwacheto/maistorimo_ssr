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
        <!-- <script v-html="jsonld" , type="application/ld+json"></script> -->
        <script v-html="jsonld" type="application/ld+json"></script>
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
    name: 'Index',
    created() {
        this.getCategories();
        this.getCookies();
        this.getprojects();
    },
    data() {
        const jsonld = {
            '@context': 'https://schema.org',
            '@type': 'Organization',
            name: 'Maistorima',
            legalName: 'Webrika',
            url: 'http://www.maistorimo.com',
            logo: 'images/logo2.png',
            foundingDate: '2019',
            address: {
                '@type': 'PostalAddress',
                streetAddress: 'Ruse str 19',
                addressLocality: 'floor 3',
                addressRegion: 'Pleven',
                postalCode: '5800',
                addressCountry: 'Bulgaria',
            },
            contactPoint: {
                '@type': 'ContactPoint',
                contactType: 'customer support',
                telephone: '[+561-526-8457]',
                email: 'georgi@webrika.bg',
            },
        };
        return {
            categories: [],
            jsonld,
            closeCookie: true,
            projects: [],
        };
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
            if (localCookies) {
                this.closeCookie = false;
            }
        },
        setCategory(category) {
            if (category === 'all') {
                EventBus.$emit('filter-reset');
            } else {
                document.getElementById('search-results').scrollIntoView();

                let filters = { category: category.id, title: false };
                EventBus.$emit('filter-applied', filters);
            }
        },
        async getprojects() {
            try {
                const responce = await axios.get('last_projects');
                this.projects = responce.data;
                // console.log(this)
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
            } catch (error) {
                console.log(error);
            }
        },
    },
    watch: {
        projects() {},
    },
    components: { SearchResults, FrontSearch, CookieLaw },
    mounted() {
        this.setSession();
        document.title = 'Maistorimo';
        // SEO Schema
        // let schema = document.createElement("script");
        // schema.setAttribute("type", "application/ld+json");
        // let content =
        //   '{ "@context" : "https://schema.org"' +
        //   '{ "firstName":"John" , "lastName":"Doe" },' +
        //   '{ "firstName":"Anna" , "lastName":"Smith" },' +
        //   '{ "firstName":"Peter" , "lastName":"Jones" } ]}';
        // let toJson = JSON.stringify(content);
        // schema.innerHTML = toJson;
        // var SSD = document.getElementsByTagName("body")[0].appendChild(schema);
        // console.log(SSD);
    },
};
// OG URL
// var link = document.createElement("meta");
// link.setAttribute("property", "og:url");
// link.content = document.location;
// var url = document.getElementsByTagName("head")[0].appendChild(link);
// var title = document.createElement("meta");
// title.setAttribute("property", "og:title");
// title.content =
//   "Майсторимо.БГ е платформа предоставяща на своите потребители съдържание и възможност за пласиране на техните услуги";
// var desc = document.getElementsByTagName("head")[0].appendChild(title);

// var link = document.createElement("meta");
// link.setAttribute("property", "og:image");
// link.content = "images/logo.png";
// var head = document.getElementsByTagName("head")[0].appendChild(link);
</script>

<style scoped>
a.carousel_link {
    color: #fff;
}
.box-container {
    display: flex;
    justify-content: center;
}
div.Cookie__content div {
    display: flex;
}
div.Cookie__content button {
    background: #97d058;
    padding: 0.625em 3.125em;
    color: #fff;
    border-radius: 0;
    border: 0;
    font-size: 1em;
    margin-left: 25px;
    border-radius: 10px;
}
div.Cookie__content button:hover {
    background: #7ebf36;
}
button.Cookie__button {
    display: none !important;
}

button.skew {
    max-height: 65px;
}

@media screen AND (max-width: 1250px) {
    .Cookie__content p {
        font-size: 13px;
    }
}

@media screen AND (max-width: 1000px) {
    div.Cookie--dark-lime {
        padding: 10px;
    }
}

@media screen AND (max-width: 900px) {
    .cookie_buttons_content {
        display: flex;
        flex-direction: column;
    }
    .cookie_buttons_content span {
        min-width: 100px;
        display: inline-block;
    }
    button.skew {
        max-height: 45px;
        padding: 5px 10px !important;
    }
    button.skew:first-of-type {
        margin-bottom: 15px;
    }
}

@media screen AND (max-width: 800px) {
    .Cookie--dark-lime {
        max-height: 150px;
    }
    .Cookie__content p {
        /* overflow: hidden; */
        /* white-space: nowrap; */
        /* text-overflow: ellipsis; */
        font-size: 11px;
        line-height: 20px;
    }
}

@media screen AND (max-width: 450px) {
    .Cookie--dark-lime {
        max-height: 180px;
    }
}
</style>
