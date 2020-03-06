<template>
    <div>
        <!-- Listings -->
        <div class="col-lg-12 col-md-12">
            <div id="titlebar">
                <h3 class="comp_an_heading">Избери Дата</h3>
            </div>
            <div class="col-lg-12">
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
                    <li v-for="project in projects" :key="project.id">
                        <div class="list-box-listing">
                            <div class="list-box-listing-img">
                                <img
                                    :src="project.project_galleries[0] ? project.project_galleries[0].url : ''"
                                    alt
                                />
                            </div>
                            <div class="list-box-listing-content">
                                <div class="inner count_content">
                                    <div class="count_analitycs">
                                        <h3 class="contact_heading">{{ project.title }}</h3>
                                    </div>
                                    <div class="count_analitycs">
                                        <h3>Брой</h3>
                                        <p v-if="project.records.length>0">
                                            <span
                                                class="a_cnt"
                                            >{{ calcStuff(project.records, 'count') }}</span>
                                            <!-- <span v-for="cnt in project.records" :key="cnt.id">{{ cnt.count }}</span> -->
                                        </p>
                                        <span v-else class="a_cnt">0</span>
                                    </div>
                                    <div class="count_analitycs">
                                        <h3>Уникален брой</h3>
                                        <p v-if="project.records.length>0">
                                            <span
                                                class="a_cnt"
                                            >{{ calcStuff(project.records, 'unique_count') }}</span>
                                            <!-- <span v-for="cnt in project.records" :key="cnt.id">{{ cnt.unique_count }}</span> -->
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
import Datepicker from 'vuejs-datepicker';
import { analitycMixin } from '../mixins/analytic';
import axios from 'axios';

export default {
    mixins: [analitycMixin],
    data() {
        return {
            projects: {},
        };
    },
    created() {
        this.getProjects();
    },
    methods: {
        getProjects(event) {
           axios.get('/vendor/projects/analytics').then(({ data }) => {
                this.projects = data;
                // console.log(this.projects)
            });
        },
        async filterData() {
            try {
                const responce = await axios.post('vendor/projects/filter_analitycs', {
                    start: this.formattedStartDate,
                    end: this.formattedEndDate,
                });
                this.projects = responce.data;
            } catch (err) {
                console.log(err);
            }
        },
    },
    components: {
        Datepicker,
    },
};
</script>

<style>
</style>