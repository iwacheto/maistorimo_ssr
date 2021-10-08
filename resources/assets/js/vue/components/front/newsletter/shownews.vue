<template>
    <div class="show-news">
        <div class="section-one">
            <!-- <img class="image-bg" src="../../../../../../../public/images/Group-308.png" alt="#" /> -->
            <img class="image-bg" src="/images/Group-308.png" alt="#" />
            <div class="bck-btn">
                <img src="/images/Group-136-green.svg" alt="" />
            </div>
            <div class="header">Lora ipsum dolor sit amet</div>
            <div class="under-header">consectetur adipiscing elit</div>
        </div>
        <div class="section-two">
            <div class="title-text">Consectetur adipiscing elit</div>
            <div class="paragraph">
                Donec tristique, magna eu commodo volutpat, purus felis varius sapien, id ultrices
                lacus turpis ac ex. In consectetur ligula sed tempus lacinia. Aliquam malesuada
                tellus eu blandit egestas. Nunc feugiat a massa et placerat. Phasellus tempus nulla
                nec ipsum condimentum, non condimentum libero tristique. Suspendisse ornare elit
                sodales sapien faucibus, vel finibus justo porta. Aliquam eget sagittis massa, eget
                luctus mi. Praesent justo eros, ornare sit amet leo sit amet, semper vehicula dui.
                Donec varius elementum odio, at sagittis orci fermentum vitae. In auctor malesuada
                massa et sagittis. Donec in justo at lacus feugiat vestibulum. Nunc porta ligula
                tortor, eget porttitor lacus commodo eget. Sed iaculis, ligula in efficitur
                vehicula, risus enim pulvinar libero, a euismod lorem nisl quis risus. Aliquam erat
                volutpat. Vestibulum pharetra scelerisque urna et rhoncus.
            </div>
        </div>
        <div class="section-three">
            <div class="relevant-projects">Релевантни проекти</div>
            <div class="news-images">
                <div class="slider-news">
                    <div class="slide-news" v-for="(news, index) in shownNews" :key="index">
                        <img class="slide" :src="news.image" alt="loading..." />
                    </div>
                </div>
            </div>
            <button class="all-projects">Виж всички проекти</button>
        </div>
        <div class="section-four">
            <div class="title-text">Consectetur adipiscing elit</div>
            <div class="paragraph">
                Donec tristique, magna eu commodo volutpat, purus felis varius sapien, id ultrices
                lacus turpis ac ex. In consectetur ligula sed tempus lacinia. Aliquam malesuada
                tellus eu blandit egestas. Nunc feugiat a massa et placerat. Phasellus tempus nulla
                nec ipsum condimentum, non condimentum libero tristique. Suspendisse ornare elit
                sodales sapien faucibus, vel finibus justo porta. Aliquam eget sagittis massa, eget
                luctus mi. Praesent justo eros, ornare sit amet leo sit amet, semper vehicula dui.
                Donec varius elementum odio, at sagittis orci fermentum vitae. In auctor malesuada
                massa et sagittis. Donec in justo at lacus feugiat vestibulum. Nunc porta ligula
                tortor, eget porttitor lacus commodo eget. Sed iaculis, ligula in efficitur
                vehicula, risus enim pulvinar libero, a euismod lorem nisl quis risus. Aliquam erat
                volutpat. Vestibulum pharetra scelerisque urna et rhoncus.
            </div>
        </div>
        <div class="section-five">
            <div class="relevant-projects">Релевантни услуги</div>
            <div class="news-images">
                <div class="slider-news">
                    <div class="slide-news" v-for="(service, index) in showServices" :key="index">
                        <img class="slide" :src="service.image" alt="loading..." />
                    </div>
                </div>
            </div>
            <button class="all-projects">Виж всички проекти</button>
        </div>
        <div class="section-six">
            <div class="paragraph-6">
                Do eros, ornare sit amet leo sit amet, semper vehicula dui. Donec varius elementum
                odio, at sagittis orci fermentum vitae. In auctor malesuada massa et sagittis. Donec
                in justo at lacus feugiat vestibulum. Nunc porta ligula tortor, eget porttitor lacus
                commodo eget. Sed iaculis, ligula in efficitur vehicula, risus enim pulvinar libero,
                a euismod lorem nisl quis risus. Aliquam erat volutpat. Vestibulum pharetra
                scelerisque urna et rhoncus. Nunc porta ligula tortor, eget porttitor lacus commodo
                eget. Sed iaculis, ligula in efficitur vehicula, risus enim pulvinar libero, a
                euismod lorem nisl quis risus. Aliquam erat volutpat. Vestibulum pharetra
                scelerisque urna et rhoncus.
            </div>
            <div class="section-six-slider-wrap">
                <div class="relevant-projects">Други новини</div>
                <div class="bottom-page-slider">
                    <div class="slider-actual" v-for="(other, index) in otherNews" :key="index">
                        <img class="bot-slide" :src="other.image" alt="loading..." />
                        <div class="title-slider">{{ other.title }}</div>
                        <div class="paragraph-slider">{{ other.info }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template> 

<script>
export default {
    data() {
        return {
            shownNews: [
                { id: 1, image: '/images/1-st-slider-item.png' },
                { id: 2, image: '/images/2-nd-slider-item.png' },
                { id: 3, image: '/images/3-rd-slider-item.png' },
                { id: 4, image: '/images/4-th-slider-item.png' },
                { id: 5, image: '/images/1-st-slider-item.png' },
                { id: 6, image: '/images/2-nd-slider-item.png' },
                { id: 7, image: '/images/3-rd-slider-item.png' },
                { id: 8, image: '/images/4-th-slider-item.png' },
            ],
            showServices: [
                { id: 1, image: '/images/second-slider-1.png' },
                { id: 2, image: '/images/second-slider-2.png' },
                { id: 3, image: '/images/second-slider-3.png' },
                { id: 4, image: '/images/second-slider-4.png' },
                { id: 5, image: '/images/second-slider-1.png' },
                { id: 6, image: '/images/second-slider-2.png' },
                { id: 7, image: '/images/second-slider-3.png' },
                { id: 8, image: '/images/second-slider-4.png' },
            ],
            otherNews: [
                {
                    id: 1,
                    image: '/images/last-slider-1.png',
                    title: 'Etiam vitae quam quam',
                    info: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis ',
                },
                {
                    id: 2,
                    image: '/images/last-slider-2.png',
                    title: 'Etiam vitae quam quam',
                    info: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis ',
                },
                {
                    id: 3,
                    image: '/images/last-slider-3.png',
                    title: 'Etiam vitae quam quam',
                    info: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis ',
                },
                {
                    id: 4,
                    image: '/images/last-slider-4.png',
                    title: 'Etiam vitae quam quam',
                    info: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis ',
                },
                {
                    id: 1,
                    image: '/images/last-slider-1.png',
                    title: 'Etiam vitae quam quam',
                    info: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis ',
                },
                {
                    id: 2,
                    image: '/images/last-slider-2.png',
                    title: 'Etiam vitae quam quam',
                    info: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis ',
                },
                {
                    id: 3,
                    image: '/images/last-slider-3.png',
                    title: 'Etiam vitae quam quam',
                    info: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis ',
                },
                {
                    id: 4,
                    image: '/images/last-slider-4.png',
                    title: 'Etiam vitae quam quam',
                    info: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis ',
                },
                {
                    id: 1,
                    image: '/images/last-slider-1.png',
                    title: 'Etiam vitae quam quam',
                    info: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis ',
                },
                {
                    id: 2,
                    image: '/images/last-slider-1.png',
                    title: 'Etiam vitae quam quam',
                    info: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis ',
                },
                {
                    id: 3,
                    image: '/images/last-slider-1.png',
                    title: 'Etiam vitae quam quam',
                    info: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis ',
                },
                {
                    id: 4,
                    image: '/images/last-slider-1.png',
                    title: 'Etiam vitae quam quam',
                    info: 'Mauris feugiat justo convallis ipsum ca. Proin volutpat, sapien quis ',
                },
            ],
        };
    },

    methods: {
        slickSlideF() {
            $('.slider-news').slick({
                slidesToShow: 4,
                slidesToScroll: 4,
                dots: false,
                infinite: true,
                autoplay: true,
                arrows: false,
                autoplaySpeed: 3000,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        },
                    },
                ],
            });
        },
        bigSlider() {
            $('.bottom-page-slider').slick({
                slidesToShow: 4,
                slidesToScroll: 4,
                rows: 2,
                dots: true,
                infinite: true,
                autoplay: true,
                arrows: false,
                autoplaySpeed: 3000,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        },
                    },
                ],
            });
        },
    },
    mounted() {
        this.slickSlideF();
        this.bigSlider();
    },
};
</script>

