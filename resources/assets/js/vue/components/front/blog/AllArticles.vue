<template>
  <div class="container">
    <!-- Titlebar
    ==================================================-->
    <div id="titlebar" class="gradient">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2>Постове</h2>
            <span>Последни новини</span>

            <!-- Breadcrumbs -->
            <!-- <nav id="breadcrumbs">
              <ul>
                <li>
                  <a href="/">Home</a>
                </li>
                <li>
                  <a href="/blog">Blog</a>
                </li>
              </ul>
            </nav> -->
          </div>
        </div>
      </div>
    </div>

    <!-- Blog Posts -->
    <div class="blog-page">
      <div class="row">
        <div class="col-lg-9 col-md-8 padding-right-30">
          <!-- Blog Post -->
          <div class="blog-post" v-for="article in articles" :key="article.id">
            <!-- Img -->

            <router-link
              v-if="article.url_address"
              :to="'/blog/articles/'+ article.url_address + '/' + article.id"
              class="post-img"
            >
              <img :src="getMainImage(article.article_galleries)" alt />
            </router-link>
            <router-link v-else :to="'/blog/articles/' + article.id" class="post-img">
              <img :src="getMainImage(article.article_galleries)" alt />
            </router-link>

            <!-- Content -->
            <div class="post-content">
              <h3>
                 <router-link :to="'/blog/articles/' + article.id" tag="a">
                {{article.title}}
                 </router-link>
              </h3>

              <ul class="post-meta">
                <li> {{ article.created_at }} </li>
                
              </ul>

              <p v-html="article.less_content"></p>

              <router-link
                v-if="article.url_address"
                :to="'/blog/articles/'+ article.url_address + '/' + article.id"
                class="read-more"
              >
                Прочети повече
                <i class="fa fa-angle-right"></i>
              </router-link>
              <router-link v-else :to="'/blog/articles/' + article.id" class="read-more">
               Прочети повече
                <i class="fa fa-angle-right"></i>
              </router-link>
            </div>
          </div>
          <!-- Blog Post / End -->

          <!-- Pagination -->
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12">
              <!-- Pagination -->
              <PaginationComponent
                v-if="pagination.last_page > 1"
                :pagination="pagination"
                :offset="5"
                @paginate="getAllArticles()"
              ></PaginationComponent>
              <!--<div class="pagination-container margin-bottom-40">-->
              <!--<nav class="pagination">-->
              <!--<ul>-->
              <!--<li><a href="#" class="current-page">1</a></li>-->
              <!--<li><a href="#">2</a></li>-->
              <!--<li><a href="#">3</a></li>-->
              <!--<li><a href="#"><i class="sl sl-icon-arrow-right"></i></a></li>-->
              <!--</ul>-->
              <!--</nav>-->
              <!--</div>-->
            </div>
          </div>
          <!-- Pagination / End -->
        </div>
        <!-- Blog Posts / End -->
        <!-- Widgets -->
        <div class="col-lg-3 col-md-4">
          <div class="sidebar right">
            <!-- Widget -->
            <div class="widget margin-top-40">
              <h3>Популярни постове</h3>
              <ul class="widget-tabs">
                <!-- Post #1 -->
                <li v-for="lastArticle in lastAddedArticles" :key="lastArticle.id">
                  <div class="widget-content">
                    <div class="widget-thumb">
                      <router-link
                        v-if="lastArticle.url_address"
                        :to="'/blog/articles/'+ lastArticle.url_address + '/' + lastArticle.id"
                        class="post-img"
                      >
                        <img :src="getMainImage(lastArticle.article_galleries)" alt />
                      </router-link>
                      <router-link v-else :to="'/blog/articles/' + lastArticle.id" class="post-img">
                        <img :src="getMainImage(lastArticle.article_galleries)" alt />
                      </router-link>
                    </div>

                    <div class="widget-text">
                      <h5>
                        <router-link
                          v-if="lastArticle.url_address"
                          :to="'/blog/articles/'+ lastArticle.url_address + '/' + lastArticle.id"
                          class="post-img"
                        >{{ lastArticle.title}}</router-link>
                        <router-link
                          v-else
                          :to="'/blog/articles/' + lastArticle.id"
                          class="post-img"
                        >{{ lastArticle.title}}</router-link>
                      </h5>
                      <span> {{ lastArticle.created_at }} </span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </li>

                <!--&lt;!&ndash; Post #2 &ndash;&gt;-->
                <!--<li>-->
                <!--<div class="widget-content">-->
                <!--<div class="widget-thumb">-->
                <!--<a href="pages-blog-post.html"><img src="images/blog-widget-02.jpg" alt=""></a>-->
                <!--</div>-->

                <!--<div class="widget-text">-->
                <!--<h5><a href="pages-blog-post.html">The 50 Greatest Street Arts In London</a>-->
                <!--</h5>-->
                <!--<span>November 9, 2016</span>-->
                <!--</div>-->
                <!--<div class="clearfix"></div>-->
                <!--</div>-->
                <!--</li>-->

                <!--&lt;!&ndash; Post #3 &ndash;&gt;-->
                <!--<li>-->
                <!--<div class="widget-content">-->
                <!--<div class="widget-thumb">-->
                <!--<a href="pages-blog-post.html"><img src="images/blog-widget-01.jpg" alt=""></a>-->
                <!--</div>-->

                <!--<div class="widget-text">-->
                <!--<h5><a href="pages-blog-post.html">The Best Cofee Shops In Sydney-->
                <!--Neighborhoods</a></h5>-->
                <!--<span>November 12, 2016</span>-->
                <!--</div>-->
                <!--<div class="clearfix"></div>-->
                <!--</div>-->
                <!--</li>-->
              </ul>
            </div>
            <!-- Widget / End-->

            <!-- Widget -->

            <!-- <div class="widget margin-top-40">
              <h3 class="margin-bottom-25">Social</h3>
              <ul class="social-icons rounded">
                <li>
                  <a class="facebook" href="#">
                    <i class="icon-facebook"></i>
                  </a>
                </li>
                <li>
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
                </li>
              </ul>
            </div> -->

            <!-- Widget / End-->

            <div class="clearfix"></div>
            <div class="margin-bottom-40"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import PaginationComponent from "../partials/PaginationComponent";

export default {
  name: "AllArticles",

  data() {
    return {
      articles: [],
      lastAddedArticles: [],
      pagination: {
        current_page: 1
      }
    };
  },
  mounted() {
    this.getAllArticles();
    this.getLatestArticles();
  },
  methods: {
    getMainImage(gallery) {
      let mainImage = gallery.filter((image, index) => {
        return image.main == 1;
      });
      return mainImage[0]["url"];
    },
    async getAllArticles() {
      try {
        const res = await axios.get(
          "/blog/articles?page=" + this.pagination.current_page
        );

        this.articles = res.data.data.data;
        console.log(this.articles);
        this.pagination = res.data.pagination;
      } catch (error) {
        console.log(error);
      }
    },
    async getLatestArticles() {
      try {
        const res = await axios.get("/blog/articles/latest");
        this.lastAddedArticles = res.data;
      } catch (error) {
        console.log(error);
      }
    },
    scrollToTop() {
      window.scrollTo(0, 0);
    }
  },
  components: {
    PaginationComponent
  }
};
</script>

<style scoped>
@media screen and (max-width: 450px) {
  #titlebar > .container {
    margin-top: 35px;
  }
  .social-icons {
    display: flex;
    justify-content: space-around;
  }
}
</style>