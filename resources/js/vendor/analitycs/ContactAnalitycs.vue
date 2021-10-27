<template>
  <div>
    <MobileGreenMenuSmall/>
    <!-- Listings -->
    <div class="col-lg-12 col-md-12 mobile">

      <div class="col-lg-12">
        <h1>Анализ на контакти</h1>
        <span>Избери Дата</span>
        <div class="col-lg-5">
          <datepicker
            full-month-name="true"
            monday-first="true"
            wrapper-class="input-wrapper-class"
            :language="bg"
            placeholder="Начална дата"
            v-model="startDate"
            :format="format"
            @input="formatPicker()"
          ></datepicker>
        </div>

        <div class="col-lg-5">
          <datepicker
            full-month-name="true"
            monday-first="true"
            wrapper-class="input-wrapper-class"
            :language="bg"
            placeholder="Крайна дата"
            v-model="endDate"
            :format="format"
            @input="formatEndPicker"
          ></datepicker>
        </div>
        <div class="col-lg-2">
          <button @click="filterData" class="button">
            Намери
          </button>
        </div>
      </div>

      <div class="dashboard-list-box">
        <ul class="analitycs_list">
          <li>
            <div class="list-box-listing">

              <div class="list-box-listing-content">
                <div class="inner count_content">
                  
                  <div class="count_analitycs">
                    <div class="analitycs_icon">
                      <img src="/images/phone-icon.svg" alt="phone icon">
                    </div>
                    <p class="contact_heading">Телефон</p>
                  </div>

                  <div class="count_analitycs">
                    <p>Брой посещения: </p>
                    <p v-if="phone.length>0">
                      <span class="a_cnt">{{ calcStuff(phone, 'count') }}</span>
                    </p>
                    <p v-else class="no_records">0</p>
                  </div>

                  <div class="count_analitycs">
                    <p>Брой уникални песещения: </p>
                    <p v-if="phone.length>0">
                      <span class="a_cnt">{{ calcStuff(phone, 'unique_count') }}</span>
                    </p>
                    <p v-else class="no_records">0</p>
                  </div>
                  
                </div>
              </div>
            </div>
          </li>

          <li>
            <div class="list-box-listing">
              <div class="list-box-listing-content">
                <div class="inner count_content">
                  
                  <div class="count_analitycs">
                    <div class="analitycs_icon">
                      <img src="/images/globe-icon.svg" alt="globe icon">
                    </div>
                    <p class="contact_heading">Уебсайт</p>
                  </div>

                  <div class="count_analitycs">
                    <p>Брой песещения: </p>
                    <p v-if="website.length>0">
                      <span class="a_cnt">{{ calcStuff(website, 'count') }}</span>
                    </p>
                    <p v-else class="no_records">0</p>
                  </div>

                  <div class="count_analitycs">
                    <p>Брой уникални песещения: </p>
                    <p v-if="website.length>0">
                      <span class="a_cnt">{{ calcStuff(website, 'unique_count') }}</span>
                    </p>
                    <p v-else class="no_records">0</p>
                  </div>

                </div>
              </div>
            </div>
          </li>

          <li>
            <div class="list-box-listing">
              <div class="list-box-listing-content">
                <div class="inner count_content">
                  
                  <div class="count_analitycs">
                    <div class="analitycs_icon">
                      <img src="/images/mail-icon.svg" alt="mail icon">
                    </div>
                    <p class="contact_heading">Поща</p>
                  </div>

                  <div class="count_analitycs">
                    <p>Брой песещения: </p>
                    <p v-if="email.length>0">
                      <span class="a_cnt">{{ calcStuff(email, 'count') }}</span>
                    </p>
                    <p v-else class="no_records">0</p>
                  </div>

                  <div class="count_analitycs">
                    <p>Брой уникални песещения: </p>
                    <p v-if="email.length>0">
                      <span class="a_cnt">{{ calcStuff(email, 'unique_count') }}</span>
                    </p>
                    <p v-else class="no_records">0</p>
                  </div>

                </div>
              </div>
            </div>
          </li>

          <li>
            <div class="list-box-listing">
              <div class="list-box-listing-content">
                <div class="inner count_content">
                  <div class="count_analitycs">
                    
                    <div class="analitycs_icon">
                      <img src="/images/fb-icon.svg" alt="phone icon">
                    </div>
                    <p class="contact_heading">Фейсбук</p>
                  </div>

                  <div class="count_analitycs">
                    <p>Брой песещения: </p>
                    <p v-if="facebook.length>0">
                      <span class="a_cnt">{{ calcStuff(facebook, 'count') }}</span>
                    </p>
                    <p v-else class="no_records">0</p>
                  </div>

                  <div class="count_analitycs">
                    <p>Брой уникални песещения: </p>
                    <p v-if="facebook.length>0">
                      <span class="a_cnt">{{ calcStuff(facebook, 'unique_count') }}</span>
                    </p>
                    <p v-else class="no_records">0</p>
                  </div>

                </div>
              </div>
            </div>
          </li>
          <!-- Profile -->
          <li>
            <div class="list-box-listing">
              <div class="list-box-listing-content">
                <div class="inner count_content">
                  <div class="count_analitycs">
                    
                    <div class="analitycs_icon">
                      <img src="/images/profi-icon.svg" alt="profile icon">
                    </div>
                    <p class="contact_heading">Профил</p>
                  </div>
                  <div class="count_analitycs">
                    <p>Брой песещения: </p>
                    <p v-if="profile.length>0">
                      <span class="a_cnt">{{ calcStuff(profile, 'count') }}</span>
                    </p>
                    <p v-else class="no_records">0</p>
                  </div>

                  <div class="count_analitycs">
                    <p>Брой уникални песещения: </p>
                    <p v-if="profile.length>0">
                      <span class="a_cnt">{{ calcStuff(profile, 'unique_count') }}</span>
                    </p>
                    <p v-else class="no_records">0</p>
                  </div>

                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>




    <div class="col-lg-12 col-md-12 desktop">
      <div class="col-lg-12">
        <h1>Анализ на контакти</h1>

        <div class="main-items">
          <span>Избери Дата</span>
          <div class="datapicker-container">
            <div class="col-lg-5">
              <datepicker
                full-month-name="true"
                monday-first="true"
                wrapper-class="input-wrapper-class"
                :language="bg"
                placeholder="Начална дата"
                v-model="startDate"
                :format="format"
                @input="formatPicker()"
              ></datepicker>
            </div>

            <div class="col-lg-5">
              <datepicker
                full-month-name="true"
                monday-first="true"
                wrapper-class="input-wrapper-class"
                :language="bg"
                placeholder="Крайна дата"
                v-model="endDate"
                :format="format"
                @input="formatEndPicker"
              ></datepicker>
            </div>
          </div>

          <div class="col-lg-2">
            <button @click="filterData" class="button">
              Намери
            </button>
          </div>

          <div class="dashboard-list-box">
            <ul class="analitycs_list">
              <li>
                <div class="list-box-listing">
                  <div class="list-box-listing-content">
                    <div class="inner count_content">
                      <div class="analitycs_icon">
                        <img src="/images/phone-icon.svg" alt="phone icon">
                        <p class="contact_heading">Телефон</p>
                      </div>

                      <div class="count_analitycs">
                        <p>Брой посещения: </p>
                        <p v-if="phone.length>0">
                          <span class="a_cnt">{{ calcStuff(phone, 'count') }}</span>
                        </p>
                        <p v-else class="no_records">0</p>
                      
                        <p>Брой уникални песещения: </p>
                        <p v-if="phone.length>0">
                          <span class="a_cnt">{{ calcStuff(phone, 'unique_count') }}</span>
                        </p>
                        <p v-else class="no_records">0</p>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </li>

              <li>
                <div class="list-box-listing">
                  <div class="list-box-listing-content">
                    <div class="inner count_content">
                      <div class="analitycs_icon">
                        <img src="/images/globe-icon.svg" alt="globe icon">
                        <p class="contact_heading">Уебсайт</p>
                      </div>
                      
                      <div class="count_analitycs">
                        <p>Брой песещения: </p>
                        <p v-if="website.length>0">
                          <span class="a_cnt">{{ calcStuff(website, 'count') }}</span>
                        </p>
                        <p v-else class="no_records">0</p>
        
                        <p>Брой уникални песещения: </p>
                        <p v-if="website.length>0">
                          <span class="a_cnt">{{ calcStuff(website, 'unique_count') }}</span>
                        </p>
                        <p v-else class="no_records">0</p>
                      </div>
                    </div>
                  </div>
                </div>
              </li>

              <li>
                <div class="list-box-listing">
                  <div class="list-box-listing-content">
                    <div class="inner count_content">
                      <div class="analitycs_icon">
                        <img src="/images/mail-icon.svg" alt="mail icon">
                        <p class="contact_heading">Поща</p>
                      </div>
                      <div class="count_analitycs">
                        <p>Брой песещения: </p>
                        <p v-if="email.length>0">
                          <span class="a_cnt">{{ calcStuff(email, 'count') }}</span>
                        </p>
                        <p v-else class="no_records">0</p>

                        <p>Брой уникални песещения: </p>
                        <p v-if="email.length>0">
                          <span class="a_cnt">{{ calcStuff(email, 'unique_count') }}</span>
                        </p>
                        <p v-else class="no_records">0</p>
                      </div>
                    </div>
                  </div>
                </div>
              </li>

              <li>
                <div class="list-box-listing">
                  <div class="list-box-listing-content">
                    <div class="inner count_content">
                      <div class="analitycs_icon">
                        <img src="/images/fb-icon.svg" alt="phone icon">
                        <p class="contact_heading">Фейсбук</p>
                      </div>
                      <div class="count_analitycs">
                        <p>Брой песещения: </p>
                        <p v-if="facebook.length>0">
                          <span class="a_cnt">{{ calcStuff(facebook, 'count') }}</span>
                        </p>
                        <p v-else class="no_records">0</p>
          
                        <p>Брой уникални песещения: </p>
                        <p v-if="facebook.length>0">
                          <span class="a_cnt">{{ calcStuff(facebook, 'unique_count') }}</span>
                        </p>
                        <p v-else class="no_records">0</p>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <!-- Profile -->
              <li>
                <div class="list-box-listing">
                  <div class="list-box-listing-content">
                    <div class="inner count_content">
                      <div class="analitycs_icon">
                        <img src="/images/profi-icon.svg" alt="profile icon">
                        <p class="contact_heading">Профил</p>
                      </div>
                      <div class="count_analitycs">
                        <p>Брой песещения: </p>
                        <p v-if="profile.length>0">
                          <span class="a_cnt">{{ calcStuff(profile, 'count') }}</span>
                        </p>
                        <p v-else class="no_records">0</p>

                        <p>Брой уникални песещения: </p>
                        <p v-if="profile.length>0">
                          <span class="a_cnt">{{ calcStuff(profile, 'unique_count') }}</span>
                        </p>
                        <p v-else class="no_records">0</p>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Copyrights -->
    <Copyrights/>
  </div>
