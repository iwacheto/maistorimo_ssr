<template>
  <div>
    <MobileGreenMenuSmall/>
    <!-- Listings -->
    <div class="col-lg-12 col-md-12">

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

    <!-- Copyrights -->
    <div class="col-md-12">
        <div class="copyrights">© 2019 Maistorimo LTD. All Rights Reserved.</div>
    </div>
  </div>
</template>

<script>
import Datepicker from "vuejs-datepicker";
import { analitycMixin } from "../mixins/analytic";
import MobileGreenMenuSmall from '../partials/MobileGreenMenuSmall.vue';
import {en, bg} from 'vuejs-datepicker/dist/locale'

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
    MobileGreenMenuSmall
  }
};
</script>

<style scoped>
.sl,
.fa,
.im {
  font-size: 30px;
  margin-right: 20px;
  color: #42b983;
}
.fa.a_filter {
  font-size: 15px;
  margin-right: 0;
  color: #fff;
}
.no_records{
  margin-left: 15px;
  margin-top: 3px;
}

@media (max-width: 990px) {
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