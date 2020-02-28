<template>
    <div id="app">
        <FrontHeader />
        <router-view></router-view>
    </div>
</template>

<script>
import FrontHeader from './front/partials/Header';

export default {
    data() {
        return {};
    },
    components: {
        FrontHeader,
    },
};
</script>

<style scoped>
</style>