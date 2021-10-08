<template>
  <div>
    <MobileGreenMenuSmall/>
    <!-- Listings -->
    <div class="col-lg-12 col-md-12">
      <div class="col-lg-12">
        <h1>Анализ на проекти</h1>
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
            input-class="mx-input"
            
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
            input-class="mx-input"
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
          <li v-for="project in projects" :key="project.id">
            <div class="list-box-listing">

              <div class="horizontal-line"></div>

              <div class="list-box-listing-img">
                <img
                  :src="project.project_galleries[0] ? project.project_galleries[0].url : ''"
                  alt
                />
              </div>

              <div class="count_analitycs">
                <h3 class="contact_heading"> {{ project.title }} </h3>
              </div>
            </div>

            <div class="list-box-listing-content">
              <div class="inner count_content">
                <div class="count_analitycs">
                  <p>Брой посещения: </p>
                  <p v-if="project.records.length>0">
                    <span class="a_cnt">{{ calcStuff(project.records, 'count') }}</span>
                    <!-- <span v-for="cnt in project.records" :key="cnt.id">{{ cnt.count }}</span> -->
                  </p>
                  <span v-else class="a_cnt">0</span>
                </div>
                <div class="count_analitycs">
                  <p>Брой уникални посещения: </p>
                  <p v-if="project.records.length>0">
                    <span class="a_cnt">{{ calcStuff(project.records, 'unique_count') }}</span>
                    <!-- <span v-for="cnt in project.records" :key="cnt.id">{{ cnt.unique_count }}</span> -->
                  </p>
                  <span v-else class="a_cnt">0</span>
                </div>
              </div>
            </div>
            <!-- <div class="buttons-to-right">
								<a href="#" class="button gray"><i class="sl sl-icon-note"></i> Edit</a>
								<a href="#" class="button gray"><i class="sl sl-icon-close"></i> Delete</a>
            </div>-->
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
      projects: {},
      en: en,
      bg: bg
    };
  },
  created() {
    this.getProjects();
  },
  methods: {
    getProjects(event) {
      window.axios.get("/vendor/projects/analytics").then(({ data }) => {

        this.projects = data;
        console.log(data)
      });
    },
    async filterData() {
        try{
          const responce= await axios.post('vendor/projects/filter_analitycs', {
              start:this.formattedStartDate,
              end:this.formattedEndDate
          });
          this.projects=responce.data;
        } catch(err){
          console.log(err);
        }
    },
  },
  components: {
    Datepicker,
    MobileGreenMenuSmall
  }
};
</script>

<style scoped>

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
    margin-top: 0px !important;
    box-shadow: unset;
  }

  .dashboard-list-box:hover {
    background-color: #F7F7F7;
  }

  .analitycs_list, .analitycs_list:hover li {
    background-color: #F7F7F7;
  }

  .dashboard-list-box ul li {
    padding-top: 0px;
    border-bottom: unset;
  }

  div.horizontal-line {
    border: unset !important;
    box-sizing: unset !important;
    box-shadow: unset !important;
    border-radius: unset !important;
    border: 0.5px solid rgba(0, 0, 0, 0.09) !important;
    margin: 22px auto 22px auto;
    width: 130%;
  }

  .list-box-listing {
    position: relative;
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    align-content: center;
    justify-content: center;
    align-items: center;
  }

  .list-box-listing-img {
    position: absolute;
    width: 303px;
    height: 148px;
    border-radius: 19px;
    max-width: unset;
    top: 50px;
    /* box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25); */
  }

  h3.contact_heading {
    z-index: 9;
    font-size: 12px;
  }

  .list-box-listing-content {
    margin-top: 149px;
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 19px;
    color: #276955;
    padding-left: 0px;
  }

  .list-box-listing-content .inner {
    display: flex;
    flex-direction: column;
  }

  .list-box-listing-content .inner p {
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 19px;
    color: #276955;
  }

  span.a_cnt {
    margin-left: 0px;
    margin-top: 0px;
  }

  .list-box-listing .count_analitycs {
    position: absolute;
    width: 253px;
    height: 39px;
    background-color: #ffffff;
    border: 2px solid #E8E6E6;
    border-radius: 0px 19.5px 0px 19px;
    top: 160px;
    right: 26px;
  }

  .count_analitycs h3 {
    font-style: normal;
    font-weight: 500;
    font-size: 12px;
    line-height: 14px;
    color: #276955;
    margin-top: 12px;
    background-color: #FFFFFF;
  }

  .count_analitycs span {
    margin-bottom: 0px;
    padding-left: 13px;
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

@media (max-width: 720px) {
  
}

@media (max-width: 687px) {
  
}

@media (max-width: 530px) {
  .input-wrapper-class {
    height: 44px;
  }
}

@media (max-width: 414px) {
  .col-md-12.col-lg-12 {
    background-color: #F7F7F7;
    border-top-left-radius: 25px;
    border-top-right-radius: 25px;
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
    margin-top: 0px !important;
    box-shadow: unset;
  }

  .dashboard-list-box:hover {
    background-color: #F7F7F7;
  }

  .analitycs_list, .analitycs_list:hover li {
    background-color: #F7F7F7;
  }

  .dashboard-list-box ul li {
    padding-top: 0px;
  }

  div.horizontal-line {
    border: unset !important;
    box-sizing: unset !important;
    box-shadow: unset !important;
    border-radius: unset !important;
    border: 0.5px solid rgba(0, 0, 0, 0.09) !important;
    margin: 22px auto 22px auto;
    width: 130%;
  }

  .list-box-listing {
    position: relative;
  }

  .list-box-listing-img {
    position: absolute;
    width: 303px;
    height: 148px;
    border-radius: 19px;
    /* box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25); */
  }

  h3.contact_heading {
    z-index: 9;
    font-size: 12px;
  }

  .list-box-listing-content {
    margin-top: 149px;
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 19px;
    color: #276955;
  }
  .list-box-listing .count_analitycs {
    position: absolute;
    width: 253px;
    height: 39px;
    background-color: #ffffff;
    border: 2px solid #E8E6E6;
    border-radius: 0px 19.5px 0px 19px;
    top: 160px;
    right: 26px;
  }

  .count_analitycs h3 {
    font-style: normal;
    font-weight: 500;
    font-size: 12px;
    line-height: 14px;
    color: #276955;
    margin-top: 12px;
    background-color: #FFFFFF;
  }

  span.a_cnt {
    margin-left: 0px;
    margin-top: 0px;
  }
}

@media (max-width: 380px) {
  .col-lg-12 .col-lg-5 {
    margin-left: 0px;
    margin-top: 5px;
  }

  .list-box-listing-img {
    max-width: unset;
  }
}

@media (max-width: 375px) {
  
}

@media (max-width: 360px) {

}

@media (max-width: 320px) {
  .col-lg-12.col-md-12 {
    padding-left: 0px;
    padding-right: 0px;
    padding: 0px 8px;
  }

  .vdp-datepicker {
    width: 245px;
  }

  .dashboard-list-box ul li {
    padding: 0px 0px;
  }


}
</style>