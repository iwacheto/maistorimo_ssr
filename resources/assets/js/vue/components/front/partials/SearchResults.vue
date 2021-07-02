<template>
  <div class="row">
    <!-- Carousel / Start -->
    <div class="custom_slider_1 dots-nav">
      <!-- Listing Item -->
      <div class="fw-carousel-item" v-for="service in services" :key="service.id">
        <router-link :to="'service/details/'+service.id" tag="a" class="carousel_link">
          <!-- <a href="listings-single-page.html" class="listing-item-container compact"> -->
          <div class="listing-item">
            <img :src="service.image_url" alt />
            <div class="listing-badge now-open">Верифицирана</div>
            <div class="listing-item-content">
              <h3>
                {{ service.name }}
                <i class="verified-icon"></i>
              </h3>
            </div>
          </div>
        </router-link>
        <!-- </a> -->
      </div>
      <!-- Listing Item / End -->
    </div>
    <!-- Carousel / End -->
    <div class="col-md-12 all">
      <router-link class="see-all" :to="'/services'">Виж всички услуги</router-link>
    </div>
    <!-- Listing Item / End -->
  </div>
</template>

<script>
import { EventBus } from "../event-bus";
import axios from "axios";

export default {
  name: "SearchResults",
  data() {
    return {
      services: []
    };
  },
  mounted() {
    EventBus.$on("filter-applied", this.search);
    this.getLastService();
    EventBus.$on("filter-reset", this.getProjects);
  },
  methods: {
    imageWidth(val) {
      let imgSize = val.replace("upload/", "upload/w_373,h_265,c_scale/");
      return imgSize;
    },
    async getProjects() {
      try {
        const res = await axios.get("/projects");
        this.projects = res.data;
      } catch (error) {
        console.log(error.response.data);
      }
    },
    async getLastService() {
      try {
        const res = await axios.get("/last-services");
        this.services = res.data;
        this.$nextTick(function() {
          $(".custom_slider_1").slick({
            infinite: true,
            slidesToShow: 5,
            slidesToScroll: 1,
            dots: true,
            arrows: false,
            autoplay: true,
            autoplaySpeed: 1500,
            responsive: [
              {
                breakpoint: 1610,
                settings: {
                  slidesToShow: 4
                }
              },
              {
                breakpoint: 1365,
                settings: {
                  slidesToShow: 3
                }
              },
              {
                breakpoint: 1024,
                settings: {
                  slidesToShow: 2
                }
              },
              {
                breakpoint: 767,
                settings: {
                  slidesToShow: 1
                }
              }
            ]
          });
        });
      } catch (error) {
        console.log(error.response.data);
      }
    },
    async search({ title, category, city }) {
      try {
        const res = await axios.get("projects", {
          params: {
            filters: {
              title: title,
              category: category,
              city: city
            }
          }
        });
        this.projects = res.data;
        console.log(res.data);
      } catch (error) {
        console.log(error.response.data);
      }
    }
  }
};

</script>
