<template>
    <div>
        
        <!-- <Header /> --> <!-- TsB -->
        <!-- <div class="clearfix"></div> --> <!-- TsB -->
        <!-- Titlebar -->
        <div id="titlebar">
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
                <div class="mobile-menu-item">
                    <img src="/images/projects.svg" alt="projects">
                    <p>Проекти</p>
                </div>

                <div class="mobile-menu-item">
                    <img src="/images/analysis.svg" alt="analysis">
                    <p>Анализи</p>
                </div>
                    
                <div class="mobile-menu-item">
                    <img src="/images/services.svg" alt="services">
                    <p>Услуги</p>
                </div>
            </div>
        </div>

        <div class="mobile-admin-footer">
            <div class="admin-footer">
                <p>© 2019 Maistorimo All Rights Reserved.</p>
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

    @media screen and (max-width: 990px) {
        .row {
            margin-left: 0px;
            margin-right: 0px;
        }

        #titlebar {
            border-top-left-radius: 25px;
            border-top-right-radius: 25px;
            padding: 30px 0px 250px 0px;
            margin-bottom: 0px;
        }

        .col-md-12 {
            text-align: center;
        }

        .row:nth-child(2) {
            display: none;
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

        .admin-footer {
            margin: 0px 33px;
            padding: 38px 0px 30px 0px;
            border-top: 1px solid #CACACA;
        }

        
    }
</style>
