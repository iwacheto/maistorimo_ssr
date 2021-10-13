<template>
  <div>
    <header id="header-container" class="fullwidth dashboard"> <!-- fixed -->
      
      <!-- Header Desktop -->
      <div id="header" class="not-sticky header-desktop">
        <div class="container">
          <!-- Left Side Content -->
          <div class="left-side">
            <!-- Logo -->
            <div id="logo">
              <a href="/">
                <img src="images/logo-menu.svg" alt />
              </a>
              <a href="/" class="dashboard-logo">
                <img src="images/logo-menu.svg" alt />
              </a>
            </div>

            <!-- Main Navigation -->
            <nav id="navigation" class="style-1">Начало</nav>
            <div class="clearfix"></div>
            <!-- Main Navigation / End -->
          </div>
          <!-- Left Side Content / End -->

          <!-- Right Side Content / End -->
          <div class="right-side right_dashboard">
            <!-- Header Widget -->
            <div class="header-widget">
              <!-- User Menu -->
              <div class="user-menu" @click="toggleUserMenu" :class="{active: isActive}">
                <div class="user-name">
                  <span>
                    <img src="images/dashboard-avatar.jpg" alt />
                  </span>
                  {{ user.name }}
                </div>
                <ul>
                  <li>
                    <router-link :to="'/profile'">
                      <i class="sl sl-icon-settings"></i> Профил
                    </router-link>
                  </li>
                  <li>
                    <router-link :to="'/website'">
                      <i class="sl sl-icon-settings"></i> Уебсайт
                    </router-link>
                  </li>
                  <li>
                    <a target="_blank" :href="'//' + user.name + '.maistorimo.bg'">
                      <i class="sl sl-icon-globe"></i> Линк
                    </a>
                  </li>
                  <li>
                    <a @click="logout">
                      <i class="sl sl-icon-power"></i> Излизане
                    </a>
                  </li>
                </ul>
              </div>

              <!-- <a class="button border with-icon">
                <router-link to="/add-listing">
                  Добави проект
                  <i class="sl sl-icon-plus"></i>
                </router-link>
              </a> -->
            </div>
            <!-- Header Widget / End -->
          </div>
          <!-- Right Side Content / End -->
        </div>
      </div>
      <!-- End Header Desktop -->






      <!-- Header Mobile -->
      <div id="header" class="not-sticky header-mobile">
        <div class="container">

          <!-- Left Side Content / End -->
          <div class="left-side">
            <!-- Header Widget -->
            <div class="header-widget">
              <!-- User Menu -->
              <div class="user-menu" @click="toggleUserMenu" :class="{active: isActive}">
                <div class="user-name">
                  <span>
                    <img src="images/dashboard-avatar.jpg" alt />
                  </span>
                  {{ user.name }}
                </div>
                <ul>
                  <li>
                    <router-link :to="'/profile'">
                      <img src="images/profile.svg" alt="profile"> Профил
                    </router-link>
                  </li>
                  <li>
                    <router-link :to="'/website'">
                      <img src="images/settings.svg" alt="settings"> Настройки на сайта
                    </router-link>
                  </li>
                  <!-- <li>
                    <a target="_blank" :href="'//' + user.name + '.maistorimo.bg'">
                      <i class="sl sl-icon-globe"></i> Линк
                    </a>
                  </li> -->
                  <li>
                    <a @click="logout">
                      <img src="images/log-out.svg" alt="log out"> Излизане
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <!-- Header Widget / End -->
          </div>
          <!-- Left Side Content / End -->

          <!-- Right Side Content -->
          <div class="right-side ">
            <div id="logo">
              <a href="/">
                <img src="images/logo.png" alt />
              </a>
            </div>
          </div>
          <!-- Right Side Content / End -->

        </div>
      </div>
      <!-- End Header Mobile -->

      
      <!-- Headers / End -->
    </header>
  </div>
</template>

<script>
export default {
  data() {
    return {
      // user: laravel.user,
      user:laravel.user,
      isActive: false
    };
  },
  methods: {
    toggleUserMenu() {
      this.isActive = !this.isActive;
    },
    async logout() {
      try {
        const res = await axios.post("/logout", {});
        window.location.href = "/";
      } catch (error) {
        console.log(error);
      }
    },
    async getUser() {
            try {
                const res = await axios.get('/get_user');
                this.user=res.data;
                this.$store.state.user=res.data;
            } catch (error) {
                console.log(error);
            }
        },
  },
   
  mounted() {
    // this.getUser();
  }
};
</script>

