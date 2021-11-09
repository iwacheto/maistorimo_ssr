<template>
    <div class="mobile-green-menu-small">
        <div class="relative-div">
            <div class="green-menu-small">
                <router-link :to="'/projects'">
                    <div class="mobile-menu-item">
                        <img src="/images/projects.svg" alt="projects">
                    </div>
                </router-link>
                <div class="menu-ver-line"></div>
                <div class="mobile-menu-item" @click="toggleAnalitycsMenu">
                    <img src="/images/analysis.svg" alt="analysis">
                </div>
                <div class="menu-ver-line"></div>
                <router-link :to="'/service'">
                    <div class="mobile-menu-item">
                        <img src="/images/services.svg" alt="services">
                    </div>
                </router-link>
            </div>

            <div id="menu-items" class="analitycs-menu" ref="menu_items" :class="{active: isActive}">
                <ul>
                    <li>
                        <router-link :to="'/projects_analitycs'">Анализи на проекти</router-link>
                    </li>
                    <li>
                        <router-link :to="'/services_analitycs'">Анализи на услуги</router-link>
                    </li>
                    <li>
                        <router-link :to="'/contacts_analitycs'">Анализи на контакти</router-link>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    mounted() {
        
    },
    data() {
        return {
            isActive: false,
        };
    },
    methods: {
        toggleAnalitycsMenu() {
            // this.isActive = !this.isActive;
            // console.log(this.isActive);
            let element = this.$refs.menu_items;
            element.classList.toggle("active");
        },
    }
};
</script>

<style scoped>
.mobile-green-menu-small {
    display: none;
}

@media screen and (max-width: 990px) {
    .mobile-green-menu-small {
        display: flex;
        flex-direction: column;
        justify-content: center;
        margin: 18px 0px 57px 0px;
    }
    .relative-div {
        position: relative;
    }

    .green-menu-small {
        background-color: #276955;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 57px;
        width: 245px;
        margin: 0px auto;
    }

    .mobile-menu-item img {
        width: 22px;
    }

    .green-menu-small a {
        margin: 14px 30px 15px 32px;
    }

    a {
        font-style: normal;
        font-weight: 500;
        font-size: 17px;
        line-height: 20px;
        color: #276955;
    }

    .green-menu-small .mobile-menu-item img {
        margin: 14px 27px 15px 27px;
        cursor: pointer;
    }

    .green-menu-small a .mobile-menu-item img {
        margin: 0px;
    }

    .menu-ver-line {
        width: 0px;
        height: 29px;
        border: 0.5px solid #fff;
    }

    .analitycs-menu {
        display: none;
    }

    .analitycs-menu.active {
        display: flex !important;
        position: absolute;
        top: 57px;
        left: 365px;
        z-index: 9;
    }

    .analitycs-menu {
        padding: 0px auto;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .analitycs-menu ul {
        background-color: #fff;
        list-style: none;
        width: 255px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 18px 0px;
        box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 12%);
        z-index: 20;
    }

    .analitycs-menu ul li:nth-child(2) {
        margin: 23px 0px 23px -15px;
    }
}

@media screen and (max-width: 720px) {

    .analitycs-menu.active {

        left: 230px;
    }
}

@media screen and (max-width: 560px) {

    .analitycs-menu.active {

        left: 152px;
    }
}

@media screen and (max-width: 414px) {

    .analitycs-menu.active {

        left: 79px;
    }
}

@media screen and (max-width: 380px) {

    .analitycs-menu.active {

        left: 62px;
    }
}

@media screen and (max-width: 360px) {

    .analitycs-menu.active {

        left: 50px;
    }
}

@media screen and (max-width: 320px) {

    .analitycs-menu.active {

        left: 32px;
    }
}
</style>