<style scoped>
.show-news {
    position: relative;
    overflow-x: hidden;
}

.section-one {
    position: relative;
}

.section-one .image-bg {
    width: 100%;
    /* position: absolute; */
}
.bck-btn {
    position: absolute;
    top: 3vh;
    left: 2vw;
    width: clamp(5rem, 9vw, 12rem);
    cursor: pointer;
}
.header {
    position: absolute;
    top: clamp(6rem, 25vw, 30vw);
    left: 10%;
    color: #ffffff;
    opacity: 1;
    font-size: clamp(2.5rem, 5vw, 7rem);
    font-weight: 900;
    font-family: 'Raleway';
}
.under-header {
    position: absolute;
    color: #ffffff;
    top: clamp(2rem, 33vw, 40vw);
    left: 10%;
    font-size: clamp(1.5rem, 4vw, 5rem);
    font-weight: 600;
    font-family: 'Raleway';
}
.section-two,
.section-four {
    text-align: start;
    width: clamp(75%, 70vw, 200rem);
    margin-left: 10%;
    color: #000000;
}
.title-text {
    margin: 3rem 0;
    font-weight: 600;
    font-size: clamp(1.5rem, 3vw, 4rem);
}
.paragraph {
    font-size: clamp(1.3rem, 2vw, 3rem);
    line-height: clamp(2.5rem, 3.2vw, 5rem);
}
.section-three {
    background: #e5e5e5;
    padding: 2rem 0;
}
.relevant-projects {
    text-align: center;
    color: #000000;
    font-size: clamp(1.2rem, 3.4vw, 2.7rem);
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 0.5rem;
}
.relevant-projects::after {
    content: '';
    width: 6rem;
    height: 1px;
    background: #f91942;
    margin: 1.5rem;
}

