<template>
    <div id="app">
        <FrontHeader />
        <router-view></router-view>
        <Footer />
    </div>
</template>

<script> 

import FrontHeader from './front/partials/Header';
import Footer from './front/partials/Footer';

export default {
    data() {
        return {};
    },
    components: {
        FrontHeader,
        Footer,
    },
};
</script>

<style scoped>
</style>