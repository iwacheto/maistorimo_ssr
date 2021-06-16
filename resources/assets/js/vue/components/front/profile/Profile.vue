<template>
  <div v-if="profile.vendor_details">
    <div id="titlebar" class="gradient">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="user-profile-titlebar">
              <div class="company_profile">
                <div class="user-profile-avatar">
                  <img :src="profile.vendor_details.profile_image" alt />
                </div>
                <div class="user-profile-name">
                  <h2>{{ profile.vendor_details.company_name }}</h2>
                  <div class="star-rating" data-rating="5"></div>
                </div>
                <div class="p_info p_info_mobile" v-if="profile.vendor_details.information">
                  <p
                    class="profile_info"
                    v-html="profile.vendor_details.information"
                    :class="[active ? 'active' : '']"
                  ></p>
                  <span @click="changeInfoClass" class="info_span">{{ info_button }}</span>
                </div>
              </div>

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
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row sticky-wrapper">
        <!-- Sidebar
        ==================================================-->
        <div class="col-lg-4 col-md-4 margin-top-0">
          <div class="p_info p_info_deckstop" v-if="profile.vendor_details.information">
            <p
              class="profile_info"
              v-html="profile.vendor_details.information"
              :class="[active ? 'active' : '']"
            ></p>
            <span @click="changeInfoClass" class="info_span">{{ info_button }}</span>
          </div>
          <!-- Verified Badge -->
          <div
            class="verified-badge with-tip"
            data-tip-content="Account has been verified and belongs to the person or organization represented."
          >
            <i class="sl sl-icon-user-following"></i> Потвърден акаунт
          </div>

          <!-- Contact -->
          <div class="boxed-widget margin-top-30 margin-bottom-50">
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
        <!-- Sidebar / End -->

        <!-- Content
        ==================================================-->
        <div class="col-lg-8 col-md-8 padding-left-30">
          <!-- Tabs -->
          <div class="dashboard-list-box margin-top-0">
            <div class="dashboard-list-box-static">
              <div class="tab-pan" :class="{ 'active show': isActive('home') }">
                <h3
                  class="margin-top-10 margin-bottom-40"
                >Проектите на {{ profile.vendor_details.company_name }}</h3>
                <!-- Listings Container -->
                <div class="row">
                  <!-- Listing Item -->
                  <div
                    class="col-lg-12 col-md-12"
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

                          <!-- <span class="like-icon"></span> -->
                        </div>
                      </router-link>
                    </div>
                  </div>
                  <!-- Listing Item / End -->

                </div>
              </div>

              <div class="tab-pan" :class="{ 'active show': isActive('services') }">
                <!-- Services -->
                <div class="row" v-if="profile.services.length>=1">
                  <h3
                    class="margin-top-10 margin-bottom-40"
                  >Услугите на {{ profile.vendor_details.company_name }}</h3>
                  <div
                    class="col-lg-12 col-md-12"
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
                            <span v-html="service.first_description"></span>
                            <span v-html="service.second_description"></span>
                          </div>

                          <!-- <span class="like-icon"></span> -->
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
import axios from "axios";

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
  created() {
    this.getProfile();
    this.info_button = this.info_1;
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
  components: {}
};
</script>

