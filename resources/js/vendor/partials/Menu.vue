<template>
  <div>
    <a
      href="#"
      class="dashboard-responsive-nav-trigger test_trigger"
      @click="aciveMenu=!aciveMenu"
      :class="[aciveMenu ? 'active' : '']"
    >
      <i class="fa fa-reorder"></i> Навигация
    </a>
    <div class="dashboard-nav" :class="[aciveMenu ? 'active' : '']">
      <div class="dashboard-nav-inner">
        <!-- <ul>
          <li class="active">
            <router-link to="/">
              <i class="sl sl-icon-settings"></i> Табло
            </router-link>
          </li>
        </ul> -->

        <!-- <ul data-submenu-title="Съдържание">
          <li>
            <a @click="e => e.target.parentElement.classList.toggle('active')">
              <i class="sl sl-icon-layers"></i> Проекти
            </a>
            <ul>
              <li>
                <router-link to="/projects">Проекти</router-link>
              </li>
              <li>
                <router-link to="/add-listing">Създай проект</router-link>
              </li>
            </ul>
          </li>
        </ul> -->

        <!-- <ul>
          <li>
            <a @click="e => e.target.parentElement.classList.toggle('active')">
              <i class="sl sl-icon-layers"></i>Услуги
            </a>
            <ul>
              <li>
                <router-link to="/service">Услуги</router-link>
              </li>
              <li>
                <router-link to="/service/add-service">Създай услуга</router-link>
              </li>
            </ul>
          </li>
        </ul> -->

        <!-- <ul v-if="showBlog==true" data-submenu-title="Блог">
          <li>
            <a @click="e => e.target.parentElement.classList.toggle('active')">
              <i class="sl sl-icon-layers"></i> Блог
            </a>
            <ul>
              <li>
                <router-link to="/blog/add-article">Създаване на статия</router-link>
              </li>
              <li>
                <router-link to="/blog/articles">Всички статии</router-link>
              </li>
            </ul>
          </li>
        </ul> -->

        <!-- <ul data-submenu-title="Маркетинг">
          <li>
            <a @click="e => e.target.parentElement.classList.toggle('active')">
              <i class="sl sl-icon-layers"></i> Анализи
            </a>
            <ul>
              <li>
                <router-link to="/projects_analitycs">
                  <i class="sl sl-icon-user"></i> Проекти
                </router-link>
              </li>
            </ul>
            <ul>
              <li>
                <router-link to="/services_analitycs">
                  <i class="sl sl-icon-globe"></i> Услуги
                </router-link>
              </li>
            </ul>
            <ul>
              <li>
                <router-link to="/contacts_analitycs">
                  <i class="sl sl-icon-globe"></i> Контакти
                </router-link>
              </li>
            </ul>
          </li>
        </ul> -->

        <!-- <ul data-submenu-title="Акаунт">
          <li>
            <router-link to="/profile">
              <i class="sl sl-icon-user"></i> Моят Профил
            </router-link>
          </li>
          <li>
            <router-link to="/website">
              <i class="sl sl-icon-globe"></i> Настройки Уебсайт
            </router-link>
          </li>
          <li>
            <a @click="logout">
              <i class="sl sl-icon-power"></i> Изход
            </a>
          </li>
        </ul> -->
        <ul class="menu-part-1">
          <ul>
            <li>
              <router-link to="/profile">
                <img src="/images/menu-profile.svg" alt="profile"><span>Профил</span>
              </router-link>
            </li>
          </ul>

          <ul>
            <li>
              <a @click="e => e.target.parentElement.classList.toggle('active')">
                <img src="/images/menu-analysis.svg" alt="analysis"><span>Анализи</span>
              </a>
              <ul>
                <li>
                  <router-link to="/projects_analitycs">
                    Анализ на проекти
                  </router-link>
                </li>
              </ul>
              <ul>
                <li>
                  <router-link to="/services_analitycs">
                    Анализ на услуги
                  </router-link>
                </li>
              </ul>
              <ul>
                <li>
                  <router-link to="/contacts_analitycs">
                    Анализ на контакти
                  </router-link>
                </li>
              </ul>
            </li>
          </ul>

          <ul>
            <li>
              <router-link to="/website">
                <img src="/images/menu-settings.svg" alt="settings"><span>Настройки на сайта</span>
              </router-link>
            </li>
          </ul>
        </ul>

        <ul class="menu-part-2">
          <ul>
            <li>
              <router-link to="/service">
                <img src="/images/menu-services.svg" alt="services"><span>Услуги</span>
              </router-link>
            </li>
          </ul>
          <ul>
            <li>
              <router-link to="/projects">
                <img src="/images/menu-projects.svg" alt="projects"><span>Проекти</span>
              </router-link>
            </li>
          </ul>
        </ul>

        <ul class="menu-part-3">
          <ul>
            <li>
              <a @click="logout">
                <img src="/images/menu-exit.svg" alt="exit"><span>Изход</span>
              </a>
            </li>
          </ul>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isActive: false,
      showBlog: false,
      aciveMenu: false
    };
  },
  beforeMount() {
    this.getAuthenticatedUser();
  },
  methods: {
    toggleMenuItems(event) {
     
    },
    async logout() {
      try {
        const res = await axios.post("/logout", {});
        window.location.href = "/";
      } catch (error) {
        console.log(error);
      }
    },
    async getAuthenticatedUser() {
      try {
        const res = await axios.get("auth-user");
        if (res.data.id === 1 || res.data.id === 4) {
          return (this.showBlog = true);
        }
        return (this.showBlog = false);
      } catch (error) {
        console.log(error);
      }
    }
  }
};
</script>

<style scoped>
  .dashboard-nav {
    min-height: 92vh;
    border-bottom-right-radius: 45px;
    position: absolute;
  }

  .dashboard-nav ul ul li {
    min-height: 56px;
  }

  .dashboard-nav ul ul li span {
    font-size: 17px;
    line-height: 20px;
  }

  .dashboard-nav ul ul li a img {
    margin-right: 28px;
  }

  ul.menu-part-1 {
    padding-bottom: 20px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.5);
  }

  ul.menu-part-2 {
    padding-top: 20px;
    margin: 0px;
    padding-bottom: 20px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.5);
  }

  ul.menu-part-3 {
    padding-top: 20px;
  }

  @media screen and (max-width: 1024px) { 
    .dashboard-nav {
      min-height: 94vh;
    }
  }

  @media screen and (max-width: 990px) { 
    .dashboard-responsive-nav-trigger.test_trigger {
      display: none;
    }

    .dashboard-nav {
      min-height: unset;
    }
  }
</style>
