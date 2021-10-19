<template>
    <div>
        <AddProjectOrService/>

        <!-- Titlebar -->
        <div id="titlebar" class="pc-part">
            <div class="row">
                <div class="col-md-12">
                    <h2>Здравей, {{ user ? user.name : '' }}</h2>
                </div>

                <div class="col-md-12">
                    <div class="pc-green-menu">
                        <router-link :to="'/projects'">
                            <div class="pc-menu-item">
                                <img src="/images/projects.svg" alt="projects">
                                <p>Проекти</p>
                            </div>
                        </router-link>

                        <div class="pc-menu-item" @click="toggleAnalitycsMenu">
                            <img src="/images/analysis.svg" alt="analysis">
                            <p>Анализи</p>
                            <i class="fa fa-angle-down" :class="{active: isActive}"></i>
                        </div>
                        
                        <router-link :to="'/service'">
                            <div class="pc-menu-item">
                                <img src="/images/services.svg" alt="services">
                                <p>Услуги</p>
                            </div>
                        </router-link>
                    </div>

                    

                </div>
            </div>

            <div class="analitycs-menu pc-menu" :class="{active: isActive}">
                <ul>
                    <li>
                        <router-link :to="'/projects_analitycs'">Анализи на проекти</router-link>
                    </li>
                    <li>
                        <router-link :to="'/services_analitycs'">Анализи на услуги</router-link>
                    </li>
                    <li>
                        <router-link :to="'/contacts_analitycs'">Анализи на контакти</router-link>
                    </li>
                </ul>
            </div>
        </div>



        <div id="titlebar" class="mobile-part" :class="{active: isActive}">
            <div class="row">
                <div class="col-md-12">
                    <h2>Здравей, {{ user ? user.name : '' }}</h2>
                </div>
            
                <div class="mobile-green-menu">
                    <router-link :to="'/projects'">
                        <div class="mobile-menu-item">
                            <img src="/images/projects.svg" alt="projects">
                            <p>Проекти</p>
                        </div>
                    </router-link>

                    <div class="mobile-menu-item" @click="toggleAnalitycsMenu">
                        <img src="/images/analysis.svg" alt="analysis">
                        <p>Анализи</p>
                    </div>
                    
                    <router-link :to="'/service'">
                        <div class="mobile-menu-item">
                            <img src="/images/services.svg" alt="services">
                            <p>Услуги</p>
                        </div>
                    </router-link>
                </div>

                <div class="analitycs-menu" :class="{active: isActive}">
                    <ul>
                        <li>
                            <router-link :to="'/projects_analitycs'">Анализи на проекти</router-link>
                        </li>
                        <li>
                            <router-link :to="'/services_analitycs'">Анализи на услуги</router-link>
                        </li>
                        <li>
                            <router-link :to="'/contacts_analitycs'">Анализи на контакти</router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mobile-admin-footer">
            <div class="admin-footer-line"></div>
            <div class="admin-footer">
                <p>© 2021 Maistorimo All Rights Reserved.</p>
            </div>
        </div>
    </div>
</template>

<script>
import Header from '../partials/Header';
import AddProjectOrService from '../partials/AddProjectOrService.vue';

export default {
    mounted() {
        return this.snackbarAlert('Проектър бе създаден успешно!');
    },
    data() {
        return {
            message: '',
            snackbar: false,
            user: null,
            projectsCount: null,
            servicesCount: null,
            isActive: false,
        };
    },
    mounted() {
        this.init();
    },
    methods: {
        init() {
            window.axios.get('/vendor/dashboard/get').then(({ data }) => {
                this.user = data.user;
                this.projectsCount = data.projectsCount;
                this.servicesCount = data.servicesCount;
                if (this.user.is_visited == 0) {
                    console.log('First');
                } else {
                    console.log('Old');
                }
            });
        },
        tutorial() {
            if (this.user.is_visited == 0) {
                console.log('First');
            } else {
                console.log('Old');
            }
        },
        snackbarAlert(message) {
            this.message = message;
            this.snackbar = true;
        },
        toggleAnalitycsMenu() {
            this.isActive = !this.isActive;
        },
    },
    components: {
        Header,
        AddProjectOrService
    },
};
</script>