</template>

<script>
import Datepicker from "vuejs-datepicker";
import { analitycMixin } from "../mixins/analytic";
import MobileGreenMenuSmall from '../partials/MobileGreenMenuSmall.vue';
import {en, bg} from 'vuejs-datepicker/dist/locale'
import Copyrights from '../partials/Copyrights.vue';

export default {
  mixins: [analitycMixin],
  data() {
    return {
      phone: [],
      website: [],
      email: [],
      facebook: [],
      profile: [],
      faceCnt: "",
      en: en,
      bg: bg
    };
  },
  created() {
    this.getContacts();
  },
  methods: {
    getContacts() {
      window.axios.get("/vendor/service/contact_analytics").then(({ data }) => {
        // console.log(data);
        let contact = data;
        this.phone = contact.filter(item => item.type === "phone");
        this.website = contact.filter(item => item.type === "website");
        this.email = contact.filter(item => item.type === "email");
        this.facebook = contact.filter(item => item.type === "facebook");
        this.profile = contact.filter(item => item.type === "profile");
      });
    },
    async filterData() {
      try {
        const responce = await axios.post("/vendor/service/contact_filter", {
          start: this.formattedStartDate,
          end: this.formattedEndDate
        });
        let contact = responce.data;
        this.phone = contact.filter(item => item.type === "phone");
        this.website = contact.filter(item => item.type === "website");
        this.email = contact.filter(item => item.type === "email");
        this.facebook = contact.filter(item => item.type === "facebook");
        this.profile = contact.filter(item => item.type === "profile");
      } catch (err) {
        console.log(err);
      }
    }
  },
  watch: {
    facebook() {
      let count = [];
      this.facebook.forEach(item => {
        count.push(item.count);
      });
      let sum = count.reduce(function(count, b) {
        return count + b;
      }, 0);
      this.faceCnt = sum;
    }
  },
  computed: {},
  components: {
    Datepicker,
    MobileGreenMenuSmall,
    Copyrights
  }
};
</script>

