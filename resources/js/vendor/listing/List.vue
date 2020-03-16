<template>
  <!-- Content
  ==================================================-->
  <div>
    <!-- Titlebar -->
    <div id="titlebar">
      <div class="row">
        <div class="col-md-12">
          <h2>Моите проекти</h2>
          <!-- Breadcrumbs -->
          <nav id="breadcrumbs">
            <ul>
              <li>
                <a href="#">Начало</a>
              </li>
              <li>
                <a href="#">Информация</a>
              </li>
              <li>Моите Проект</li>
            </ul>
          </nav>
        </div>
      </div>
    </div>

    <div class="row">
      <!-- Listings -->
      <div class="col-lg-12 col-md-12">
        <div class="dashboard-list-box margin-top-0">
          <h4>Активни проект</h4>
          <ul>
            <li v-for="(p, index) in projects" :key="p.id">
              <div class="list-box-listing">
                <div class="list-box-listing-img">
                  <router-link :to="'/projects/edit/' + p.id">
                    <img :src="p.project_galleries[0] ? p.project_galleries[0].url : ''" alt />
                  </router-link>
                </div>
                <div class="list-box-listing-content">
                  <div class="inner">
                    <h3>
                      <router-link :to="'/projects/edit/' + p.id">{{ p.title }}</router-link>
                    </h3>
                    <div class="star-rating" data-rating="3.5"></div>
                  </div>
                </div>
              </div>
              <div class="buttons-to-right">
                <router-link class="button gray" :to="'/projects/edit/' + p.id">
                  <i class="sl sl-icon-note"></i>
                </router-link>
                <a @click="alertDeleteProject(p.id, index)" class="button gray">
                  <i class="sl sl-icon-close"></i>
                </a>
                <a target="_blank" :href="'/project/details/'+p.id" class="button gray">
									<i class="sl sl-icon-globe"></i>
								</a>
              </div>
            </li>
          </ul>
        </div>
      </div>

      <!-- Copyrights -->
      <div class="col-md-12">
        <div class="copyrights">© 2019 Maistorimo All Rights Reserved.</div>
      </div>
    </div>
    <vue-toastr ref="mytoast"></vue-toastr>
  </div>

  <!-- Content / End -->
</template>

<script>
import "sweetalert2/src/sweetalert2.scss";

export default {
  data() {
    return {
      projects: []
    };
  },
  mounted() {
    this.$refs.mytoast.defaultPosition = "toast-top-center";
    this.$refs.mytoast.defaultStyle = { top: "80px" };
    this.getProjects();
  },
  methods: {
    async deleteProject(id, index) {
      try {
        const res = await axios.delete("/vendor/projects/" + id + "/delete");
        this.projects.splice(index, 1);
        this.$refs.mytoast.s("Проектът бе изтрит успешно!");
      } catch (error) {
        console.log(error.response.data);
      }
    },

    async alertDeleteProject(id, index) {
      const result = await this.$swal({
        title: "Наистина ли искате да изтриете този проект?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Yes, Delete it!"
      });
      console.log(result.value);
      if (result.value) {
        // <-- if confirmed
        this.deleteProject(id, index);
      }
    },
    getProjects(event) {
      window.axios.get("/vendor/projects/get").then(({ data }) => {
        this.projects = data;
        console.log(this.projects);
      });
    }
  }
};
</script>
