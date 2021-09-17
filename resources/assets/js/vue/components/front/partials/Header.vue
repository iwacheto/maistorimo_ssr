<template>
    <div>
        <header
            id="header-container"
            class="header-container"
            v-bind:style="{ backgroundImage: 'url(none)' }"
        >
            <!-- Header -->
            <div id="header" class="cloned sticky">
                <div class="container_nav">
                    <!-- Left Side Content -->
                    <div class="left-side">
                        <!-- Logo -->
                        <div id="logo">
                            <router-link to="/">
                                <img src="/images/logo2.png" data-sticky-logo="/images/logo.png" alt />
                            </router-link>
                        </div>

                        <!-- Mobile Navigation -->
                        <div class="mmenu-trigger">
                            <button class="hamburger hamburger--collapse" type="button">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>

                        <!-- Main Navigation -->
                        <nav id="navigation" class="style-1 test_menu">
                            <ul id="responsive">
                                <li>
                                    <router-link to="/">Начало</router-link>
                                    <!-- <a href="/">Начало</a> -->
                                </li>

                                <li>
                                    <router-link to="/listings">Проекти</router-link>
                                    <div class="mega-menu mobile-styles three-columns">
                                        <div
                                            class="mega-menu-section"
                                            v-for="category in projectCategories"
                                            :key="category.id"
                                        >
                                            <ul>
                                                <li class="mega-menu-headline" :class="category.id">
                                                    <!-- <a :href="'/#/listings?mainCategory='+category.title">{{ category.title }}</a> -->
                                                    <i :class="classObject(category.id)"></i>
                                                    <a
                                                        @click.prevent="applyMainCategory(category.children,'/listings')"
                                                    >{{ category.title }}</a>
                                                </li>
                                                <li v-for="cat in category.children" :key="cat.id">
                                                    <router-link
                                                        :to="'/listings?category='+cat.title"
                                                    >{{ cat.title }}</router-link>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <router-link to="/services">Услуги</router-link>
                                    <div class="mega-menu mobile-styles three-columns">
                                        <div
                                            class="mega-menu-section"
                                            v-for="category in serviceCategories"
                                            :key="category.id"
                                        >
                                            <ul>
                                                <li class="mega-menu-headline" :class="category.id">
                                                    <!-- <a :href="'/#/services?mainCategory='+category.title">{{ category.title }}</a> -->
                                                    <i :class="classObject(category.id)"></i>
                                                    <a
                                                        @click.prevent="applyMainCategory(category.children,'/services')"
                                                    >{{ category.title }}</a>
                                                </li>
                                                <li v-for="cat in category.children" :key="cat.id">
                                                    <router-link
                                                        :to="'/services?category='+cat.title"
                                                    >{{ cat.title }}</router-link>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                        <!-- <div class="clearfix"></div> -->

                        <!-- Main Navigation / End -->
                    </div>
                    <!-- Left Side Content / End -->

                    <!-- Right Side Content / End -->
                    <div class="right-side">
                        <div class="header-widget">
                            <a v-if="!logged" @click="loginPopup" class="button border with-icon">
                                <i class="sl sl-icon-login"></i> Вход/Регистрация
                            </a>
                            <a v-else href="/vendor" class="button border with-icon">
                                <i class="sl sl-icon-login"></i> Администрация
                            </a>
                            <!-- <a href="dashboard-add-listing.html" class="button border with-icon">
								Добави проект
								<i class="sl sl-icon-plus"></i>
                            </a>-->
                        </div>
                    </div>
                    <!-- Right Side Content / End -->
                    <!-- Sign In Popup -->
                    <login-popup :popupShow="popupShow" v-on:closePopup="popupHandler"></login-popup>
                    <!-- <login-popup :popupShow="popupShow" v-on:keyup.enter="popupHandler"></login-popup> -->
                    <!-- Sign In Popup / End -->
                </div>
            </div>
        </header>

        <div class="clearfix"></div>
    </div>
</template>

<script>
import Login from './Login.vue';
import axios from 'axios';

