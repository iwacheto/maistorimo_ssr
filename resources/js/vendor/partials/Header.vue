<template>
  <div>
    <header id="header-container" class="fixed fullwidth dashboard">
      <!-- Header -->
      <div id="header" class="not-sticky">
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

            <!-- Mobile Navigation -->
            <!-- <div class="mmenu-trigger">
              <button class="hamburger hamburger--collapse" type="button">
                <span class="hamburger-box">
                  <span class="hamburger-inner"></span>
                </span>
              </button>
            </div> -->

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
      <!-- Header / End -->
    </header>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: laravel.user,
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
    }
  },
  mounted() {
    console.log(this.user);
  }
};
</script>
