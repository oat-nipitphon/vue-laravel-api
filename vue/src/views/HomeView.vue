<script setup>
import { onMounted, ref } from "vue";
import { useAuthStore } from "@/stores/auth";

const authCheckTOKEN = useAuthStore();
const checkToken = ref([]);

onMounted(async () => {

  checkToken.value = await authCheckTOKEN.checkTOKEN();
  // console.log(checkToken);

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
