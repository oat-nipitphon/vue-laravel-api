<script setup>
import axiosAPI from "@/services/axiosAPI";
import { ref, onMounted } from "vue";
import TableDataReportUser from "@/components/TableDataReportUser.vue";

const userProfiles = ref([]);

const getUserProfile = async () => {
  const response = await axiosAPI.get('/api/user_profiles');
  userProfiles.value = response.data.user_profiles;
  console.log(userProfiles.value);
};

onMounted(async () => {
  getUserProfile();
});
</script>
<template>
  <div class="container" style="margin-top: 30px;">
    <h1>ReportUserView</h1>
    <label> Table Report Users. </label>
    <div class="row">
      <!-- <TableDataReportUser /> -->
    </div>
    <div class="row" v-if="userProfiles.length">
      <div
        v-for="userProfile in userProfiles"
        :key="userProfile.id"
        class="col-md-4 text-center"
      >
      <!-- <img src="vue/public/uploads/1735042533.jpg" alt="User Image" /> -->
      <img
        :src="`/uploads/${userProfile.photo_name}`"
        alt="User Image"
        style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;"
      />
        <p>{{ userProfile.user_id }}</p>
      </div>
    </div>
  </div>
</template>