<style scoped>

@media only screen and (min-width: 991px) {
  .col-lg-12.col-md-12.desktop {
    display: flex;
    flex-direction: column;
    background-color: #F7F7F7;
  }

  .col-lg-12.col-md-12.mobile {
    display: none;
  }

  h1 {
    font-style: normal;
    font-weight: 500;
    font-size: 25px;
    line-height: 29px;
    color: #276955;
    margin-bottom: 50px;
  }

  .main-items {
    display: flex;
    flex-direction: column;
    background-color: #ffffff;
    border: 0.25px solid #9EA3BD;
    box-sizing: border-box;
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.25);
    border-radius: 7px;
  }

  .main-items span {
    margin: 27px 0px 28px 35px;
    font-style: normal;
    font-weight: 500;
    font-size: 20px;
    line-height: 23px;
    color: #276955;
  }

  .datapicker-container {
    display: flex;
    flex-direction: row;
  }

  .col-lg-5 {
    width: 30%;
  }

  .vdp-datepicker {
    width: 100%;
  }

  button.button {
    margin: 8px 0px 29px 0px;
    background: #FFFFFF;
    border: 0.25px solid #939393;
    box-sizing: border-box;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
    border-radius: 30.5px;
    font-style: normal;
    font-weight: normal;
    font-size: 15px;
    line-height: 18px;
    color: #000000;
  }

  .list-box-listing {
    margin: 0px;
    padding: 0px;
  }

  .list-box-listing-content {
    padding-left: 0px;
    top: 0px;
  }

  ul {
    border-top: 1px solid #CACACA;
    padding: 15px 0px;
  }

  ul li {
    flex: unset;
    margin: 13px 26px 16px 16px;
    padding: 0px 0px 33px 23px;
    background: #FFFFFF;
    border: 0.25px solid #9EA3BD;
    box-sizing: border-box;
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.25);
    border-radius: 14px;
    max-height: 93px;
  }

  ul li:hover {
    background-color: #ffffff;
  }

  ul li img {
    height: 55px;
  }

  .inner.count_content {
    display: flex;
    flex-direction: row;
  }

  .analitycs_icon {
    display: flex;
    flex-direction: row;
    min-width: 288px;
  }

  .count_analitycs {
    display: flex;
    justify-content: space-evenly;
    background: #276955;
    border: 0.25px solid #9EA3BD;
    box-sizing: border-box;
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.25);
    border-radius: 14px;
    height: 60px;
    color: #ffffff;
    max-width: 80%;
    margin-right: 23px;
  }

  p.contact_heading {
    margin: 13px 69px 13px 34px;
    font-style: normal;
    font-weight: bold;
    font-size: 30px;
    line-height: 35px;
    color: #276955;
  }

  .count_analitycs p:nth-child(1), .count_analitycs p:nth-child(3) {
    margin: 14px 10px 14px 34px;
    font-style: normal;
    font-weight: 500;
    font-size: 20px;
    line-height: 23px;
    color: #FFFFFF;
  }

  span.a_cnt, p.no_records {
    color: #FFFFFF;
    margin: 14px 45px 14px 5px;
  }

  @media screen and (max-width: 1366px) {
    .count_analitycs p:nth-child(1), .count_analitycs p:nth-child(3) {
      font-size: 17px;
    }
  }

  @media screen and (max-width: 1280px) {
    .count_analitycs p:nth-child(1), .count_analitycs p:nth-child(3) {
      font-size: 15px;
      margin: 16px 10px 14px 12px;
    }
  }

  @media screen and (max-width: 1200px) {
    .list-box-listing-content .inner {
        top: 14px;
    }

    span.a_cnt, p.no_records {
      margin: 14px 20px 14px 5px;
    }
  }

  @media screen and (max-width: 1160px) {

    .analitycs_icon {
      min-width: 239px;
    }

    p.contact_heading {
      margin: 13px 20px 13px 34px;
    }

    .count_analitycs {
      padding-left: 5px;
    }

    .count_analitycs p:nth-child(1), .count_analitycs p:nth-child(3) {
      font-size: 14px;
      margin: 16px 10px 14px 6px;
    }

    span.a_cnt, p.no_records {
      margin: 14px 20px 14px 5px;
    }
  }

  @media screen and (max-width: 1065px) {
    .count_analitycs p:nth-child(1), .count_analitycs p:nth-child(3) {
      font-size: 12px;
    }

    span.a_cnt, p.no_records {
      margin: 15px 10px 14px 5px;
      font-size: 12px;
    }
  }
}



