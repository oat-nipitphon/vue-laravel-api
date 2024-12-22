<script setup>
import { RouterLink, RouterView } from "vue-router";
import HelloWorld from "./components/HelloWorld.vue";
import NavTop from "./layouts/NavTop.vue";
import { useAuthStore } from "./stores/auth";

const authStore = useAuthStore();
</script>

<template>
  <div class="col-lg-12">
    <div class="row">
      <header>
        <nav>
          <RouterLink
            v-if="!authStore.storeUser"
            :to="{ name: 'HomeView' }"
            class="nav-top-left"
          >
            Home
          </RouterLink>

          <RouterLink
            v-if="authStore.storeUser"
            :to="{ name: 'DashboardView' }"
            class="nav-top-left"
          >
            Dashboard
          </RouterLink>

          <RouterLink
            v-if="!authStore.storeUser"
            :to="{ name: 'LoginView' }"
            class="nav-top-right"
          >
            Login
          </RouterLink>

          <RouterLink
            v-if="!authStore.storeUser"
            :to="{ name: 'RegisterView' }"
            class="nav-top-right"
          >
            Register
          </RouterLink>

          <form
            class="nav-top-right"
            v-if="authStore.storeUser"
            @submit.prevent="authStore.logout"
          >
            <button type="submit" class="btn btn-danger btn-sm">Logout</button>
          </form>
        </nav>
      </header>
    </div>
    <div class="container">
      <RouterView />
    </div>
  </div>
</template>

<style scoped>
header {
  margin-top: 0px;
}
.nav-top-left {
  font-weight: 500;
  color: white;
  font-size: 16px;
  text-align: left;
}

.nav-top-right {
  font-weight: 300;
  color: white;
  font-size: 16px;
  text-align: right;
}
</style>
