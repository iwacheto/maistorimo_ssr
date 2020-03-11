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
            <i class="fa fa-arrow-circle-right"></i>
          </button>
        </div>
      </div>
      <div class="dashboard-list-box margin-top-25">
        <h4>Анализи за проекта</h4>
        <ul class="analitycs_list">
          <li v-for="service in services" :key="service.id">
            <div class="list-box-listing">
              <div class="list-box-listing-img">
                 <img :src="service.image_url ? service.image_url : ''" alt />
              </div>
              <div class="list-box-listing-content">
                <div class="inner count_content">
                  <div class="count_analitycs">
                    <h3 class="contact_heading">{{ service.name }} </h3>
                  </div>
                  <div class="count_analitycs">
                    <h3>Брой</h3>
                    <p v-if="service.records.length>0">
                      <span class="a_cnt">{{ calcStuff(service.records, 'count') }}</span>
                    </p>
                    <span v-else class="a_cnt">0</span>
                  </div>
                  <div class="count_analitycs">
                    <h3>Уникален брой</h3>
                    <p v-if="service.records.length>0">
                      <span class="a_cnt">{{ calcStuff(service.records, 'unique_count') }}</span>
                    </p>
                    <span v-else class="a_cnt">0</span>
                  </div>
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
  </div>
</template>

<script>
import Datepicker from "vuejs-datepicker";
import { analitycMixin } from "../mixins/analytic";

export default {
  mixins: [analitycMixin],
  data() {
    return {
      services: {}
    };
  },
  created() {
    this.getServices();
  },
  methods: {
    getServices() {
      window.axios.get("/vendor/service/analytics").then(({ data }) => {
        this.services = data;
      });
    },
   async filterData() {
        try{
          const responce= await axios.post('vendor/service/filter_analytics', {
              start:this.formattedStartDate,
              end:this.formattedEndDate
          });
          this.services=responce.data;
        } catch(err){
          console.log(err);
        }
    },
  },
  computed: {},
  components: {
    Datepicker
  }
};
</script>

<style>
</style>