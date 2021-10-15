<template>
    <div class="newsletter-wrapper">
        <div class="page-image">
            <div class="page-image-wrapper">
                <img class="desktop-img" src="/images/newsletter-home.png" alt="">
                <img class="mobile-img" src="/images/newsletter-home-mobile.png" alt="">
                <div class="green-layer"></div>
                <div class="back-btn">
                    <img src="/images/back-btn.svg" alt="">
                </div>
            </div>
        </div>
        <div class="most-watched-news">
            <div class="most-watched-news-title">Най-гледани новини</div>
            <div class="slider-news">
                <div class="news-slide" v-for="article in articles" :key="article.id">
                    <div class="article-wrapper" @click="openArticle(article.id)">
                        <div class="slide-image"><img :src="article.img" alt=""></div>
                        <div class="slide-title">{{article.title}}</div>
                        <div class="slide-description">{{article.description}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="news-list">
            <div class="news-list-title">Списък с новини</div>
            <div class="slider-news-2">
                <div class="news-slide" v-for="article in articles_2" :key="article.id">
                    <div class="article-wrapper" @click="openArticle(article.id)">
                        <div class="slide-image"><img :src="article.img" alt=""></div>
                        <div class="slide-title">{{article.title}}</div>
                        <div class="slide-description">{{article.description}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            articles: [
                {
                    id: 1,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 1',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 1'
                },
                {
                    id: 2,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 2',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 2'
                },
                {
                    id: 3,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 3',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 3'
                },
                {
                    id: 4,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 4',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 4'
                },
                {
                    id: 5,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 5',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 5'
                },
                {
                    id: 6,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 6',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 6'
                },
                {
                    id: 7,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 7',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 7'
                },
                {
                    id: 8,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 8',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 8'
                }
            ],
            articles_2: [
                {
                    id: 1,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 1',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 1'
                },
                {
                    id: 2,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 2',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 2'
                },
                {
                    id: 3,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 3',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 3'
                },
                {
                    id: 4,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 4',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 4'
                },
                {
                    id: 5,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 5',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 5'
                },
                {
                    id: 6,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 6',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 6'
                },
                {
                    id: 7,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 7',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 7'
                },
                {
                    id: 8,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 8',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 8'
                },
                {
                    id: 9,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 9',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 9'
                },
                {
                    id: 10,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 10',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 10'
                },
                {
                    id: 11,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 11',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 11'
                },
                {
                    id: 12,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 12',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 12'
                },
                {
                    id: 13,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 13',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 13'
                },
                {
                    id: 14,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 14',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 14'
                },
                {
                    id: 15,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 15',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 15'
                },
                {
                    id: 16,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 16',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 16'
                },
                {
                    id: 17,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 17',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 17'
                },
                {
                    id: 18,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 18',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 18'
                },
                {
                    id: 19,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 19',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 19'
                },
                {
                    id: 20,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 20',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 20'
                },
                {
                    id: 21,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 21',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 21'
                },
                {
                    id: 22,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 22',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 22'
                },
                {
                    id: 23,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 23',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 23'
                },
                {
                    id: 24,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 24',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 24'
                },
                {
                    id: 25,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 25',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 25'
                },
                {
                    id: 26,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 26',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 26'
                },
                {
                    id: 27,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 27',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 27'
                },
                {
                    id: 28,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 28',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 28'
                },
                {
                    id: 29,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 29',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 29'
                },
                {
                    id: 30,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 30',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 30'
                },
                {
                    id: 31,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 31',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 31'
                },
                {
                    id: 32,
                    img: '/images/slider-img1.png',
                    title: 'Etiam vitae quam quam 32',
                    description: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis 32'
                }
            ]
        }
    },
    methods: {
        sliderFunc(){
            $(".slider-news").slick({
                infinite: true,
                slidesToShow: 2,
                slidesToScroll: 2,
                dots: true,
                arrows: false,
                rows: 2,
                autoplay: true,
                draggable:true,
                autoplaySpeed: 2500,
                responsive: [
                  {
                    breakpoint: 768,
                    settings: {
                      slidesToShow: 1,
                      slidesToScroll: 1           
                    }
                  }
                ]        
            });
        },
        sliderFunc2(){
            $(".slider-news-2").slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 4,
                dots: true,
                arrows: false,
                rows: 2,
                autoplay: true,
                draggable:true,
                autoplaySpeed: 2500,
                responsive: [
                  {
                    breakpoint: 1024,
                    settings: {
                      slidesToShow: 3,
                      slidesToScroll: 3           
                    }
                  },
                  {
                    breakpoint: 768,
                    settings: {
                      slidesToShow: 2,
                      slidesToScroll: 2           
                    }
                  },
                  {
                    breakpoint: 540,
                    settings: {
                      rows: 4,
                      slidesToShow: 1,
                      slidesToScroll: 1           
                    }
                  }
                ]        
            });
        },
        openArticle(id){
            this.$router.push("/newsletter/" + id);
        }
    },
    mounted(){
        this.sliderFunc();
        this.sliderFunc2();
    }
}
</script>

