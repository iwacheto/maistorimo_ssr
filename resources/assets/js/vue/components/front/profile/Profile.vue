<template>
  <div v-if="profile.vendor_details">
    <div id="titlebar" class="gradient">
      <div class="background-img" v-bind:style="[profile.vendor_details.main_image ? { backgroundImage: 'url(' + profile.vendor_details.main_image + ') !important' } : {}]"></div>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="user-profile">
              
              <!-- USER PROFILE IMAGE -->
              <div class="user-profile-img">
                <img :src="profile.vendor_details.profile_image" alt />
              </div>
              
              <!-- USER PROFILE COMPANY NAME -->
              <div class="user-profile-name">
                <h2>{{ profile.vendor_details.company_name }}</h2>
              </div>

              <!-- USER PROFILE COMPANY INFO -->
              <div class="user-profile-info">
                <div class="left-side-items">
                  <div v-if="profile.vendor_details.phone_number">
                    <!-- <i class="sl sl-icon-phone"></i> -->
                    <img src="/images/phone-icon.svg" alt="phone">
                    <span v-if="showPhone">+359</span>
                    <span v-else>
                      <a
                        :href="'tel:'+profile.vendor_details.phone_number"
                      >{{ profile.vendor_details.phone_number }}</a>
                    </span>
                    <span class="phone_button" @click="contactAnalytic('phone')" v-if="showPhone">Покажи</span>
                    <span class="phone_button" @click="hidePhone" v-if="!showPhone">Скрий</span>
                  </div>

                  <div v-if="profile.vendor_details.website">
                    <a
                      :href="'//' + profile.vendor_details.website"
                      target="_blank"
                      class="listing-links"
                      @click="contactAnalytic('website')"
                    >
                      <!-- <i class="fa fa-link"></i> -->
                      <img src="/images/globe-icon.svg" alt="website">
                      {{ profile.vendor_details.website }}
                    </a>
                  </div>
                </div>

                <div class="right-side-items">
                  <div v-if="profile.vendor_details.email_address">
                    <!-- <i class="fa fa-envelope-o"></i> -->
                    <img src="/images/mail-icon.svg" alt="email">
                    <a
                      :href="'mailto:'+profile.vendor_details.email_address"
                      @click="contactAnalytic('email')"
                    >{{ profile.vendor_details.email_address }}</a>
                  </div>

                  <div v-if="profile.vendor_details.facebook_link">
                    <a
                      :href="profile.vendor_details.facebook_link"
                      target="_blank"
                      class="facebook-profile"
                      @click="contactAnalytic('facebook')"
                    >
                      <!-- <i class="fa fa-facebook-square"></i> Facebook -->
                      <img src="/images/fb-icon.svg" alt="email"> Facebook
                    </a>
                  </div>

                </div>
              </div>

              <div class="user-profile-description">
                
                <div class="desc-box" v-if="profile.vendor_details.information">
                  <button @click="changeInfoClass" class="desc-show-more-button">{{ info_button }}</button>

                  <p
                    class="profile_info"
                    v-html="profile.vendor_details.information.substring(0,subNumb) + subText"
                    :class="[active ? 'active' : '']"
                  ></p>
