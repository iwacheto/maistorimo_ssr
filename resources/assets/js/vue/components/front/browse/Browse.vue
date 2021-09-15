<template>
  <div class="container margin-top-100">
    <div class="row nanogallery_container">
      <div id="nanogallery2">
        <!-- content of the gallery -->
        <a
          v-for="(item, index) in browseItems"
          :key="index"
          :data="'/#/project/details/6'"
          :href="item.mainImage"
          :data-ngthumb="item.mainImage"
        >{{ item.title }}</a>
      </div>
    </div>
    <!-- Listing Item / End -->
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      browseItems: [],
      //   galConfig: {thumbnailWidth:     '300 XS100 LA400 XL500',thumbnailHeight:    '200 XS80 LA250 XL350'},
      galConfig:
        "{thumbnailWidth:     '300 XS100 LA400 XL500',thumbnailHeight:    '200 XS80 LA250 XL350'}",
      //   galConfig:
      //     '{"thumbnailWidth":   "200","thumbnailHeight":  200,"itemsBaseURL":     "https://nanogallery2.nanostudio.org/samples/"} galleryMosaic :   [{ "c": 1, "r": 1, "w": 2, "h": 2 },{ "c": 3, "r": 1, "w": 1, "h": 1 },{ "c": 3, "r": 2, "w": 1, "h": 1 },{ "c": 1, "r": 3, "w": 1, "h": 1 },{ "c": 3, "r": 3, "w": 2, "h": 1 }]',
      galleryConfig: {
        thumbnailWidth: "200",
        thumbnailHeight: auto,
        itemsBaseURL: "https://nanogallery2.nanostudio.org/samples/"
      }
    };
  },
  mounted() {
    this.getBrowseItems();
  },
  watch: {
    browseItems: function() {}
  },
  methods: {
    async getBrowseItems() {
      try {
        let res = await axios.get("browse");
        this.browseItems = res.data;
        this.$forceUpdate();
        this.$nextTick(() => {
          //   var t = document.querySelectorAll("[data-nanogallery2]");
          jQuery("#nanogallery2").nanogallery2({
            // thumbnailWidth: "auto XS80 SM120",
            // thumbnailHeight: "200 XS80 SM120"
            thumbnailWidth: "auto",
            thumbnailHeight: 300

            // thumbnailHeight: "300 XS100 LA400 XL500",
            // thumbnailWidth: "200 XS80 LA250 XL350",
            // galleryMosaic: [
            //   { c: 1, r: 1, w: 2, h: 2 },
            //   { c: 3, r: 1, w: 1, h: 1 },
            //   { c: 3, r: 2, w: 1, h: 1 },
            //   { c: 1, r: 3, w: 1, h: 1 },
            //   { c: 3, r: 3, w: 2, h: 1 }
            // ]
          });
          // for (var i = 0; i < t.length; i++) {
          //   jQuery(t[i]).nanogallery2(jQuery(t[i]).data("nanogallery2"));
          // }
          if ($(window).width() < 550) {
            jQuery("#nanogallery2").nanogallery2({
            thumbnailWidth: "320",
            thumbnailHeight: auto,
              });
          } 
        });
      } catch (error) {
        console.log(error);
      }
    }
  }
};
</script>

<style scoped>
@media only screen and (max-width: 800px) {
  .nanogallery_container div#nanogallery2 {
    padding: 20px;
  }
  /* .nanogallery_container div#nanogallery2 div{
    flex-basis: 32%;
  } */
}
</style>

