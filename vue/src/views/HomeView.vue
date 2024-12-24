<script setup>
import { onMounted, ref } from "vue";
import { useAuthStore } from "@/stores/auth";
import { RouterLink } from "vue-router";
import ImageFile from "@/components/ImageFile.vue";
import UploadFilePhoto from "@/components/UploadFilePhoto.vue";

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
            src="../assets/icon/vue.png"
          />
        </div>
        <div class="col-md-6">
          <img
            class="img-laravel"
            alt="laravel"
            src="../assets/icon/laravel.png"
          />
        </div>
      </div>
    </div>
    <div class="ibox-body">
      <div class="ibox-form-upload">

      </div>
    </div>
  </div>
</template>
<style>
.ibox-img {
  max-width: 100%;
  margin-top: 20%;
}
.ibox-body {
  margin-top: 20px;
}
.img-laravel {
  margin: auto;
  width: 290px; 
  height: 160px;
}
.img-vue {
  margin: auto;
  width: 270px;
  height: 140px;
}
</style>