<!-- 
                  <p
                    class="profile_info"
                    v-html="profile.vendor_details.information"
                    :class="[active ? 'active' : '']"
                  ></p> -->
                  
                </div>

              </div>

            </div>
            
            <!-- <div class="user-profile-titlebar">
              <div class="mask">
                <div class="blur-background"></div>
              </div>
              <div class="company_profile">
                <div class="user-profile-avatar">
                  <img :src="profile.vendor_details.profile_image" alt />
                </div>
                <div class="user-profile-name">
                  <h2>{{ profile.vendor_details.company_name }}</h2>
                  <div class="star-rating" data-rating="5"></div>
                </div> -->

                <!-- Profile Info -->
                <!-- <div class="p_info p_info_mobile" v-if="profile.vendor_details.information">
                  <p
                    class="profile_info"
                    v-html="profile.vendor_details.information"
                    :class="[active ? 'active' : '']"
                  ></p>
                  <span @click="changeInfoClass" class="info_span">{{ info_button }}</span>
                </div> -->
                <!-- End Profile Info -->

                <!-- Verified Badge -->
                <!-- <div
                  class="verified-badge with-tip"
                  data-tip-content="Account has been verified and belongs to the person or organization represented."
                >
                  <i class="sl sl-icon-user-following"></i> Потвърден акаунт
                </div>
              </div> -->

              <!-- Contact -->
              <!-- <div class="contact-mask">
                <div class="contact-blur-background"></div>
              </div> -->

              <!-- <div class="boxed-widget"> margin-top-30 margin-bottom-50 -->
                <!-- <h3>Контакти</h3>
                <ul class="listing-details-sidebar">
                  <li v-if="profile.vendor_details.phone_number">
                    <i class="sl sl-icon-phone"></i>

                    <span v-if="showPhone">+359</span>
                    <span v-else>
                      <a
                        :href="'tel:'+profile.vendor_details.phone_number"
                      >{{ profile.vendor_details.phone_number }}</a>
                    </span>
                    <span class="phone_button" @click="contactAnalytic('phone')" v-if="showPhone">Покажи</span>
                    <span class="phone_button" @click="hidePhone" v-if="!showPhone">Скрий</span>
                  </li>
                  <li v-if="profile.vendor_details.email_address">
                    <i class="fa fa-envelope-o"></i>
                    <a
                      :href="'mailto:'+profile.vendor_details.email_address"
                      @click="contactAnalytic('email')"
                    >{{ profile.vendor_details.email_address }}</a>
                  </li>
                  <li v-if="profile.vendor_details.website">
                    <a
                      :href="'//' + profile.vendor_details.website"
                      target="_blank"
                      class="listing-links"
                      @click="contactAnalytic('website')"
                    >
                      <i class="fa fa-link"></i>
                      {{ profile.vendor_details.website }}
                    </a>
                  </li>
                </ul>

                <ul class="listing-details-sidebar social-profiles">
                  <li v-if="profile.vendor_details.facebook_link">
                    <a
                      :href="profile.vendor_details.facebook_link"
                      target="_blank"
                      class="facebook-profile"
                      @click="contactAnalytic('facebook')"
                    >
                      <i class="fa fa-facebook-square"></i> Facebook
                    </a>
                  </li>
                </ul>

              </div> -->
              <!-- Contact / End-->

            <!-- </div> -->

            
          </div>
        </div>
      </div>
    </div>

    <div class="projects-container">
      <div class="row sticky-wrapper">
        <!-- Sidebar
        ==================================================-->
        <!-- <div class="col-md-12 margin-top-0">
          <div class="p_info p_info_deckstop" v-if="profile.vendor_details.information">
            <p
              class="profile_info"
              v-html="profile.vendor_details.information"
              :class="[active ? 'active' : '']"
            ></p>
            <span @click="changeInfoClass" class="info_span">{{ info_button }}</span>
          </div>

        </div> -->
        <!-- Sidebar / End -->
        <!-- Tabs -->
        <div class="user-projects-services">
          <ul class="nav nav-tabs nav-justified">
            <li class="nav-item" :class="{ active: isActive('home') }">
              <a
                class="nav-link"
                @click.prevent="setActive('home')"
                :class="{ active: isActive('home') }"
                href="#home"
              >Проекти</a>
            </li>
            <li class="nav-item" :class="{ active: isActive('services') }">
              <a
                class="nav-link"
                @click.prevent="setActive('services')"
                :class="{ active: isActive('services') }"
                href="#home"
              >Услуги</a>
            </li>
          </ul>
        </div>
        <!--End  Tabs -->

        <!-- Content
        ==================================================-->
        <div class="col-lg-12 col-md-12 padding-left-30">
          <!-- Tabs -->
          <div class="dashboard-list-box margin-top-0">
            <div class="dashboard-list-box-static col-md-12">
              <div class="tab-pan" :class="{ 'active show': isActive('home') }">
                <h3
                  class="margin-top-10 margin-bottom-40"
                >Проектите на {{ profile.vendor_details.company_name }}</h3>
                <!-- Listings Container -->
                <div class="row col-lg-12 col-md-12">
                  <!-- Listing Item -->
                  <div
                    class="col-md-4"
                    v-for="(project, index) in profile.projects"
                    :key="index"
                  >
                    <div class="listing-item-container list-layout">
                      <router-link :to="'/project/details/' + project.id" class="listing-item">
                        <!-- Image -->
                        <div class="listing-item-image">
                          <img :src="project['mainImage']" alt />
                          <!-- <span class="tag">{{ project.title }}</span> -->
                        </div>

                        <!-- Content -->
                        <div class="listing-item-content">
                          <div class="listing-badge now-open">Верифициран</div>

                          <div class="listing-item-inner">
                            <h3>{{ project.title }}</h3>
                            <span>{{ project.formatted_address }}</span>
                            <!-- <div class="star-rating" data-rating="3.5">
                        <div class="rating-counter">(12 reviews)</div>
                            </div>-->
                          </div>

                        </div>
                      </router-link>
                    </div>
                  </div>
                  <!-- Listing Item / End -->

                </div>
              </div>

              <div class="tab-pan" :class="{ 'active show': isActive('services') }">
                <!-- Services -->
                <h3 class="margin-top-10 margin-bottom-40"
                  >Услугите на {{ profile.vendor_details.company_name }}
                </h3>
                <div class="row" v-if="profile.services.length>=1">

                  <div
                    class="col-md-4"
                    v-for="(service, index) in profile.services"
                    :key="index"
                  >
                    <div class="listing-item-container list-layout">
                      <router-link :to="'/service/details/'+ service.id" class="listing-item">
                        <!-- Image -->
                        <div class="listing-item-image">
                          <img :src="service.image_url" :alt="service.image_name" />
                        </div>

                        <!-- Content -->
                        <div class="listing-item-content">
                          <div class="listing-badge now-open">Верифицирана</div>

                          <div class="listing-item-inner">
                            <h3>{{service.name}}</h3>
                            <!-- <span v-html="service.first_description"></span>
                            <span v-html="service.second_description"></span> -->
                          </div>

                        </div>
                      </router-link>
                    </div>
                  </div>
                </div>
                <div class="row service_link" v-else>
                  <h4>Вие все още нямате създадена услуга</h4>
                  <a href="/vendor/service/add-service">Създай услуга</a>
                </div>

                <!-- Listings Container / End -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { analyticFunction } from "../mixins/analytic_function";
