<template>
    <div id="footer" class="sticky-footer">
        <!-- Main -->
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-6 footer_img">
                    <!-- <img class="footer-logo" src="/images/logo.png" alt />
                    <br />
                    <br /> -->
                    <!-- <i class="fa fa-long-arrow-right"></i> -->
                    <img src="/images/right-arrow-28px.png" alt="right arrow">
                    <p>
                        Майсторимо.БГ е платформа предоставяща на своите потребители съдържание и
                        възможност за пласиране на техните услуги
                    </p>
                </div>

                <div class="col-md-4 col-sm-6">
                    
                    <div class="arrow-and-h4">
                        <img src="/images/right-arrow-28px.png" alt="right arrow">
                        <h4>Полезни линкове</h4>
                    </div>
                    <ul class="footer-links">
                        <li @click="scrollTop">
                            <router-link tag="a" to="/general_terms">Общи условия</router-link>
                        </li>
                        <li @click="scrollTop">
                            <router-link tag="a" to="/private_protection"
                                >Политика за поверителност</router-link
                            >
                        </li>
                        <!-- <li>
                            <a href="/gdpr">GDPR</a>
                        </li> -->
                        <li @click="scrollTop">
                            <router-link tag="a" to="/contacts">Контакти</router-link>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="col-md-3 col-sm-12">
                    <div class="arrow-and-h4">
                        <img src="/images/right-arrow-28px.png" class="footer-img" alt="right arrow">
                        <h4>Свържете се с нас</h4>
                    </div>
                    <div class="text-widget">
                        <span>
                            <img src="/images/pin.png" class="footer-img" alt="address">
                            Плевен, Булевард Русе 19</span>
                        <span>
                            <img src="/images/phone.png" class="footer-img" alt="phone">
                            +359878735795</span>
                        <span>
                            <a href="#">
                                <img src="/images/email.png" class="footer-img" alt="facebook">
                                g.prusiyski@webrika.bg</a>
                        </span>
                        <span>
                            <a target="_blank" href="https://www.facebook.com/%D0%9C%D0%B0%D0%B9%D1%81%D1%82%D0%BE%D1%80%D0%B8%D0%BC%D0%BE-262442748017349">
                                <img src="/images/facebook.png" class="footer-img" alt="facebook">
                                Майсторимо
                            </a>
                        </span>
                    </div>

                    <!-- <ul class="social-icons margin-top-20">
                        <li>
                            <a
                                class="facebook"
                                target="_blank"
                                href="https://www.facebook.com/%D0%9C%D0%B0%D0%B9%D1%81%D1%82%D0%BE%D1%80%D0%B8%D0%BC%D0%BE-262442748017349"
                            >
                                <i class="icon-facebook"></i>Майсторимо
                            </a>
                        </li> -->
                        <!-- {{-- <li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
						<li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
                        <li><a class="vimeo" href="#"><i class="icon-vimeo"></i></a></li> --}}-->
                    <!-- </ul> -->
                </div>
            </div>

            <!-- Copyright -->
            <!-- <div class="row">
                <div class="col-md-12">
                    <div class="copyrights">© 2021 Maistorimo. All Rights Reserved.</div>
                </div>
            </div> -->
        </div>
    </div>
    <!-- Footer / End -->
</template>

<script>
import axios from 'axios';

export default {
    //     asyncData ({ params }) {
    //     return axios.get(`fetch-projects`)
    //       .then((res) => {
    //          this.$store.commit('SET_PROJECTS', items);
    //       })
    //   },
    mounted() {
        this.fetch();
    },
    methods: {
        async fetch() {
            // let items = await axios.get(`fetch-projects`).then(res => {
            //     return res.data;
            // });
            // this.$store.commit('SET_PROJECTS', items);
        },
        scrollTop() {
            console.log('tsv');
            window.scrollTo(0, 0);
        },
    },
};
</script>

<style scoped>

