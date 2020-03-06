<template>
    <div id="app">
        <Header />
        <div class="clearfix"></div>
        <Menu />
        <div class="dashboard-content">
            <router-view></router-view>
        </div>
    </div>
</template> 

<script>
import Header from './partials/Header';
import Menu from './partials/Menu';

export default {
    data() {
        return {};
    },
    components: {
        Header,
        Menu,
    },
};
</script>

<style scoped>
</style>