import ClientOnly from 'vue-client-only';
import axios from "axios";
import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

export default {
  mixins: [analyticFunction],
  name: "Profile",
  props: ["id"],
    metaInfo() {
        return {
            meta: [],
        };
    },
  data() {
    return {
      subNumb: 80,
      subText: ' ...',
      activeItem: "home",
      showMore: false,
      isActiveContent: true,
      info_button: "",
      info_1: "Покажи повече",
      info_2: "Скрий текста",
      active: false,
      test: "Some long text",
      profile: {},
      vendorDetails: {
        user: null
      }
    };
  },
  mounted() {
    this.getProfile();
    this.info_button = this.info_1;
  },
  methods: {
    changeInfoClass() {
      this.active = !this.active;
      
      if (this.info_button == "Покажи повече") {
        this.info_button = this.info_2;
        this.subNumb = 800;
        this.subText = ''
      } else {
        this.info_button = this.info_1;
        this.subNumb = 80;
        this.subText = ' ...';
      }
    },
    async getProfile() {
      try {
        let res = await axios.get("/profiles/" + this.id);
        this.profile = res.data;
        this.vendorDetails.user = res.data.vendor_details.id;
        this.contactAnalytic("profile");
        console.log(this.profile);
        console.log(this.vendorDetails);
      } catch (error) {
        console.log(error);
      }
    },
    handleClick(imageIndex) {
      this.index = imageIndex;
    },
    isActive(menuItem) {
      return this.activeItem === menuItem;
    },
    setActive(menuItem) {
      this.activeItem = menuItem;
    }
  },
  components: {
        ClientOnly
    }
};
</script>

