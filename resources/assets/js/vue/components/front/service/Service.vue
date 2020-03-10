<template>
    <!-- <div class="container mfp-gallery-container"> -->
    <div class="container margin-top-100">
        <div class="row">
            <!-- Services -->
            <div class="col-lg-9 col-md-8 padding-right-30 service_body">
                <!-- Img -->
                <div class="mfp-gallery-container">
                    <img :src="servicetDetails.image_url" alt />
                </div>
                <!-- Content -->
                <div class="post-content" :class="[!showText ? 'active' : '']">
                    <h3>{{ servicetDetails.name }}</h3>
                    <p v-html="servicetDetails.first_description"></p>
                    <p v-html="servicetDetails.second_description"></p>
                </div>
                <div @click="showContent" v-if="showText" class="show_button margin-bottom-25">
                    Покажи повече
                    <i class="fa fa-fw">&#xf078;</i>
                </div>
                <div v-if="!showText" @click="showContent" class="show_button margin-bottom-25">
                    Скрий текста
                    <i class="fa fa-fw">&#xf077;</i>
                </div>
                <!-- Fullwidth Section -->
                <div class="container">
                    <div class="row" v-if="projectDetails.length >=1">
                        <div class="col-md-8">
                            <h3 class="headline centered margin-bottom-45">
                                Проекти
                                <span>Проекти от тази услуга</span>
                            </h3>
                        </div>

                        <div class="col-md-8">
                            <div class="simple-slick-carousel dots-nav">
                                <!-- Listing Item -->
                                <div
                                    class="carousel-item"
                                    v-for="( project, index) in projectDetails"
                                    :key="index"
                                >
                                    <router-link
                                        :to="'/project/details/' + project.s_project.id"
                                        class="listing-item-container compact"
                                    >
                                        <div class="listing-item">
                                            <img :src="project.s_project.main_image" alt />

                                            <div class="listing-badge now-open">Верифициран</div>

                                            <div class="listing-item-content">
                                                <!-- <span class="tag">{{ project.title }}</span> -->
                                                <!-- <h3>
                                Tom's Restaurant
                                <i class="verified-icon"></i>
                                                </h3>-->
                                                <router-link
                                                    :to="'/project/details/' + project.s_project.id"
                                                    tag="a"
                                                    class="carousel_link"
                                                >
                                                    <span>{{ project.s_project.title }}</span>
                                                </router-link>
                                            </div>
                                            <span class="like-icon"></span>
                                        </div>
                                    </router-link>

                                    <!-- <div class="star-rating" data-rating="3.5">
                        <div class="rating-counter">(12 reviews)</div>
                                    </div>-->
                                </div>
                                <!-- Listing Item / End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Profile -->
            <div class="col-lg-3 col-md-4 sticky">
                <!-- Verified Badge -->
                <div class="verified-badge with-tip">
                    <router-link :to="'/profile/' + vendorDetails.user">
                        <i class="sl sl-icon-check"></i>
                        {{vendorDetails.company_name}}
                    </router-link>
                </div>

                <!-- Contact -->
                <div class="boxed-widget margin-top-35">
                    <div class="hosted-by-title">
                        <h4>
                            <span>Създаден от</span>
                            {{vendorDetails.contact_person}}
                        </h4>
                        <router-link :to="'/profile/' + vendorDetails.id" class="hosted-by-avatar">
                            <!-- <a :href="'/profile/' + vendorDetails.user" class="hosted-by-avatar"> -->
                            <img src="images/dashboard-avatar.jpg" alt />
                            <!-- </a> -->
                        </router-link>
                    </div>
                    <ul class="listing-details-sidebar">
                        <li>
                            <i class="sl sl-icon-phone"></i>
                            <span v-if="showPhone">+359</span>
                            <span v-else>{{vendorDetails.phone_number}}</span>
                            <span
                                class="phone_button"
                                @click="contactAnalytic('phone')"
                                v-if="showPhone"
                            >Покажи</span>
                            <span class="phone_button" @click="hidePhone" v-if="!showPhone">Скрий</span>
                        </li>

                        <li>
                            <i class="fa fa-envelope-o"></i>
                            <a
                                :href="'//' + vendorDetails.website"
                                target="_blank"
                                @click="contactAnalytic('website')"
                            >{{vendorDetails.website}}</a>
                        </li>
                        <li>
                            <i class="fa fa-envelope-o"></i>
                            <a
                                :href="'mailto:'+vendorDetails.email_address"
                                @click="contactAnalytic('email')"
                            >{{vendorDetails.email_address}}</a>
                        </li>
                    </ul>

                    <ul class="listing-details-sidebar social-profiles">
                        <li>
                            <a
                                target="_blank"
                                :href="vendorDetails.facebook_link"
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
                    <ul class="share-buttons margin-top-40 margin-bottom-0">
                        <li>
                            <a
                                class="fb-share"
                                target="_blank"
                                :href="'https://www.facebook.com/sharer/sharer.php?u=http://maistorimo.bg/#/service/details/'+ this.id +'.com&display=popup'"
                                @click="contactAnalytic('facebook')"
                            >
                                <i class="fa fa-facebook"></i> Сподели
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <!-- Widget -->
                <div class="widget margin-top-40" v-if="projectDetails.length >=1">
                    <h3>Проекти</h3>
                    <ul class="widget-tabs">
                        <li v-for="( project, index) in projectDetails" :key="index">
                            <div class="widget-content">
                                <div class="widget-thumb">
                                    <router-link
                                        tag="a"
                                        :to="'/project/details/' + project.s_project.id"
                                    >
                                        <img :src="project.s_project.main_image" alt />
                                    </router-link>
                                </div>

                                <div class="widget-text">
                                    <h5>
                                        <router-link
                                            tag="a"
                                            :to="'/project/details/' + project.s_project.id"
                                        >{{ project.s_project.title }}</router-link>
                                    </h5>
                                    <span>{{ project.s_project.created_at }}</span>
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
        </div>

        <div class="row sticky-wrapper">
            <!-- Проекти -->
            <div class="col-lg-8 col-md-8 padding-right-30">
                <div v-if="projectDetails.length > 1">
                    <ul class="post-meta">
                        <li>
                            <p></p>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- </div> -->
        </div>
        <!-- Sidebar / End -->
    </div>
