<template>
  <div>
    <!-- Content
    ==================================================-->
    <div id="article-container" class="container">
      <!-- Blog Posts -->
      <div class="blog-page">
        <div class="row">
          <!-- Post Content -->
          <div class="col-lg-9 col-md-8 padding-right-30">
            <!-- Blog Post -->
            <div class="blog-post single-post">
              <!-- Img -->
              <img class="post-img" :src="mainImage" alt />
              <div
                v-if="images"
                class="listing-slider-custom mfp-gallery-container margin-bottom-0"
              >
                <gallery :images="images" :index="index" @close="index = null"></gallery>
                <div
                  class="image"
                  v-for="(image, imageIndex) in images"
                  :key="imageIndex"
                  @click="index = imageIndex"
                  :style="{ backgroundImage: 'url(' + image + ')', width: '200px', height: '200px' }"
                ></div>
              </div>
              <!-- Content -->
              <div class="post-content">
                <h3>{{article.title}}</h3>

                <ul class="post-meta">
                  <li>{{article.created_at}}</li>
                </ul>

                <div v-html="article.content"></div>

                <!-- Share Buttons -->
                <ul class="share-buttons margin-top-40 margin-bottom-0">
                  <li>
                    <!-- <vue-goodshare-facebook
                      page_url="maistorimo.gpb/#/blog/articles/%D1%81%D1%82%D0%B0%D1%82%D0%B8%D1%8F/{article.id}"
                      title_social="Facebook"
                      has_counter
                      has_icon
                    ></vue-goodshare-facebook> -->
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
            </div>
            <!-- Blog Post / End -->
            <div class="clearfix"></div>
          </div>
          <!-- Content / End -->

          <!-- Widgets -->
          <div class="col-lg-3 col-md-4">
            <div class="sidebar right">
              <!-- Widget -->
              <div class="widget">
                <h3 class="margin-top-0 margin-bottom-25">Търсене</h3>
                <div class="search-blog-input">
                  <div class="input">
                    <input class="search-field" type="text" placeholder="Натисни и търси тук" value />
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <!-- Widget / End -->

              <!-- Widget -->
              <div class="widget margin-top-40">
                <h3>Имате някакви въпроси?</h3>
                <div class="info-box margin-bottom-10">
                  <p>Имате някакви въпроси? Чувстваийте се свободни да питате!</p>
                  <a href="pages-contact.html" class="button fullwidth margin-top-20">
                    <i class="fa fa-envelope-o"></i> Натисни линията
                  </a>
                </div>
              </div>
              <!-- Widget / End -->

              <!-- Widget -->
              <div class="widget margin-top-40">
                <h3>Популярни постове</h3>
                <ul class="widget-tabs">
                  <!-- Post #1 -->
                  <li v-for="categoryArticle in latestFromCategory" :key="categoryArticle.id">
                    <div class="widget-content">
                      <div class="widget-thumb">
                        <router-link
                          v-if="categoryArticle.url_address"
                          :to="'/blog/articles/'+ categoryArticle.url_address + '/' + categoryArticle.id"
                          class="post-img"
                        >
                          <img :src="getMainImage(categoryArticle.article_galleries)" alt />
                        </router-link>
                        <router-link
                          v-else
                          :to="'/blog/articles/' + categoryArticle.id"
                          class="post-img"
                        >
                          <img :src="getMainImage(categoryArticle.article_galleries)" alt />
                        </router-link>
                      </div>

                      <div class="widget-text">
                        <h5>
                          <router-link
                            v-if="categoryArticle.url_address"
                            :to="'/blog/articles/'+ categoryArticle.url_address + '/' + categoryArticle.id"
                            class="post-img"
                          >{{ categoryArticle.title}}</router-link>
                          <router-link
                            v-else
                            :to="'/blog/articles/' + categoryArticle.id"
                            class="post-img"
                          >{{ categoryArticle.title}}</router-link>
                        </h5>
                        <span>{{ categoryArticle.created_at }}</span>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                  </li>
                </ul>
              </div>
              <!-- Widget / End-->

              <!-- Widget -->
              <div class="widget margin-top-40">
                <h3 class="margin-bottom-25">Социални</h3>
                <ul class="social-icons rounded">
                  <!-- <li><a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u="><i class="icon-facebook"></i></a></li> -->
                  <li>
                    <a
                      class="facebook"
                      target="_blank"
                      :href="'https://www.facebook.com/sharer/sharer.php?u=maistorimo.gpb/blog/articles' + article.id"
                    >
                      <i class="icon-facebook"></i>
                    </a>
                  </li>
                  <!-- <li>
                    <a class="twitter" href="#">
                      <i class="icon-twitter"></i>
                    </a>
                  </li>
                  <li>
                    <a class="gplus" href="#">
                      <i class="icon-gplus"></i>
                    </a>
                  </li>
                  <li>
                    <a class="linkedin" href="#">
                      <i class="icon-linkedin"></i>
                    </a>
                  </li> -->
                </ul>
              </div>
              <!-- Widget / End-->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// import VueGoodshareFacebook from "vue-goodshare/src/providers/Facebook.vue";
import VueGallery from "vue-gallery";

export default {
  name: "Article",
  props: ["id", "url"],
  data() {
    return {
      article: {},
      index: null,
      images: [],
      mainImage: "",
      latestFromCategory: []
    };
  },
  mounted() {
    this.getArticle();
  },
  methods: {
    async getArticle() {
      try {
        const res = await axios.get("/blog/articles/" + this.id);
        this.article = res.data;
        this.images = res.data.article_galleries.map(image => image.url);
        let tags = [];
        for (var i in this.article.tags) {
          tags.push(this.article.tags[i].name);
        }
        this.getMainImage(this.article.article_galleries);

        this.getLatestFromCategory();
        // this.tags = createTags(tags, [{type: "length", rule: /[0-9]/}]);
      } catch (error) {
        console.log(error);
      }
    },
    async getLatestFromCategory() {
      try {
        const res = await axios.get(
          "/blog/articles/latest-from-category/" + this.article.blog_category_id
        );
        this.latestFromCategory = res.data;
      } catch (error) {
        console.log(error);
      }
    },
    getMainImage(gallery) {
      let mainImage = gallery.filter(image => {
        return image.main == 1;
      });
      return (this.mainImage = mainImage[0]["url"]);
    }
  },
  components: {
    // VueGoodshareFacebook,
    gallery: VueGallery
  }
};
</script>

<style scoped>
.container#article-container {
  margin-top: 120px !important;
}

.mfp-gallery-container {
  margin-top: 75px;
  display: flex;
  justify-content: center;
}

.image {
  float: left;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center center;
  border: 1px solid #ebebeb;
  margin: 5px;
}
</style>
