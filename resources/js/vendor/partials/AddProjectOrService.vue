<template>
    <div class="adding-buttons">
      <a class="button border with-icon">
        <router-link to="/add-listing">
          Добави проект
          <i class="sl sl-icon-plus"></i>
        </router-link>
      </a>

      <a class="button border with-icon">
        <router-link to="/service/add-service">
          Добави услуга
          <i class="sl sl-icon-plus"></i>
        </router-link>
      </a>
    </div>
</template>

<style scoped>

@media screen and (min-width: 991px) {
    .adding-buttons {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        background-color: #F8F8F8;
    }

    a.button {
        border-radius: 15px;
        width: 245px;
    }

    a.button:nth-child(2) {
        margin-left: 44px;
    }

    .sl.sl-icon-plus {
        margin-left: 66px;
    }
}
@media screen and (max-width: 990px) {
    .adding-buttons {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: unset;
    }

    a.button.border {
        margin-top: 20px;
        font-size: 17px;
        border: 1px solid #276955;
        padding: 9px 32px;
    }

    a.button.border a {
        display: flex;
        align-content: center;
        justify-content: center;
        align-items: center;
    }

    a.button.border a i {
        margin-left: 20px;
        zoom: 1.5;
        padding: 0px;
    }

    a.button {
        margin-right: 0px;
    }
}
</style>