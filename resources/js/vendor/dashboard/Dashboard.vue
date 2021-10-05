<template>
    <div>
        <div class="adding-buttons">
          <a class="button border with-icon">
            <router-link to="/add-listing">
              Добави проект
              <i class="sl sl-icon-plus"></i>
            </router-link>
          </a>

          <a class="button border with-icon">
            <router-link to="/service/add-service">
              Добави услуга
              <i class="sl sl-icon-plus"></i>
            </router-link>
          </a>
        </div>
        <!-- <Header /> --> <!-- TsB -->
        <!-- <div class="clearfix"></div> --> <!-- TsB -->
        <!-- Titlebar -->
        <div id="titlebar" :class="{active: isActive}">
            <div class="row">
                <div class="col-md-12">
                    <h2>Здравей, {{ user ? user.name : '' }}</h2>
                    <!-- Breadcrumbs -->
                    <!-- <nav id="breadcrumbs">
            <ul>
              <li>
                <a href="#">Home</a>
              </li>
              <li>Dashboard</li>
            </ul>
                    </nav>-->
                </div>
            </div>

            <!-- Content -->
            <div class="row">
                <!-- Item -->
                <div class="col-lg-6 col-md-6">
                    <router-link :to="'/projects'">
                        <div class="dashboard-stat color-1">
                            <div class="dashboard-stat-content">
                                <h4>{{ projectsCount }}</h4>
                                <span>Активни проекти</span>
                            </div>
                            <div class="dashboard-stat-icon">
                                <i class="im im-icon-Map2"></i>
                            </div>
                        </div>
                    </router-link>
                </div>

                <!-- Item -->
                <div class="col-lg-6 col-md-6">
                    <router-link :to="'/service'">
                        <div class="dashboard-stat color-2">
                            <div class="dashboard-stat-content">
                                <h4>{{ servicesCount }}</h4>
                                <span>Твоите услуги</span>
                            </div>
                            <div class="dashboard-stat-icon">
                                <i class="im im-icon-Line-Chart"></i>
                            </div>
                        </div>
                    </router-link>
                </div>
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
    },
};
</script>

<style scoped>
    
    .mobile-green-menu {
        display: none;
    }

    .mobile-admin-footer {
        display: none;
    }

    .analitycs-menu {
        display: none;
    }

    @media screen and (max-width: 990px) {
        
        .adding-buttons {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        a.button.border {
            margin-top: 20px;
            font-size: 17px;
            border: 1px solid #276955;
        }

        a.button.border a {
            display: flex;
            align-content: center;
            justify-content: center;
            align-items: center;
        }

        a.button.border a i {
            margin-left: 20px;
            zoom: 1.5;
            padding: 0px;
        }

        a.button.border:nth-child(2) {
            margin-bottom: 20px;
        }

        #titlebar {
            border-top-left-radius: 25px;
            border-top-right-radius: 25px;
            padding: 30px 0px 250px 0px;
            margin-bottom: 0px;
        }

        .row {
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
