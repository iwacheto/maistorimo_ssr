<template>
  <div>
    <!-- Listings -->
    <div class="col-lg-12 col-md-12">
      <div class="col-lg-12">
        <h3 class="comp_an_heading">Избери Дата</h3>
        <div class="col-lg-5">
          <datepicker
            placeholder="Начална дата"
            v-model="startDate"
            :format="format"
            @input="formatPicker()"
          ></datepicker>
        </div>

        <div class="col-lg-5">
          <datepicker
            placeholder="Крайна дата"
            v-model="endDate"
            :format="format"
            @input="formatEndPicker"
          ></datepicker>
        </div>
        <div class="col-lg-2">
          <button @click="filterData" class="button">
            Намери
            <i class="fa a_filter fa-arrow-circle-right"></i>
          </button>
        </div>
      </div>
      <div class="dashboard-list-box margin-top-25">
        <h4>Анализи за проекта</h4>
        <ul class="analitycs_list">
          <li>
            <div class="list-box-listing">
              <div class="list-box-listing-content">
                <div class="inner count_content">
                  <div class="count_analitycs">
                    <div class="analitycs_icon">
                      <i class="sl sl-icon-phone"></i>
                    </div>
                    <h3 class="contact_heading">Телефон</h3>
                  </div>
                  <div class="count_analitycs">
                    <h3>Брой</h3>
                    <p v-if="phone.length>0">
                      <span class="a_cnt">{{ calcStuff(phone, 'count') }}</span>
                    </p>
                    <p v-else class="no_records">0</p>
                  </div>
                  <div class="count_analitycs">
                    <h3>Уникален брой</h3>
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
                      <i class="sl sl-icon-globe"></i>
                    </div>
                    <h3 class="contact_heading">Уебсайт</h3>
                  </div>
                  <div class="count_analitycs">
                    <h3>Брой</h3>
                    <p v-if="website.length>0">
                      <span class="a_cnt">{{ calcStuff(website, 'count') }}</span>
                    </p>
                    <p v-else class="no_records">0</p>
                  </div>
                  <div class="count_analitycs">
                    <h3>Уникален брой</h3>
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
                      <i class="fa fa-envelope-o"></i>
                    </div>
                    <h3 class="contact_heading">Поща</h3>
                  </div>
                  <div class="count_analitycs">
                    <h3>Брой</h3>
                    <p v-if="email.length>0">
                      <span class="a_cnt">{{ calcStuff(email, 'count') }}</span>
                    </p>
                    <p v-else class="no_records">0</p>
                  </div>
                  <div class="count_analitycs">
                    <h3>Уникален брой</h3>
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
                      <i class="fa fa-facebook-square"></i>
                    </div>
                    <h3 class="contact_heading">Фейсбук</h3>
                  </div>
                  <div class="count_analitycs">
                    <h3>Брой</h3>
                    <p v-if="facebook.length>0">
                      <span class="a_cnt">{{ calcStuff(facebook, 'count') }}</span>
                    </p>
                    <p v-else class="no_records">0</p>
                  </div>
                  <div class="count_analitycs">
                    <h3>Уникален брой</h3>
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
                      <i class="im im-icon-Administrator"></i>
                    </div>
                    <h3 class="contact_heading">Профил</h3>
                  </div>
                  <div class="count_analitycs">
                    <h3>Брой</h3>
                    <p v-if="profile.length>0">
                      <span class="a_cnt">{{ calcStuff(profile, 'count') }}</span>
                    </p>
                    <p v-else class="no_records">0</p>
                  </div>
                  <div class="count_analitycs">
                    <h3>Уникален брой</h3>
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
</template>

<script>
import Datepicker from "vuejs-datepicker";
import { analitycMixin } from "../mixins/analytic";

export default {
  mixins: [analitycMixin],
  data() {
    return {
      phone: [],
      website: [],
      email: [],
      facebook: [],
      profile: [],
      faceCnt: ""
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
    Datepicker
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
</style>