<style lang="scss" scoped>

.newsletter-wrapper{
.page-image{
    .page-image-wrapper{
        width: 100%;
        position: relative;

        img{
            width: 100%;
        }

        .mobile-img{
            display: none;

            @media only screen and (max-width: 767px){
                display: unset;
            }
        }

        .desktop-img{
            @media only screen and (max-width: 767px){
                display: none;
            }
        }

        .green-layer{
            position: absolute;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            background: rgba(39, 105, 85, 0.6);
            z-index: 2;
        }

        .back-btn{
            cursor: pointer;
            position: absolute;
            left: 2%;
            top: 10%;
            width: 70px;
            z-index: 3;

            img{
                width: 100%;
            }
        }
    }
}

.most-watched-news{
    padding: 0 8%;
    padding-top: 40px;

    @media only screen and (max-width: 767px){
        padding-left: 0;
        padding-right: 0;
    }

    .most-watched-news-title{
        font-size: 30px;
        font-weight: 600;
        text-align: center;
        color: #000000 !important;
        margin-bottom: 70px;
        position: relative;

        &::after{
            content: "";
            position: absolute;
            display: block;
            width: 60px;
            height: 2px;
            background: #F91942;
            bottom: -20px;
            right: 50%;
            transform: translate(50%, -50%);
        }
    }

    .slider-news{
        .news-slide{
            display: block !important;
            width: 95% !important;
            margin: 0 auto;

            .article-wrapper{
                cursor: pointer;
            }

            .slide-image{
                width: 100%;

                img{
                    width: 100%;
                    border-radius: 5px;
                }
            }

            .slide-title{
               font-size: 25px;
               font-weight: bold;
               color: #000000;
               width: 90%;
               margin: 10px auto;
            }

            .slide-description{
                font-size: 20px;
                color: #898989;
                font-weight: 300;
                width: 90%;
                margin: 15px auto 25px auto;
            }
        }
    }
}

.news-list{
    background: #F8F8F8;
    padding-top: 40px;
    padding-bottom: 20px;

    @media only screen and (max-width: 539px){
        padding-left: 8%;
        padding-right: 8%;
    }

    .news-list-title{
        font-size: 27px;
        text-align: center;
        color: #000000 !important;
        margin-bottom: 70px;
        position: relative;

        &::after{
            content: "";
            position: absolute;
            display: block;
            width: 60px;
            height: 2px;
            background: #F91942;
            bottom: -20px;
            right: 50%;
            transform: translate(50%, -50%);
        }
    }

    .slider-news-2{
        .news-slide{
            display: block !important;
            width: 95% !important;
            margin: 0 auto;

            .article-wrapper{
                cursor: pointer;
            }

            .slide-image{
                width: 100%;

                img{
                    width: 100%;
                    border-radius: 5px;
                }
            }
 
            .slide-title{
               font-size: 25px;
               font-weight: bold;
               color: #000000;
               width: 90%;
               margin: 10px auto;
            }

            .slide-description{
                font-size: 20px;
                color: #898989;
                font-weight: 300;
                width: 90%;
                margin: 15px auto 25px auto;
            }
        }
    }
}
}

</style>