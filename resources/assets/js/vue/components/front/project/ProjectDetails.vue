<template>
  <div>
    <div v-if="images" class="listing-slider mfp-gallery-container">
      <gallery :images="images" :index="index" @close="index = null"></gallery>
      <div
        class="image"
        v-for="(image, imageIndex) in images"
        :key="imageIndex"
        @click="handleClick(imageIndex)"
        :style="{ backgroundImage: 'url(' + image + ')', width: '400px', height: '400px' }"
      ></div>
    </div>

    <div>
      <!-- Content
      ==================================================-->
      <div class="container">
        <div class="row sticky-wrapper">
          <div class="col-lg-8 col-md-8 padding-right-30">
            <!-- Titlebar -->
            <div id="titlebar" class="listing-titlebar">
              <div class="listing-titlebar-title">
                <h2>
                  {{ projectDetails.title}}
                  <span v-if="services.length>0">
                    <router-link
                      tag="span"
                      class="listing-tag"
                      :to="'/service/details/'+ service.id"
                      v-for="service in services"
                      :key="service.id"
                    >{{ service.name }}</router-link>
                  </span>
                </h2>
                <span>
                  <a href="#listing-location" class="listing-address">
                    <i class="fa fa-map-marker"></i>
                    {{ city.city }}
                  </a>
                </span>
              </div>
            </div>

            <!-- Listing Nav -->
            <div id="listing-nav" class="listing-nav-container">
              <ul class="listing-nav">
                <li>
                  <a href="#" v-scroll-to="'#listing-overview'" class="active">Детайли</a>
                </li>

                <li>
                  <a href="#" v-scroll-to="'#listing-location'">Локация</a>
                </li>
              </ul>
            </div>

            <!-- Overview -->
            <div id="listing-overview" class="listing-section">
              <!-- Description -->
              <p v-html="projectDetails.short_description"></p>
              <!-- <p v-html="projectDetails.short_description">{{projectDetails.short_description}}</p> -->

              <p v-html="projectDetails.description"></p>
              <!-- <p>{{projectDetails.description}}</p> -->

              <!-- Listing Contacts -->
              <div class="listing-links-container">
                <ul class="listing-links contact-links">
                  <li class="listing_phone_links">
                    <i class="fa fa-phone"></i>
                    <span v-if="showPhone">+359</span>
                    <span v-else>
                      <a :href="'tel:'+vendorDetails.phone_number">{{ vendorDetails.phone_number }}</a>
                    </span>
                    <span
                      class="phone_button"
                      @click="contactAnalytic('phone')"
                      v-if="showPhone"
                    >Покажи</span>
                    <span class="phone_button" @click="hidePhone" v-if="!showPhone">Скрий</span>
                  </li>
                  <li>
                    <a
                      href="mailto:mail@example.com"
                      class="listing-links"
                      @click="contactAnalytic('email')"
                    >
                      <i class="fa fa-envelope-o"></i>
                      {{ vendorDetails.email_address}}
                    </a>
                  </li>
                  <li>
                    <a
                      :href="'//' + vendorDetails.website"
                      target="_blank"
                      class="listing-links"
                      @click="contactAnalytic('website')"
                    >
                      <i class="fa fa-link"></i>
                      {{ vendorDetails.website }}
                    </a>
                  </li>
                </ul>
                <div class="clearfix"></div>

                <ul class="listing-links">
                  <li>
                    <a
                      :href="vendorDetails.facebook_link"
                      target="_blank"
                      class="listing-links-fb"
                      @click="contactAnalytic('facebook')"
                    >
                      <i class="fa fa-facebook-square"></i> Facebook
                    </a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="clearfix"></div>

              <!-- Amenities -->
              <h3 class="listing-desc-headline">Тагове</h3>
              <!-- More Search Options -->

              <ul class="listing-features checkboxes">
                <li v-for="(tag, i) in projectDetails.tags" :key="i">{{ tag.tag.tag }}</li>
              </ul>
            </div>

            <!-- Location -->
            <div id="listing-location" class="listing-section">
              <h3 class="listing-desc-headline margin-top-60 margin-bottom-30">Локация</h3>

              <div id="singleListingMap-container">
                <google-map
                  v-if="projectDetails.lat && projectDetails.lng && projectDetails.formatted_address && projectDetails.raw_data"
                  :lat="projectDetails.lat"
                  :lng="projectDetails.lng"
                  :formatted_address="projectDetails.formatted_address"
                  :placeObj="projectDetails.raw_data"
                  :view="true"
                />
              </div>
            </div>
          </div>

          <!-- Sidebar
          ==================================================-->
          <div class="col-lg-4 col-md-4 margin-top-75 sticky">
            <!-- Verified Badge -->
            <div
              class="verified-badge with-tip"
              data-tip-content="Listing has been verified and belongs the business owner or manager."
            >
              <router-link :to="'/profile/' + vendorDetails.user">
                <i class="sl sl-icon-check"></i>
                {{vendorDetails.company_name}}
              </router-link>
            </div>

            <!-- Contact -->
            <div class="boxed-widget margin-top-35">
              <div class="hosted-by-title">
                <h4 v-if="vendorDetails.company_name">
                  <span>Създаден от</span>
                  {{vendorDetails.company_name}}
                </h4>
                <router-link :to="'/profile/' + vendorDetails.user" class="hosted-by-avatar">
                  <!-- <a :href="'/profile/' + vendorDetails.user" class="hosted-by-avatar"> -->
                  <img src="images/dashboard-avatar.jpg" alt />
                  <!-- </a> -->
                </router-link>
              </div>
              <ul class="listing-details-sidebar">
                <li v-if="vendorDetails.phone_number">
                  <i class="sl sl-icon-phone"></i>
                  <span v-if="showPhone">+359</span>
                  <span v-else>
                    <a :href="'tel:'+vendorDetails.phone_number">{{ vendorDetails.phone_number }}</a>
                  </span>
                  <span
                    class="phone_button"
                    @click="contactAnalytic('phone')"
                    v-if="showPhone"
                  >Покажи</span>
                  <span class="phone_button" @click="hidePhone" v-if="!showPhone">Скрий</span>
                </li>
                <li v-if="vendorDetails.website">
                  <i class="sl sl-icon-globe"></i>
                  <a
                    :href="'//' + vendorDetails.website"
                    @click="contactAnalytic('website')"
                    target="_blank"
                  >{{vendorDetails.website}}</a>
                </li>
                <li v-if="vendorDetails.email_address">
                  <i class="fa fa-envelope-o"></i>
                  <a
                    :href="'mailto:'+ vendorDetails.email_address"
                    @click="contactAnalytic('email')"
                  >{{vendorDetails.email_address}}</a>
                </li>
              </ul>

              <ul class="listing-details-sidebar social-profiles">
                <li v-if="vendorDetails.facebook_link">
                  <a
                    :href="vendorDetails.facebook_link"
                    target="_blank"
                    class="facebook-profile"
                    @click="contactAnalytic('facebook')"
                  >
                    <i class="fa fa-facebook-square"></i> Facebook
                  </a>
                </li>
              </ul>
            </div>
            <!-- Contact / End-->

            <!-- Share / Like -->
            <div class="listing-share margin-top-40 margin-bottom-40 no-border">
              <!-- Share Buttons -->
              <ul class="share-buttons margin-top-40 margin-bottom-0">
                <li>
                  <a
                    class="fb-share"
                    target="_blank"
                    :href="'https://www.facebook.com/sharer/sharer.php?u=https://maistorimo.bg/#/service/details/'+ this.id +'&display=popup'"
                    @click="contactAnalytic('facebook')"
                  >
                    <i class="fa fa-facebook"></i> Сподели
                  </a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>

            <!-- Widget -->
            <div class="widget margin-top-40" v-if="services.length >=1">
              <h3>Услуги</h3>
              <ul class="widget-tabs">
                <!-- Post #1 -->
                <li v-for="( service, index) in services" :key="index">
                  <div class="widget-content">
                    <div class="widget-thumb">
                      <router-link tag="a" :to="'/service/details/'+ service.id">
                        <img :src="service.image_url" alt />
                      </router-link>
                    </div>

                    <div class="widget-text">
                      <h5>
                        <router-link
                          tag="a"
                          :to="'/service/details/'+ service.id"
                        >{{ service.name }}</router-link>
                      </h5>
                      <span>{{ service.created_at }}</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </li>
              </ul>
            </div>
            <!-- <div v-else>
              <h3>Вие все още нямате Услуга.</h3>
              <a href="/vendor#/service/add-service">Добави</a>
            </div>-->
            <!-- Widget / End-->
          </div>
          <!-- Sidebar / End -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VueGallery from "vue-gallery";