export default {
    data() {
        return {
            logged: false,
            popupShow: false,
            isActive: false,
            currentRoute: '',
            categories: [],
            projectCategories: [],
            serviceCategories: [],
        };
    },
    watch: {
        $route(to, from) {
            // console.log(to);
            // console.log(from);
            this.currentRoute = to.name;
            // react to route changes...
        },
    },
    async created() {
        const checkAuth = await axios.post('/is-auth');
        if (checkAuth.data) {
            this.logged = true;
        }
        this.currentRoute = this.$route.name;
        // console.log(this.currentRoute);
        this.getCategories();
    },
    methods: {
        applyMainCategory(val, menuPath) {
            this.$router.push({
                path: menuPath,
                query: {},
            });
            let cats = [];
            val.forEach(elem => {
                cats.push(elem.title);
            });
            this.$router.push({
                path: menuPath,
                query: { mainCategory: cats },
            });
        },
        toggleUserMenu() {
            this.isActive = !this.isActive;
        },
        async getCategories() {
            try {
                const responce = await axios.get('/categories/get');
                let services = responce.data.mainSerCategory;
                services.forEach(main => {
                    let children = responce.data.services.filter(
                        service => service.parent_id == main.id
                    );
                    main.children = children;
                });
                this.serviceCategories = services;

                let projects = responce.data.mainProjCategory;
                projects.forEach(main => {
                    let children = responce.data.projects.filter(
                        service => service.parent_id == main.id
                    );
                    main.children = children;
                });
                this.projectCategories = projects;
                this.$store.state.projectCategories = projects;
                this.$store.state.serviceCategories = services;
                // this.categories = responce.data;
            } catch (err) {
                console.log(err);
            }
        },
        loginPopup() {
            this.popupShow = true;
        },
        popupHandler() {
            this.popupShow = false;
        },
        logout() {
            window.axios.post('/logout', {}).then(({ data }) => {
                window.location = data;
            });
        },
        classObject(val) {
            let added;
            if (val == 1) {
                added = 'im-icon-Farmer';
            } else if (val == 2) {
                added = 'im-icon-Home-2';
            } else if (val == 3) {
                added = 'im-icon-Drill';
            } else {
                added = 'im-icon-Orientation-2';
            }
            let classes = {
                im: true,
            };
            classes[added] = true;
            return classes;
        },
    },
    computed: {},
    components: {
        'login-popup': Login,
    },
};
</script>

<style scoped>

    #header.cloned {
        background-color:#324E5B;
        padding: 0px;
        mix-blend-mode: normal;
        box-shadow: 0px 3px 15px 3px rgba(0, 0, 0, 0.25);
    }

    .left-side {
        margin-left: 9%;
    }

    .right-side {
        margin-left: 0px;
        margin-top: 29px;
    }

    #header.cloned #logo img {
        max-width: unset;
        max-height: unset;
        width: 100%;
        margin: 0px;
    }

    #logo {
        margin: 11px 197px 21px 0px;
    }

    #navigation.style-1 {
        margin-top: 0px;
    }

    #navigation.style-1 ul li {
        margin: 40px 15px 15px 0px;
        border: 1px solid #C4C4C4;
        border-radius: 17.5px;
    }

    #navigation ul li a {
        color: #fff;
        font-size: 20px;
    }

    .header-widget {
        top: 0px;
    }

    .button.border.with-icon {
        width: 270px;
        height: 58px;
        margin-right: 101px;
        font-size: 17px;
        color: #EFCA4E;
        padding-top: 13px;
    }

    @media screen and (max-width: 1365px) { 
        #logo {
            margin: 11px 160px 21px 0px;
        }
    }

    @media screen and (max-width: 1300px) { 
        #logo {
            margin: 11px 120px 21px 0px;
        }
    }

    @media screen and (max-width: 1240px) { 
        #logo {
            margin: 11px 90px 21px 0px;
        }
    }

    @media screen and (max-width: 1170px) {
        #logo {
            margin: 11px 70px 21px 0px;
        }

        #navigation ul li a {
            font-size: 18px;
        }

        .button.border.with-icon {
            width: 230px;
        }
    }

    @media screen and (max-width: 1100px) { 
        .button.border.with-icon {
            margin-right: 51px;
        }
    }

    @media screen and (max-width: 1024px) { 
        .right-side {
            margin-top: 0px;
        }

        .header-widget {
            border-top: 0px;
            padding: 10px 0px;
        }
    }

    @media screen and (max-width: 560px) { 
        .right-side {
            margin-top: 0px;
        }

        .right-side .header-widget a.button.border.with-icon {
            width: 170px;
            font-size: 12px;
            height: 53px;
        }

        .header-widget {
            border-top: 0px;
            padding: 10px 0px;
        }
    }

    @media screen and (max-width: 480px) {
        #header.cloned #logo img {
            min-width: 100px;
        }

        .right-side .header-widget a.button.border.with-icon {
            width: 160px;
            font-size: 11px;
            height: 50px;
        }

        .left-side {
            margin-left: 5%;
            width: 150px;
        }
    }

    @media screen and (max-width: 414px) {
        #header.cloned #logo img {
            min-width: 100px;
        }

        .right-side .header-widget a.button.border.with-icon {
            width: 150px;
            font-size: 10px;
            height: 50px;
        }
    }

    @media screen and (max-width: 380px) {
        #header.cloned #logo img {
            min-width: 90px;
        }

        .left-side {
            margin-left: 5%;
            width: 110px;
        }

        .right-side .header-widget a.button.border.with-icon {
            width: 150px;
            font-size: 10px;
            height: 50px;
        }
    }

    @media screen and (max-width: 350px) {
        .right-side .header-widget a.button.border.with-icon {
            width: 140px;
            font-size: 9px;
            height: 50px;
        }

        .left-side {
            
            width: 100px;
        }
    }
</style>
