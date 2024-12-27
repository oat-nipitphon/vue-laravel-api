<script setup>
import { onMounted, ref } from "vue";
import { RouterLink, RouterView } from "vue-router";
import HelloWorld from "./components/HelloWorld.vue";
import NavTop from "./layouts/NavTop.vue";
import { useAuthStore } from "./stores/auth";

const authStore = useAuthStore();
// const userName = authStore.storeUser.name;
// console.log(userName);

const users = ref([]);
onMounted(async () => {});
</script>

<template>
  <div class="col-lg-12">
    <header>
      <nav>
        <div class="row" v-if="authStore.storeUser">
          <div class="col-md-2">
            <RouterLink
              v-if="authStore.storeUser"
              :to="{ name: 'DashboardView' }"
              class="nav-top"
            >
              Dashboard
            </RouterLink>
          </div>
          <div class="col-md-4 nav-top-welcome" v-if="authStore.storeUser">
            Welcome {{ authStore.storeUser.name }} !
          </div>
          <div class="col-md-4 nav-top-welcome" v-else>
            Please log in to access your account.
          </div>
          <div class="col-md-4">
            <label class="nav-top-status-email"> status email :: </label>
            <label style="color: greenyellow"> Email Verified! </label>
            <label style="color: yellow"> Email Not verified! </label>
          </div>
          <div class="col-md-2">
            <form class="" @submit.prevent="authStore.logout">
              <button type="submit" class="btn btn-danger btn-sm">
                Logout
              </button>
            </form>
          </div>
        </div>
        <div class="row">
          <div class="col-md-10" v-if="!authStore.storeUser"></div>
          <div class="col-md-2" v-if="!authStore.storeUser">
            <div class="row">
              <div class="col-md-6">
                <RouterLink :to="{ name: 'LoginView' }" class="">
                  Login
                </RouterLink>
              </div>
              <div class="col-md-6">
                <RouterLink :to="{ name: 'RegisterView' }" class="">
                  Register
                </RouterLink>
              </div>
            </div>
          </div>
        </div>
      </nav>
    </header>

    <div class="container">
      <RouterView />
    </div>
  </div>
</template>

<style scoped>
header {
  width: 100%;
  margin-top: 0px;
  color: white;
  font-weight: 600;
  font-size: 16px;
}
.nav-top {
  font-weight: 700;
  color: white;
  font-size: 16px;
}
.nav-top-welcome {
  font-weight: 700;
  color: white;
  font-size: 16px;
}
.nav-top-status-email {
  font-weight: 700;
  color: white;
  font-size: 16px;
}
</style>
