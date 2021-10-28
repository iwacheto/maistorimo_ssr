<template>
  <div>
    <MobileGreenMenuSmall/>
    <!-- Listings -->
    <div class="col-lg-12 col-md-12 mobile">
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

    <div class="col-lg-12 col-md-12 desktop">
      <div class="col-lg-12">
        <h1>Анализ на проекти</h1>
        
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
          </div>

          <div class="col-lg-2">
            <button @click="filterData" class="button">
              Намери
            </button>
          </div>

          <div class="dashboard-list-box">  
            <ul class="analitycs_list">
              <li v-for="project in projects" :key="project.id">
                <div class="list-box-listing">
                  <div class="list-box-listing-img">
                    <img
                      :src="project.project_galleries[0] ? project.project_galleries[0].url : ''"
                      alt
                    />
                  </div>

                  <div class="count_analitycs">
                    <h3 class="contact_heading"> {{ project.title }} </h3>

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

  ul {
    border-top: 1px solid #CACACA;
  }

  ul li {
    flex: unset;
    min-height: 202px;
    margin: 16px 26px 16px 16px;
    padding: 16px 0px 16px 16px;
    background: #FFFFFF;
    border: 0.25px solid #9EA3BD;
    box-sizing: border-box;
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.25);
    border-radius: 14px;
  }

  ul li:hover {
    background-color: #ffffff;
  }

  ul li img {
    height: 169px;
    
  }

  .list-box-listing-img {
    flex: auto;
    max-width: 286px;
    height: 169px;
    border-radius: 14px;
  }

  .list-box-listing .count_analitycs {
    display: flex;
    flex-direction: column;
  }

  .inner.count_content {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
  }

  .inner.count_content p {
    font-style: normal;
    font-weight: 500;
    font-size: 20px;
    line-height: 23px;
    color: #FFFFFF;
  }

  .inner.count_content .count_analitycs {
    display: flex;
    flex-direction: row;
  }

  .dashboard-list-box {
    margin: 0px;
  }

  h3.contact_heading {
    margin: 32px 0px 30px 42px;
    font-style: normal;
    font-weight: bold;
    font-size: 25px;
    line-height: 29px;
    color: #276955;
  }

  .list-box-listing-content {
    display: flex;
    background: #276955;
    border: 0.25px solid #9EA3BD;
    box-sizing: border-box;
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.25);
    border-radius: 14px;
    height: 52px;
    margin-left: 31px;
    margin-right: 10px;
    color: #ffffff;
    max-width: 699px;
  }

  span.a_cnt {
    margin: -7px 87px 5px 10px;
    padding: 0px;
    font-style: normal;
    font-weight: bold;
    font-size: 27px;
    line-height: 32px;
    color: #FFFFFF;
  }

  @media screen and (max-width: 1330px) {
    .inner.count_content p {
      font-size: 17px;
    }

    span.a_cnt {
      margin-right: 70px;
      font-size: 23px;
    }
  }

  @media screen and (max-width: 1240px) {
    .count_analitycs {
        padding-left: 0px;
    }
    
    .inner.count_content p {
      font-size: 16px;
      margin-bottom: 23px;
    }

    span.a_cnt {
      font-size: 21px;
      margin: -7px 10px -3px 10px;
    }

    .inner.count_content .count_analitycs {
      display: flex;
      flex-direction: row;
      flex-wrap: wrap;
      align-content: center;
      align-items: flex-end;
    }

  }

  @media screen and (max-width: 1200px) {
    .inner.count_content p {
      margin-bottom: 5px;
    }
  }

  @media screen and (max-width: 1150px) {
    .inner.count_content p {
      font-size: 14px;
    }

    span.a_cnt {
      font-size: 18px;
    }
  }

  @media screen and (max-width: 1100px) {
    .list-box-listing-content {
      margin-left: 16px;
    }

    ul li {
      margin: 16px 10px 16px 16px;
    }

    .inner.count_content p {
      font-size: 12px;
    }

    span.a_cnt {
      font-size: 14px;
    }

    .list-box-listing-content {
      padding-left: 10px;
    }
  }
}



@media screen and (max-width: 990px) {
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

  /* .mx-input {
    margin: 0px 0px 0px 0px;
    box-shadow: unset;
  } */

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