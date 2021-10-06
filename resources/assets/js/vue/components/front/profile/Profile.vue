<template>
  <div v-if="profile.vendor_details">
    <div id="titlebar" class="gradient">
      <div class="background-img" v-bind:style="[profile.vendor_details.main_image ? { backgroundImage: 'url(' + profile.vendor_details.main_image + ') !important' } : {}]"></div>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="user-profile-titlebar">
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
                </div>

                <!-- Profile Info -->
                <div class="p_info p_info_mobile" v-if="profile.vendor_details.information">
                  <p
                    class="profile_info"
                    v-html="profile.vendor_details.information"
                    :class="[active ? 'active' : '']"
                  ></p>
                  <span @click="changeInfoClass" class="info_span">{{ info_button }}</span>
                </div>
                <!-- End Profile Info -->

                <!-- Verified Badge -->
                <div
                  class="verified-badge with-tip"
                  data-tip-content="Account has been verified and belongs to the person or organization represented."
                >
                  <i class="sl sl-icon-user-following"></i> Потвърден акаунт
                </div>
              </div>

              <!-- Contact -->
              <div class="contact-mask">
                <div class="contact-blur-background"></div>
              </div>
              <div class="boxed-widget"> <!-- margin-top-30 margin-bottom-50 -->
                <h3>Контакти</h3>
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

                <!-- Reply to review popup -->
                <!-- <div id="small-dialog" class="zoom-anim-dialog mfp-hide">
                  <div class="small-dialog-header">
                    <h3>Изпрати съобщение</h3>
                  </div>
                  <div class="message-reply margin-top-0">
                    <textarea cols="40" rows="3" placeholder="Your message to Tom"></textarea>
                    <button class="button">Изпрати съобщение</button>
                  </div>
                </div>-->
                <!--
                <a href="#small-dialog" class="send-message-to-owner button popup-with-zoom-anim">
                  <i class="sl sl-icon-envelope-open"></i> Изпрати съобщение
                </a>-->
              </div>
              <!-- Contact / End-->

            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="projects-container">
      <div class="row sticky-wrapper">
        <!-- Sidebar
        ==================================================-->
        <div class="col-md-12 margin-top-0">
          <div class="p_info p_info_deckstop" v-if="profile.vendor_details.information">
            <p
              class="profile_info"
              v-html="profile.vendor_details.information"
              :class="[active ? 'active' : '']"
            ></p>
            <span @click="changeInfoClass" class="info_span">{{ info_button }}</span>
          </div>

        </div>
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
      } else {
        this.info_button = this.info_1;
      }
    },
    async getProfile() {
      try {
        let res = await axios.get("/profiles/" + this.id);
        this.profile = res.data;
        this.vendorDetails.user = res.data.vendor_details.id;
        this.contactAnalytic("profile");
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

  .row.sticky-wrapper {
      flex-direction: column;
      display: flex;
  }

  #titlebar {
    padding-top: 44px !important;
  }

  #titlebar div.container {
    position: absolute;
    top: 19%;
    z-index: 1;
  }

  .mask {
    position: absolute;
    top: 4%;
    left: 20%;
    width: 40%;
    height: 240px;
    border: 2px solid #66B7A3;
    border-radius: 20px;
    z-index: 10;
    overflow: hidden;
    /* filter: blur(3px); */
  }

  .blur-background {
    position: absolute;
    top: 0%;
    left: 0%;
    width: 100%;
    height: 100%;
    display: block;
    background-image: url('/images/main-picture.jpg');
    z-index: 1;
    padding-left: 20%;
    padding-top: 20%;
    background-position-x: -253px;
    background-position-y: -47px;
    filter: blur(15px);
  }

  .company_profile {
    position: absolute;
    top: 45px;
    left: 23%;
    z-index: 40;
  }

  .verified-badge {
    background-color: #276955;
  }

  .contact-mask {
    left: 94%;
    width: 40%;
    height: 240px;
    border: 2px solid #66B7A3;
    border-radius: 20px;
    position: absolute;
  }

  .contact-blur-background {
    position: absolute;
    top: 0%;
    left: 0%;
    width: 100%;
    height: 100%;
    display: block;
    background-image: url('/images/main-picture.jpg');
    z-index: 1;
    padding-left: 20%;
    padding-top: 20%;
    background-position-x: -1128px;
    background-position-y: -38px;
    filter: blur(20px);
  }

  .boxed-widget {
    left: 100%;
    padding-top: 18px;
    background-color: unset;
    padding: 0px;
    margin-top: 24px;
  }

  .boxed-widget h3 {
    border-bottom: unset;
    padding: 0px;
    margin-bottom: 20px;
    height: 53px;
    width: 337px;
    background-color: #276955;
    padding: 16px 0px;
    color: #fff;
    border-radius: 4px;
  }

  .listing-details-sidebar {
    padding-left: 90px;
  }

  #titlebar span a, #titlebar span {
    color: #fff;
  }

  .listing-details-sidebar li i, .listing-details-sidebar li a, .listing-details-sidebar li a i {
    color: #fff;
    font-size: 16px;
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
    /* justify-content: center; */
    align-items: center;
    text-align: center;
  }

  .listing-item-inner>span {
    padding-left: 10%;
    display: none;
  }

  .user-profile-titlebar {
      justify-content: space-between;
  }

  .verified-badge {
    margin-top: 80px;
  }

  div.user-projects-services {
    position: unset !important;
}

  div.user-projects-services ul.nav.nav-tabs.nav-justified {
    justify-content: center; /* TsB */
  }

  div.p_info_deckstop span.info_span {
    display: flex !important;
    justify-content: center;
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

  @media screen and (max-width: 1679px) {
    .mask {
      top: 4%;
      left: 20%;
      width: 40%;
      height: 240px;
    }

    .blur-background {
      top: 0%;
      left: 0%;
      width: 100%;
      height: 100%;
      padding-left: 20%;
      padding-top: 20%;
      background-position-x: -324px;
      background-position-y: -47px;
    }

    .company_profile {
      top: 45px;
      left: 23%;
    }

    .contact-mask {
      left: 84%;
      width: 40%;
      height: 240px;
    }

    .contact-blur-background {
      top: 0%;
      left: 0%;
      width: 100%;
      height: 100%;

      padding-left: 20%;
      padding-top: 20%;
      background-position-x: -1150px;
      background-position-y: -38px;

    }

    .boxed-widget {
      left: 90%;
      padding-top: 18px;
      background-color: unset;
      padding: 0px;
      margin-top: 24px;
    }
  }

  @media screen and (max-width: 1500px) {
    .mask {
      top: 4%;
      left: 10%;
      /* width: 40%;
      height: 240px; */
    }

    .blur-background {
      background-size: 300%;
      /* top: 0%; */
      left: 31%;
      /* width: 100%;
      height: 100%;
      padding-left: 20%;
      padding-top: 20%; */
      background-position-x: -253px;
      /* background-position-y: -47px; */
    }

    .company_profile {
      top: 45px;
      left: 13%;
    }

    .contact-mask {
      top: 7%;
      left: 72%;
      /* width: 40%;
      height: 240px; */
    }

    .contact-blur-background {
      /* top: 0%;
      left: 0%;
      width: 100%;
      height: 100%;

      padding-left: 20%;
      padding-top: 20%; */
      background-position-x: -1150px;
      /* background-position-y: -38px; */

    }

    .boxed-widget {
      left: 78%;
      /* padding-top: 18px;
      background-color: unset;
      padding: 0px; */
      margin-top: 33px;
    }
  }

  @media screen and (max-width: 1440px) {
    /* .mask {
      top: 4%;
      left: 10%;
      width: 40%;
      height: 240px;
    } */

    .blur-background {
      background-size: 290%;
      /* top: 0%;
      left: 37%;
      width: 100%;
      height: 100%;
      padding-left: 20%;
      padding-top: 20%; */
      background-position-x: -262px;
      /* background-position-y: -47px; */
    }

    /* .company_profile {
      top: 45px;
      left: 13%;
    } */

    .contact-mask {
      /* top: 7%; */
      left: 67%;
      /* width: 40%;
      height: 240px; */
    }

    .contact-blur-background {
      /* top: 0%;
      left: 0%;
      width: 100%;
      height: 100%;

      padding-left: 20%;
      padding-top: 20%; */
      background-position-x: -1105px;
      /* background-position-y: -38px; */

    }

    .boxed-widget {
      left: 72%;
      /* padding-top: 18px;
      background-color: unset;
      padding: 0px;
      margin-top: 33px; */
    }
  }

  @media screen and (max-width: 1365px) {
    .mask {
      /* top: 4%; */
      left: 8%;
      /* width: 40%;
      height: 240px; */
    }

    .blur-background {
      background-size: 270%;
      /* top: 0%; */
      left: 0%;
      width: 100%;
      height: 100%;
      /* padding-left: 20%;
      padding-top: 20%; */
      background-position-x: -31px;
      background-position-y: 3px;
    }

    /* .company_profile {
      top: 45px;
      left: 13%;
    } */

    .user-profile-avatar {
      left: -26px;
    }

    .user-profile-name {
      left: 67px;
    }

    .contact-mask {
      /* top: 7%; */
      left: 72%;
      /* width: 40%;
      height: 240px; */
    }

    .contact-blur-background {
      /* top: 0%;
      left: 0%;
      width: 100%;
      height: 100%;

      padding-left: 20%;
      padding-top: 20%; */
      background-position-x: -1031px;
      /* background-position-y: -38px; */

    }

    .boxed-widget {
      left: 76%;
      /* padding-top: 18px;
      background-color: unset;
      padding: 0px;
      margin-top: 33px; */
    }
  }

  @media screen and (max-width: 1240px) {
    #titlebar .user-profile-name h2 {
      font-size: 24px;
    }

    .contact-mask {
      /* top: 7%; */
      left: 77%;
      /* width: 40%;
      height: 240px; */
    }

    .boxed-widget {
      left: 79%;
      /* padding-top: 18px;
      background-color: unset;
      padding: 0px;
      margin-top: 33px; */
    }
  }

  @media screen and (max-width: 1140px) {
    .mask {
      /* top: 4%; */
      left: 3%;
      /* width: 40%;
      height: 240px; */
    }

    .blur-background {
      background-size: 260%;
      /* top: 0%; */
      left: 0%;
      width: 100%;
      height: 100%;
      /* padding-left: 20%;
      padding-top: 20%; */
      background-position-x: 20px;
      /* background-position-y: 3px; */
    }

    .company_profile {
      left: 8%;
    }

    .contact-mask {
      left: 71%;
    }

    .contact-blur-background {
      background-position-x: -1069px;
    }

    .boxed-widget {
      left: 73%;
    }
  }

  @media screen and (max-width: 1080px) {
    .contact-mask {
      left: 65%;
    }

    .boxed-widget {
      left: 67%;
    }
  }

  @media screen and (max-width: 1024px) {
    #titlebar {
      padding-top: 0px !important;
    }

    .background-img {
      /* background-image: url('/images/main-picture.jpg') !important;
      background-repeat: no-repeat !important;
      background-size: 100% !important; */
      width: 100%;
      height: 548px;
    }

    .row.col-lg-12.col-md-12 {
      flex-direction: column;
    }

    div.col-md-4 {
      display: flex;
      width: 100% !important;
    }

    .mask {
      left: 33%;
      height: 358px;
    }

    .blur-background {
      background-position-x: -325px;
      background-position-y: -125px;
      background-size: 276%;
    }

    .company_profile {
      left: 36%;
      height: 200px;
    }

    .company_profile .user-profile-avatar {
      left: 35%;
      top: -10%;
    }

    .company_profile .user-profile-name {
      left: 6%;
      top: 48%;
    }

    .company_profile .verified-badge.with-tip {
      display: none;
    }

    .contact-mask {
      display: none;
      /* left: 64%; */
    }

    .boxed-widget {
      left: 31%;
      top: 175px;
    }

    .boxed-widget h3 {
      display: none;
    }
  }

  @media screen and (max-width: 992px) {
    .listing-item-container.list-layout .listing-item-inner {
      left: 0px;
    }

    .company_profile {
      left: 38%;
      width: 32%;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .company_profile .user-profile-avatar {
      left: 30%;
      top: -13%;
    }

    .company_profile .user-profile-name {
      justify-content: unset;
      position: unset;
      left: 3%;
    }

    .company_profile .user-profile-name h2{
      padding-left: 54px;
    }
  }

  @media screen and (max-width: 990px) {
    .mask {
      left: 47%;
    }

    .company_profile {
      left: 49%;
      width: 37%;
    }

    .company_profile .user-profile-avatar {
      left: 35%;
    }

    .boxed-widget {
      left: 39%;
      width: fit-content;
    }

    .company_profile .user-profile-name h2{
      padding-left: 47px;
    }
  }

  @media screen and (max-width: 876px) {
    .mask {
      left: 40%;
    }

    .company_profile {
      left: 40%;
    }

    .company_profile .user-profile-avatar {
      left: 37%;
    }

    .boxed-widget {
      left: 31%;
    }
  }

  @media screen and (max-width: 768px) {
    #titlebar .container {
      width: 100%;
    }

    .background-img {
      height: 510px;
    }

    .mask {
      top: -12%;
      left: 33%;
    }
    .company_profile {
      left: 34%;
    }

    .company_profile .user-profile-avatar {
      max-width: 90px;
    }

    .boxed-widget {
      left: 25%;
      top: 160px;
    }
  }

  @media screen and (max-width: 687px) {

    .background-img {
      height: 458px;
    }

    .mask {
      top: -36%;
      left: 31%;
    }

    .company_profile {
      left: 30%;
      top: 10%;
    }

    .company_profile .user-profile-avatar {
      left: 38%;
    }

    .company_profile .user-profile-name h2 {
      font-size: 21px;
    }

    .boxed-widget {
      left: 21%;
      top: 110px;
    }

    .listing-details-sidebar li i, .listing-details-sidebar li a, .listing-details-sidebar li a i {
      font-size: 14px;
    }
  }

  @media screen and (max-width: 620px) {

    .background-img {
      height: 414px;
    }

    .mask {
      top: -44%;
      left: 28%;
      height: 330px;
      width: 45%;
    }

    .company_profile {
      left: 30%;
      top: -25%;
      width: 42%;
    }

    .company_profile .user-profile-avatar {
      left: 32%;
    }

    #titlebar .user-profile-name h2 {
      font-size: 21px;
    }

    .boxed-widget {
      left: 17%;
      top: 65px;
    }
  }

  @media screen and (max-width: 560px) {

    #titlebar.gradient {
      margin: 0px !important;
      padding: 0px !important;
    }

    .background-img {
      height: 406px;
    }

    .mask {
      top: -43%;
      left: 28%;
      /* height: 330px;
      width: 45%; */
    }

    .company_profile {
      left: 25%;
      top: -19%;
    }

    .company_profile .user-profile-avatar {
      left: 42%;
    }

    .boxed-widget {
      left: 14%;
      top: 78px;
    }
  }

  @media screen and (max-width: 530px) {

    .background-img {
      height: 390px;
    }

    .mask {
      top: -51%;
      left: 25%;
      height: 285px;
      width: 50%;
    }

    .company_profile {
      left: 25%;
      top: -40%;
      width: 50%;
    }

    .company_profile .user-profile-avatar {
      left: 38%;
      top: -3%;
      max-width: 70px !important;
    }

    .boxed-widget {
      left: 11%;
      top: 78px;
      margin-top: 0px;
    }

    .boxed-widget .listing-details-sidebar.social-profiles{
      margin: 0px;
    }
  }

  @media screen and (max-width: 480px) {

    .background-img {
      height: 390px;
    }

    .mask {
      top: -43%;
      left: 24%;
      height: 285px;
      width: 55%;
    }

    .company_profile {
      left: 23%;
      top: -30%;
    }

    .company_profile .user-profile-avatar {
      left: 42%;
    }

    .boxed-widget {
      left: 8%;
      top: 90px;
      margin-top: 0px;
    }
  }

  @media screen and (max-width: 450px) {

    /* .background-img {
      height: 390px;
      width: 120%;
    } */

    .mask {
      top: -87%;
      left: 24%;
    }

    .company_profile {
      left: 23%;
      top: -75%;
    }

    #titlebar .user-profile-name h2 {
      font-size: 19px;
    }

    .boxed-widget {
      top: 36px;
      left: 6%;
    }
  }

  @media screen and (max-width: 414px) {

    /* .background-img {
      height: 390px;
      width: 120%;
    } */

    .mask {
      top: -88%;
      left: 24%;
      width: 60%;
      height: 260px;
    }

    .company_profile {
      left: 25%;
      top: -80%;
    }

    .company_profile .user-profile-avatar {
      left: 40%;
    }

    .company_profile .user-profile-name h2 {
      font-size: 20px;
    }

    .boxed-widget {
      top: 14px;
      left: 6%;
    }
  }

  @media screen and (max-width: 380px) {

    .background-img {
      height: 300px;
      width: 100%;
      /*overflow: hidden;
       object-fit: cover;
      object-position: center; */

    }

    .mask {
      top: -76%;
      left: 24%;
      width: 60%;
      height: 240px;
    }

    .company_profile {
      left: 24%;
      top: -66%;
      width: 80%;
    }

    .company_profile .user-profile-avatar {
      left: 26%;
    }

    .company_profile .user-profile-avatar img {
      width: 85%;
    }

    .company_profile .user-profile-name {
      font-size: 18px;
      margin-top: -30px;
    }

    .company_profile .user-profile-name h2 {
      font-size: 18px;
      margin-top: -32px;
    }

    .boxed-widget {
      top: 10px;
      left: 2%;
    }
  }

</style>
