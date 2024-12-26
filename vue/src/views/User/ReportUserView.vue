<script setup>
import { useRouter, RouterLink } from "vue-router";
import TableDataReportUser from "@/components/TableDataReportUser.vue";

const router = useRouter();
</script>

<template>
  <div class="container">
    <!-- class text-end || d-flex justify-content-end-->
    <div class="text-end"> 
      <RouterLink
        type="button"
        class="btn btn-md btn-primary"
        :to="{ name: 'DashboardView' }"
      >
        back
      </RouterLink>
    </div>

    <div class="row">
      <TableDataReportUser />
    </div>
  </div>
</template>

<style>
.ibox-table-data {
  margin: auto;
  margin-top: 30px;
  max-width: 100%;
}
.table-data-header {
  background-color: bisque;
  font-weight: 700;
  font-size: 18px;
  text-align: center;
}
.table-data-body {
  background-color: white;
  font-weight: 500;
  font-size: 16;
  text-justify: auto;
}
</style>