#footer {
    background-color: #324E5B;
    /* background-color: #276955; */
    color: #fff;
    padding-top: 40px;
    padding-bottom: 64px;
    z-index: 15;
}

.arrow-and-h4 {
    display: flex;
    align-items: center;
}

#footer h4 {
    color: #fff;
}

#footer .footer-links li::before {
    color: #EFCA4E;
}

.arrow-and-h4 img {
    margin-bottom: 14px;
    margin-right: 10px;
}

#footer .footer-links li {
    padding-bottom: 0px;
}

#footer .footer-links li a {
    color: #fff;
    padding-bottom: 0px;
}

#footer ul.footer-links {
    width: 100%;
}

ul li {
    margin-bottom: 0px;
}

.col-md-5 {
    width: 33%;
    margin-right: 65px;
}

.text-widget span {
    color: #fff;
    display: flex;
    align-items: center;
}

#footer a {
    color: #fff;
}

.footer-img {
    margin-right: 10px;
}

@media screen and (max-width: 1240px) { 
    #footer .container .row div {
        padding-left: 0px;
    }
}

@media screen and (max-width: 1000px) { 
    #footer .container {
        width: 100%;
    }

    #footer .col-md-5.col-sm-6.footer_img {
        width: 30%;
        padding-left: 5%;
        margin-right: 30px;
    }

    #footer .col-md-4.col-sm-6 {
        width: 30%;
        padding-left: 7%;
    }

    #footer .col-md-3.col-sm-12 {
        width: 29%;
        padding-left: 3%;
    }
}

@media screen and (max-width: 850px) {
    .col-md-5.col-sm-6.footer_img p {
        font-size: 13px;
    }

    .text-widget span{
        font-size: 15px;
    }

    #footer h4 {
        font-size: 19px;
    }
}

@media screen and (max-width: 786px) {
     #footer h4 {
        font-size: 18px;
    }

    .text-widget span{
        font-size: 14px;
    }
}

@media screen and (max-width: 767px) {
    #footer .row {
        display: flex;
        flex-direction: column;
        align-content: center;
        justify-content: center;
        align-items: center;
    }

    #footer .col-md-5.col-sm-6.footer_img {
        padding-left: 18px;
        width: 33%;
    }

    .col-md-5.col-sm-6.footer_img p {
        font-size: 16px;
    }

    #footer .col-md-4.col-sm-6 {
        width: 32%;
    }

    #footer .col-md-3.col-sm-12 {
        width: 33%;
    }
}

@media screen and (max-width: 640px) {
    #footer .col-md-5.col-sm-6.footer_img {
        width: 40%;
        margin: 0px auto;
        padding: 0px;
        text-align: unset;
    }


    #footer .col-md-5.col-sm-6.footer_img p {
        line-height: 21px;
    }

    #footer .col-md-4.col-sm-6 {
        width: 40%;
        margin: 0px auto;
    }

    #footer .col-md-3.col-sm-12 {
        width: 40%;
        margin: 0px auto;
    }
}

@media screen and (max-width: 540px) {
    #footer .col-md-5.col-sm-6.footer_img {
        width: 50%;
    }

    #footer .col-md-4.col-sm-6 {
        width: 50%;
    }

    #footer .col-md-3.col-sm-12 {
        width: 51%;
    }
}

@media only screen and (max-width: 380px) {
    div.col-md-4.col-sm-6, div.col-md-3.col-sm-12 {
        margin-left: 15px;
    }

    #footer .col-md-5.col-sm-6.footer_img {
        width: 60%;
    }

    #footer .col-md-4.col-sm-6 {
        width: 60%;
    }

    #footer .col-md-3.col-sm-12 {
        width: 60%;
    }
}

@media screen and (max-width: 320px) {
    #footer .col-md-5.col-sm-6.footer_img {
        width: 70%;
    }

    #footer .col-md-4.col-sm-6 {
        width: 70%;
    }

    #footer .col-md-3.col-sm-12 {
        width: 70%;
    }
}

</style>