</template>

<script>
import { analyticFunction } from '../mixins/analytic_function';
import axios from 'axios';

export default {
    mixins: [analyticFunction],
    name: 'Service',
    props: ['id'],
    data() {
        return {
            vendorDetails: {},
            showText: true,
            servicetDetails: {},
            projectDetails: [],
        };
    },
    created() {
        this.getServicetDetails();
    },
    watch: {
        servicetDetails(value) {
            // this.removeHead();
            const title = value.name;
            const img = value.image_url;
            const desc = value.first_description;
            // this.setHead(title, img, desc);
        },
    },
    methods: {
        showContent() {
            this.showText = !this.showText;
        },
        async getServicetDetails() {
            let self = this;
            try {
                let res = await axios.get('/service_detail/' + this.id);
                this.servicetDetails = res.data.service;
                this.vendorDetails = res.data.vendor ? res.data.vendor : {};
                this.projectDetails = res.data.service.project_services;
                let currentDateWithFormat = new Date()
                    .toJSON()
                    .slice(0, 10)
                    .replace(/-/g, '-');
                const responce = await axios.post('/analytics', {
                    user: this.vendorDetails.id,
                    project: this.id,
                    object_type: 'service',
                    date: currentDateWithFormat,
                });
                $('.simple-slick-carousel').slick({
                    infinite: true,
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    dots: true,
                    arrows: true,
                    autoplay: true,
                    autoplaySpeed: 2000,
                    responsive: [
                        {
                            breakpoint: 992,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2,
                            },
                        },
                        {
                            breakpoint: 769,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                            },
                        },
                    ],
                });
            } catch (error) {
                console.log(error);
            }
        },
    },
};
</script>
