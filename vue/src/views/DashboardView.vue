<script setup>
import axiosAPI from "@/services/axiosAPI";
import { ref, onMounted, reactive } from "vue";
import ReportSystem from "../views/ReportSystem.vue";
onMounted(async () => {

});

</script>

<template>
  <div class="row text-center">
    <div class="row">
      <ReportSystem />
    </div>
  </div>
</template>

<style>
.ibox-system-header {
  color: #ffffff;
  margin-top: 30px;
  background-color: rgb(4, 121, 184);
}
.ibox-system-sub-body {
  width: 100%;
  color: #ffffff;
  margin-top: 30px;
}
.ibox-system-font-content {
  margin: auto;
}
</style>