<style scoped>

  #header {
    box-shadow: unset;
  }

  .left-side #logo {
    border-top-right-radius: 45px;
  }

  @media screen and (min-width: 991px) { 

    .dashboard #logo {
      position: fixed;
      height: 10%;
    }
    .not-sticky.header-desktop {
      background-color: #f8f8f8;
    }

    .header-mobile {
      display: none;
    }

    .user-menu .user-name {
      display: flex;
      flex-direction: row-reverse;
    }

    .user-name span {
      left: 106px;
    }

    div.user-name::after {
      margin-right: 6px;
    }

    .user-menu ul {
      right: -67px;
    }

    .right-side {
      margin-left: 0px;
      display: block;
      margin-right: 20px;
    }

    .style-1 {
      font-style: normal;
      font-weight: bold;
      font-size: 30px;
      line-height: 35px;
      color: #276955;
    }
  }

  @media screen and (max-width: 1365px) {
    .dashboard #logo {
      display: block;
      background-color: #333;
      /* position: absolute;
      height: 100%; */
      left: 0;
      top: 0;
      margin: 0;
      min-width: 260px;
      max-width: 260px;
    }

    header.fullwidth.dashboard .container {
      padding-left: 285px;
    }

    .dashboard #logo a img {
      top: 50%;
      position: relative;
      transform: translate3d(0, -50%, 0);
      max-height: 50px;
    }

    .dashboard #logo a {
      margin-left: 33px;
    }

    #logo img {
      width: auto;
      max-height: 50px;
      transform: unset;
    }

    .left-side {
      
      width: 65%;
      display: inline-block;
    }
  }
  
  @media screen and (max-width: 1024px) {
    #header .container {
      display: block;
    }

    .user-name span {
      left: 100%;
    }

    body #dashboard #logo, body #logo {
      margin-top: 0px !important;
    }

    #navigation.style-1 {
      margin-top: 22px ;
    }

  }

  @media screen and (max-width: 990px) { 
    
    .header-desktop {
      display: none;
    }

    .header-mobile {
      display: flex;
      flex-direction: column;
    }

    #header .container {
      display: flex;
      justify-content: space-between;
      padding: 0px;
      background-color: #F6F6F6;
      z-index: 1000;
      flex-direction: row;
    }

    .left-side {
      padding-bottom: 15px;
    }

    .right-side {
      margin-left: 0px;
      align-items: left;
    }

    .dashboard #logo {
      position: unset;
      background-color: #F6F6F6;
      border-top-right-radius: 35px;
    }

    .dashboard #logo a img {
      position: absolute;
      right: 15px;
    }

    .user-menu ul {
        width: 376px;
    }

    .user-menu ul img {
        margin-right: 25px;
    }

    .user-name span {
      left: -21px;
    }
  }
  /* @media screen and (max-width: 990px) { 
    #header {
      text-align: center;
    }
    #logo {
      display: none;
    }
    .right-side.right_dashboard {
      display: flex;
      width: 100%;
    }
    header.fullwidth.dashboard .container {
        padding: 0;
    }
    .right-side.right_dashboard {
      background-color: #F6F6F6;
    }
    a.button.border {
      margin-top: 21px;
    }
    .adding-buttons {
      display: flex;
      flex-direction: column;
    }
  } */

  @media screen and (max-width: 570px) {
    .user-menu ul {
        width: 270px;
    }
  }

  @media screen and (max-width: 414px) {
    #header .container {
      display: flex;
      flex-direction: row;
    }

    .user-menu.active {
      width: 323%;
    }
    .user-menu ul {
        left: -65px;
        width: 90%;
    }
  }

  @media screen and (max-width: 380px) {
    .user-menu ul {
        width: 87%;
    }
  }

  @media screen and (max-width: 360px) {
    .left-side {
      width: 59%;
    }

    .user-menu.active {
      width: 323%;
    }
    .user-menu ul {
        left: -28px;
        width: 48.5%;
    }
  }
</style>