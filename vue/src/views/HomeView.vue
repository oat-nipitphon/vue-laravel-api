<script setup>
import { onMounted, ref } from "vue";
import { useAuthStore } from "@/stores/auth";
import { RouterLink } from "vue-router";
const authStore = useAuthStore();
const users = ref([]);

onMounted(async () => {
  if (!authStore.storeUser) {
    await authStore.getUsers();
  }
});
</script>

<template>
  <div class="container">
    <div class="ibox-img">
      <div class="row">
        <div class="col-md-6">
          <img
            class="img-vue"
            alt="vue"
            src="https://svgmix.com/uploads/ab048e-vue.svg"
          />
        </div>
        <div class="col-md-6">
          <img
            class="img-laravel"
            alt="laravel"
            src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/36/Logo.min.svg/2560px-Logo.min.svg.png"
          />
        </div>
      </div>
    </div>
  </div>
</template>
<style>
.ibox-img {
  width: 50%;
  display: inline;
}
.img-laravel {
  margin: auto;
  margin-top: 40%;
  width: 50%;
  height: 30%;
}
.img-vue {
  margin: auto;
  margin-top: 40%;
  width: 50%;
  height: 30%;
}
</style>