<style scoped>
  /* TsB */

  #titlebar {
    padding-top: 12px !important;
  }

  #titlebar div.container {
    /* position: absolute; */
    top: 19%;
    z-index: 1;
    width: 100%;
  }

  .container .row {
    margin-left: unset;
    margin-right: unset;
    width: 100%;
  }

  .row .col-lg-12 {
    width: 100%;
  }

  .user-profile {
    display: flex;
    flex-direction: column;
    align-content: center;
    justify-content: center;
    align-items: center;
  }

  .user-profile-img {
    margin-top: -70px;
  }

  .user-profile-img img {
    border-radius: 50%;
    width: 141px;
    height: 141px;
    overflow: hidden;
    background: #C4C4C4;
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.25);
  }

  #titlebar .user-profile-name {
    position: unset;
    left: 0px;
  }

  #titlebar .user-profile-name h2 {
    font-weight: 500;
    font-size: 20px;
    line-height: 23px;
    text-align: center;
    color: #324E5B;
    margin: 12px 0px;
    padding: 0px;
  }

  .user-projects-services {
    margin-top: 50px;
  }

  .user-profile-info {
    width: 731px;
    height: 136px;
    background: #F7F7F7;
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.25);
    border-radius: 25px;
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    align-content: center;
    align-items: center;
    padding-left: 70px;
  }

  .left-side-items, .right-side-items {
    display: flex;
    flex-direction: column;
    width: 50%;
    margin: 0px auto;
  }

  .left-side-items img, .right-side-items img {
    margin-right: 32px;
    width: 33px;
  }

  .left-side-items div:nth-child(1), .right-side-items div:nth-child(1) {
    margin-bottom: 24px;
  }

  #titlebar .left-side-items span, #titlebar .left-side-items span a {
    font-style: normal;
    font-weight: 500;
    font-size: 17px;
    line-height: 20px;
    color: #324E5B;
    margin: 0px;
  }

  .listing-links {
    margin-bottom: 0px;
  }

  .user-profile-description {
    background: #F7F7F7;
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.25);
    border-radius: 25px;
    min-height: 220px;
    max-width: 82.5%;
    padding: 0px 30px 25px 30px;
    margin-top: 24px;
    display: flex;
    flex-direction: column;
  }

  .desc-box {
    display: flex;
    flex-direction: column;
  }

  .desc-show-more-button {
    min-width: 195px;
    height: 34px;
    background: #6BBF3F;
    border-radius: 19.5px;
    font-style: normal;
    font-weight: 300;
    font-size: 17px;
    line-height: 20px;
    text-align: center;
    color: #FFFFFF;
    border: 1px solid #6bbf3f;
    margin: 20px auto;
    padding: 5px 34px;
  }

  .row.sticky-wrapper {
      flex-direction: column;
      display: flex;
  }

  #titlebar span a, #titlebar span {
    color: #fff;
  }

  .background-img {
    background-image: url('/images/main-picture.jpg') !important;
    background-repeat: no-repeat !important;
    background-size: 100% !important;
    width: 100%;
    height: 348px;
  }

  h2 {
    color: #fff;
  }

  .projects-container {
    width: 100% !important;
    margin-left: auto;
    margin-right: auto;
    margin-top: -60px;
  }

  .sticky-wrapper {
    width: 100%;
    margin-left: 0px;
    margin-right: 0px;
  }

  .listing-item-image {
    flex: 5 !important;
  }

  .listing-item-container.list-layout .listing-item-inner {
    padding-right: 15% !important;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
  }

  .listing-item-inner>span {
    padding-left: 10%;
    display: none;
  }

  div.user-projects-services {
    position: unset !important;
  }

  div.user-projects-services ul.nav.nav-tabs.nav-justified {
    justify-content: center; /* TsB */
  }

  div.tab-pan div.row{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
  }

  div.col-md-4 {
    display: flex;
    flex: 35%;
  }

  li.nav-item.active{
    background: #276955;
  }

  li.nav-item a {
    color: #276955;
  }

  .listing-badge.now-open {
    background-color: #276955;
  }

  @media screen and (max-width: 1024px) {
    #titlebar {
      padding-top: 0px !important;
    }

    .background-img {
      width: 100%;
      height: 348px;
    }

    .row.col-lg-12.col-md-12 {
      flex-direction: column;
    }

    div.col-md-4 {
      display: flex;
      width: 100% !important;
    }

  }

  /* @media screen and (max-width: 992px) {

    .listing-item-container.list-layout .listing-item-inner {
      left: 0px;
    }
  } */

  @media screen and (max-width: 990px) {
    #titlebar .container, #titlebar .container .row .col-md-12 {
      padding-left: unset;
      padding-right: unset;
    }

    .user-profile-info {
      width: 100%;
      box-shadow: unset;
      flex-direction: column;
      height: unset;
    }

    .user-profile-description {
      box-shadow: unset;
      max-width: 100%;
    }

    .left-side-items div:nth-child(1), .right-side-items div:nth-child(1) {
      margin-bottom: unset;
    }

    .left-side-items div, .right-side-items div {
      margin: 20px 0px;
    }

    .left-side-items div:nth-child(2) {
      margin-bottom: 0px;
    }
  }

  @media screen and (max-width: 560px) {

    .left-side-items, .right-side-items {
      width: 62%;
    }

    .user-profile-description {
      min-height: unset;
    }
  }

  @media screen and (max-width: 530px) {

    #titlebar {
      margin-top: unset;
    }
  }

  @media screen and (max-width: 480px) {

    .user-profile-img {
      margin-top: -95px;
    }

    .left-side-items, .right-side-items {
      width: 75%;
    }
  }

  @media screen and (max-width: 414px) {

    .user-profile-img {
      margin-top: -141px;
    }

    .projects-container {
      margin-top: -25px;
    }

    div.col-md-4 {
      flex: 55%;
    }

    .left-side-items, .right-side-items {
      width: 92%;
    }

  }

  @media screen and (max-width: 380px) {

    .user-profile-img {
      margin-top: -161px;
    }

    .left-side-items, .right-side-items {
      width: 100%;
    }
  }

  @media screen and (max-width: 360px) {

    .user-profile-img {
      margin-top: -181px;
    }

    .user-profile-info {
      padding-left: 50px;
    }
  }

  @media screen and (max-width: 320px) {

    .user-profile-img {
      margin-top: -211px;
    }
  }

  @media screen and (max-width: 280px) {

    .user-profile-img {
      margin-top: -231px;
    }

    .user-profile-info {
      padding-left: 20px;
    }
  }

</style>
