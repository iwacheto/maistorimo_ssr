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
        <ul>
          <li class="active">
            <router-link to="/">
              <i class="sl sl-icon-settings"></i> Табло
            </router-link>
          </li>
        </ul>

        <ul data-submenu-title="Съдържание">
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
        </ul>
        <ul>
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
        </ul>

        <ul v-if="showBlog==true" data-submenu-title="Блог">
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
        </ul>

        <ul data-submenu-title="Маркетинг">
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
        </ul>

        <ul data-submenu-title="Акаунт">
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
  @media screen and (max-width: 990px) { 
    .dashboard-responsive-nav-trigger.test_trigger {
      display: none;
    }
  }
</style>
