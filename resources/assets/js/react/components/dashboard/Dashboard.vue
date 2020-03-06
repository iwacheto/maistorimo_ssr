<template>
  <div>
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
  </div>
</template>

<script>
import axios from 'axios'

export default {
  mounted() {
    return this.snackbarAlert("Проектър бе създаден успешно!");
  },
  data() {
    return {
      message: "",
      snackbar: false,
      user: null,
      projectsCount: null,
      servicesCount: null
    };
  },
  mounted() {
    this.init();
  },
  methods: {
    init() {
      axios.get("/vendor/dashboard/get").then(({ data }) => {
        this.user = data.user;
        this.projectsCount = data.projectsCount;
        this.servicesCount = data.servicesCount;
     
      });
    },
   
    snackbarAlert(message) {
      this.message = message;
      this.snackbar = true;
    }
  },
  computed:{
      //  user(){
      //    return this.$store.state.user
      //  }
  }
};
</script>
