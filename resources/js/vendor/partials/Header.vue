<template>
  <div>
    <header id="header-container" class="fixed fullwidth dashboard">
      <!-- Header Desktop -->
      <div id="header" class="not-sticky header-desktop">
        <div class="container">
          <!-- Left Side Content -->
          <div class="left-side">
            <!-- Logo -->
            <div id="logo">
              <a href="/">
                <img src="images/logo_admin.jpg" alt />
              </a>
              <a href="/" class="dashboard-logo">
                <img src="images/logo_admin.jpg" alt />
              </a>
            </div>

            <!-- Main Navigation -->
            <nav id="navigation" class="style-1"></nav>
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

              <a class="button border with-icon">
                <router-link to="/add-listing">
                  Добави проект
                  <i class="sl sl-icon-plus"></i>
                </router-link>
              </a>
            </div>
            <!-- Header Widget / End -->
          </div>
          <!-- Right Side Content / End -->
        </div>
      </div>


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
      </div>
      
      <!-- Header / End -->
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
  .header-mobile {
    display: none;
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
      justify-content: unset;
    }

    .left-side {
      left: 25px;
      top: -13px;
      position: absolute;
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
  }
  @media screen and (max-width: 414px) {
    #logo-mobile {
      position: absolute;
      right: 0px;
    }
    .header-widget {
      left: 4px;
      padding-top: 11px;
      padding-bottom: 28px;
    }
    .logo-mobile img {
      max-width: 78.5%;
    }
  } */
</style>