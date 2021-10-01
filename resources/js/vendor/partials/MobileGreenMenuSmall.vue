<template>
    <div class="mobile-green-menu-small">
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
    </div>
</template>

<style scoped>
.mobile-green-menu-small {
    display: none;
}

@media screen and (max-width: 990px) {
    .mobile-green-menu-small {
        display: flex;
        justify-content: center;
        margin: 18px 0px 32px 0px;
    }

    .green-menu-small {
        background-color: #276955;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 57px;
    }

    .mobile-menu-item img {
        width: 22px;
    }

    .green-menu-small a {
        margin: 14px 30px 15px 32px;
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
}
</style>