.all-projects {
    text-align: center;
    width: 23.5rem;
    height: 3rem;
    background: #f91942;
    color: #ffffff;
    font-size: 1.7rem;
    border: none;
    cursor: pointer;
    border-radius: 1.5rem;
    display: block;
    margin: 0 auto;
    margin-top: 2rem;
}

.section-five,
.section-six-slider-wrap {
    background: #e5e5e5;
    padding: 2rem 0;
}
.section-six-slider-wrap {
    padding-left: 1rem;
}
.slide {
    margin: 0 auto;
    cursor: pointer;
    border-radius: 0.5rem;
}
.paragraph-6 {
    text-align: start;
    width: clamp(75%, 70vw, 200rem);
    margin-left: 10%;
    color: #000000;
    font-size: clamp(1.3rem, 2vw, 3rem);
    line-height: clamp(2.5rem, 3.2vw, 5rem);
}
.slider-actual {
    display: block !important;
    width: 95% !important;
    margin-right: 0 auto;
}
.bot-slide {
    width: 100%;
    cursor: pointer;
    border-radius: 0.5rem;
}

.title-slider {
    font-size: 2.5rem;
    color: #000000;
    font-weight: 700;
    width: 90%;
    margin: 1rem auto;
}
.paragraph-slider {
    font-size: 2rem;
    font-weight: 300;
    margin-bottom: 3rem;
    width: 90%;
    margin: 1rem auto;
}
</style>