@media only screen and (max-width: 990px) {
  .col-lg-12.col-md-12.desktop {
    display: none;
  }

  .col-lg-12.col-md-12.mobile {
    display: flex;
  }

  .col-md-12.col-lg-12 {
    background-color: #F7F7F7;
    border-top-left-radius: 25px;
    border-top-right-radius: 25px;
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    align-content: center;
    justify-content: center;
    align-items: center;
  }

  h1 {
    font-weight: 500;
    font-size: 20px;
    line-height: 23px;
    color: #276955;
    padding-top: 23px;
    text-align: center;
    margin-bottom: 30px;
  }

  .col-lg-12 span {
    margin-left: 40px;
    margin-bottom: 5px;
  }

  .col-lg-12 .col-lg-5 {
    margin-left: 11px;
    margin-top: 5px;
  }

  .vdp-datepicker {
    width: 302px;
    margin-bottom: 11px;
  }

  .mx-input {
    margin: 0px 0px 0px 0px;
    box-shadow: unset;
  }

  .col-lg-2 button {
    margin-left: 12px;
    margin-top: 14px;
    width: 126px;
    background: #FFFFFF;
    border: 0.75px solid #939393;
    box-sizing: border-box;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
    border-radius: 30.5px;
    color: #000000;
    font-style: normal;
    font-weight: normal;
    font-size: 15px;
    line-height: 18px;
    z-index: 99;
  }

  .dashboard-list-box {
    box-shadow: unset;
  }

  .dashboard-list-box ul {
    background-color: #F7F7F7;
    border-radius: unset;
  }

  .dashboard-list-box ul li:hover {
    background-color: #F7F7F7;
    border-radius: unset;
  }

  .dashboard-list-box ul li {
    padding-top: 13px;
  }

  .dashboard-list-box ul li, .dashboard-list-box ul li:last-child {
    border-top: 1px solid #cacaca;
    margin-left: -68px;
    width: 155%;
  }
  
  .list-box-listing-content .inner {
    display: flex;
    flex-direction: column;
    align-content: center;
    justify-content: center;
  }

  .count_analitycs p {
    margin-bottom: 0px;
  }

  .no_records {
    margin-top: 0px;
    margin-left: 7px;
  }

  span.a_cnt {
    margin-top: 0px;
    margin-bottom: 0px;
    margin-left: 7px;
    font-size: 17px;
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 19px;
    color: #276955;
  }

  .analitycs_icon img {
    margin-right: 11px;
    margin-bottom: 12px;
  }

  .count_analitycs p {
    font-size: 17px;
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 19px;
    color: #276955;
  }

  .count_analitycs p.contact_heading {
    font-style: normal;
    font-weight: 600;
    font-size: 20px;
    line-height: 23px;
    color: #276955;
  }

  .col-md-12 {
    background-color: #F7F7F7;
  }

  .copyrights {
    background-color: #F7F7F7;
  }

  .input-wrapper-class {
    background: #FFFFFF;
    border: 0.75px solid #6BBF3F;
    box-sizing: border-box;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
    border-radius: 10px;
    height: 53px;
  }
}

@media (max-width: 530px) {
  .input-wrapper-class {
    height: 44px;
  }
}

@media (max-width: 380px) {
  .dashboard-list-box ul li, .dashboard-list-box ul li:last-child {
    border-top: 1px solid #cacaca;
    margin-left: -43px;
    width: 132%;
  }
}

</style>