import GoogleMap from "../../components/googleMap/GoogleMap";
import { analyticFunction } from "../mixins/analytic_function";
import axios from "axios";

export default {
  mixins: [analyticFunction],
  name: "ProjectDetails",
  props: ["id"],
  data() {
    return {
      projectDetails: {},
      services: [],
      vendorDetails: {},
      uniqueToken: document.cookie,
      windowUrl: window.location,
      images: [
        "https://dummyimage.com/800/ffffff/000000",
        "https://dummyimage.com/1600/ffffff/000000",
        "https://dummyimage.com/1280/000000/ffffff",
        "https://dummyimage.com/400/000000/ffffff"
      ],
      city: {
        id: null,
        city: ""
      },
      index: null
    };
  },
  created() {
    this.getProjectDetails();
    // this.getCookies();
  },
  watch: {
    projectDetails(value) {
        // this.removeHead();
        const title=value.title;
        const img= value.project_galleries[0].url;
        const desc=value.description;
        // this.setHead(title,img,desc);
    }
  },
  methods: {
     getCookies() {},
    async getProjectDetails() {
      try {
        const res = await axios.get("/projects/" + this.id);
        this.projectDetails = res.data.project;
        this.vendorDetails = res.data.vendor;
        this.city = res.data.project.city;
        if (res.data.project.project_services.length > 0) {
          this.services.push(res.data.project.project_services[0].service);
        }
        this.images = res.data.project.project_galleries.map(
          image => image.url
        );
        let currentDateWithFormat = new Date()
          .toJSON()
          .slice(0, 10)
          .replace(/-/g, "-");
        const responce = await axios.post("/analytics", {
          user: this.vendorDetails.id,
          project: this.id,
          object_type: "project",
          date: currentDateWithFormat
        });
      } catch (error) {
        console.log(error);
      }
    },
    handleClick(imageIndex) {
      this.index = imageIndex;
    }
  },
  components: {
    gallery: VueGallery,
    GoogleMap
  }
};
// console.log(this.projectDetails);
</script>

<style scoped>
.my-main-search-inner {
  height: 30vh;
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding-bottom: 30px;
  text-align: center;

  padding-top: 190px;
  padding-bottom: 150px;
}

.image {
  float: left;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center center;
  border: 1px solid #ebebeb;
  margin: 5px;
  flex-basis: 18%;
}

@media screen and (max-width: 1400px) {
  .image {
    flex-basis: 24%;
  }
}

@media screen and (max-width: 1200px) {
  .image {
    flex-basis: 31%;
  }
}

@media screen and (max-width: 1000px) {
  .image {
    flex-basis: 42%;
  }
}

@media screen and (max-width: 850px) {
  .image {
    flex-basis: 48%;
  }
}

@media screen and (max-width: 600px) {
  .image {
    flex-basis: 96%;
  }
}
</style>
