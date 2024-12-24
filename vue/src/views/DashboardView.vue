<script setup>
import axiosAPI from "@/services/axiosAPI";
import { ref, onMounted, reactive } from "vue";
const loading = ref(false);
const error = ref(null);
const users = ref([]);
const userProfiles = ref([]);

const getUsers = async () => {
const res = await axiosAPI.get('/api/get_users');
users.value = res.data.users;
console.log(users.value);
}

const getUserProfiles = async () => {
const res = await axiosAPI.get('/api/get_user_profiles');
userProfiles.value = res.data.user_profiles;
console.log(userProfiles.value);
}

const fullUsersPosts = ref([]);

const getFullUsersPosts = async () => {
  const res = await axiosAPI.get('/api/get_full_users_posts', {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`
    }
  });
  if (res.data.message != null) {
    fullUsersPosts.value = res.data.full_users_posts;
    console.log("Success.", fullUsersPosts.value);
  } else {
    console.log("Error", res.data);
  }
};

onMounted(async () => {
  getUserProfiles(),
  getUsers(),
  getFullUsersPosts()
});

</script>

<template>
  <div class="row text-center">
    <div class="row">
      <ReportSystem />
    </div>


    <button @click="getUsers">Get Users</button>
    <button @click="getUserProfiles">Get User Profiles</button>

    <div v-if="users">
      <h3>Users</h3>
      <ul>
        <li v-for="user in users" :key="user.id">{{ user.name }}</li>
      </ul>
    </div>

    <div v-if="userProfiles">
      <h3>User Profiles</h3>
      <ul>
        <li v-for="profile in userProfiles" :key="profile.id">
          {{ profile.address }}
        </li>
      </ul>
    </div>

    <div v-if="fullUsersPosts">
      <div class="row"
        v-for="row in fullUsersPosts" :key="row.id"
      >
      <p>USER :: {{ row.id }}</p>
      <p>PHOTO ::
        <img 
        :src="`/uploads/${row.user_photos.photo_name}`"
        alt="User Image"
        style="margin: auto; width: 150px; height: 150px; object-fit: cover; border-radius: 50%;"
        >
      </p>
      <p>PROFILE :: {{ row.user_profiles.address }}</p>
      <p>POST :: {{ row.posts.title }}</p>
      </div>
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