<style scoped>
    @media screen and (min-width: 991px) {
        .mobile-green-menu {
            display: none;
        }

        /* .mobile-admin-footer {
            display: none;
        } */

        .analitycs-menu {
            display: none;
        }

        #titlebar.pc-part {
            padding-top: 65px;
        }

        #titlebar.mobile-part {
            display: none;
        }

        .row {
            margin-left: 26px;
            margin-right: 26px;
            display: flex;
            flex-direction: column;
            background: #FFFFFF;
            box-sizing: border-box;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.25);
            border-radius: 7px;
            width: 97%;
        }

        #titlebar.pc-part h2 {
            font-style: normal;
            font-weight: 500;
            font-size: 25px;
            line-height: 29px;
            color: #276955;
            text-align: center;
            margin-top: 33px;
            margin-bottom: 37px;
        }

        .pc-green-menu {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
        }

        .pc-menu-item {
            width: 320px;
            height: 85px;
            background-color: #276955;
            color: #ffffff;
            border-radius: 15px;
            box-sizing: border-box;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.25);
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }

        .pc-menu-item:hover {
            cursor: pointer;
        }

        .pc-menu-item i {
            zoom: 2;
            margin-left: 10px;
            transform: rotate(180deg);
        }

        .pc-menu-item i.active {
            zoom: 2;
            margin-left: 10px;
            transform: rotate(0deg);
        }

        .analitycs-menu.pc-menu {
            width: 300px;
            background-color: #FFFFFF;
            position: absolute;
            top: 89%;
            left: 41%;
            box-sizing: border-box;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.25);
        }

        .analitycs-menu.pc-menu ul {
            list-style: none;
            padding: 10px 10px;
            width: 100%;
            text-align: center;
        }

        .analitycs-menu.pc-menu ul li {
            font-size: 20px;
            padding: 10px;
        }

        .analitycs-menu.pc-menu ul li a {
            text-align: center;
        }

        .pc-menu-item:nth-child(2) {
            margin: 0px 56px 42px 56px;
        }

        .pc-menu-item p {
            font-size: 25px;
            margin: 0px;
            margin-left: 30px;
        }

        .analitycs-menu.active {
            display: flex;
        }

        .mobile-admin-footer {
            background-color: #F7F7F7;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top: 410px;
        }

        .admin-footer-line {
            display: flex;
            border-top: 1px solid #CACACA;
            height: 2px;
            width: 88%;
        }

        .admin-footer {
            margin: 0px 33px;
            padding: 38px 0px 30px 0px;
        }
    }

    @media screen and (max-width: 1600px) {
        .analitycs-menu.pc-menu {
            top: 89%;
            left: 39%;
        }
    }

    @media screen and (max-width: 1440px) {
        .row {
            width: 95.5%;
        }

        .analitycs-menu.pc-menu {
            top: 89%;
            left: 37%;
        }
    }

    @media screen and (max-width: 1366px) {
        .pc-menu-item {
            width: 250px;
        }

        .pc-menu-item:nth-child(2) {
            margin: 0px 30px 42px 30px;
        }

        .pc-menu-item p {
            font-size: 23px;
            margin-left: 15px;
        }

        .pc-menu-item img {
            width: 20%;
        }
    }

    @media screen and (max-width: 1200px) {
        .pc-menu-item {
            width: 210px;
        }

        .analitycs-menu.pc-menu {
            top: 89%;
            left: 34%;
        }
    }

    @media screen and (max-width: 990px) {

        .pc-green-menu {
            display: none;
        }

        #titlebar.pc-part {
            display: none;
        }

        a.button.border:nth-child(2) {
            margin-bottom: 20px;
        }

        #titlebar.mobile-part {
            border-top-left-radius: 25px;
            border-top-right-radius: 25px;
            padding: 30px 0px 250px 0px;
            margin-bottom: 0px;
            margin-top: 20px;
        }

        #titlebar.mobile-part .row {
            width: 100%;
            margin-left: 0px;
            margin-right: 0px;
        }

        .row:nth-child(2) {
            display: none;
        }

        .col-md-12 {
            text-align: center;
        }

        .col-md-12 h2 {
            color: #276955;
        }

        .mobile-green-menu {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }

        .mobile-menu-item {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 105px;
            min-height: 116px;
            background-color: #276955;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
            border-radius: 15px;
            margin: 6.5px;
            color: #fff;
            cursor: pointer;
        }

        .mobile-menu-item:nth-child(3) img { 
            zoom: 1.3;
        }

        .mobile-admin-footer {
            background-color: #F7F7F7;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .admin-footer-line {
            display: flex;
            border-top: 1px solid #CACACA;
            height: 2px;
            width: 88%;
        }

        .admin-footer {
            margin: 0px 33px;
            padding: 38px 0px 30px 0px;
        }

        .analitycs-menu {
            display: none;
        }

        .analitycs-menu.active {
            display: flex;
            
        }

        .analitycs-menu {
            padding: 0px auto;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .analitycs-menu ul {
            background-color: #fff;
            list-style: none;
            width: 255px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 18px 0px;
            box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 12%);
        }

        .analitycs-menu ul li:nth-child(2) {
            margin: 23px 0px 23px -15px;
        }

        #titlebar.active {
            padding-bottom: 77px;
        }
        
    }

    @media screen and (max-width: 414px) {
        #titlebar .col-md-12 h2 {
            font-size: 20px;
        }
    }
</style>
