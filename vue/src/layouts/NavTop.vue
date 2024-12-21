<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">
            <span style="color: #ffffff; font-weight: 500px;">
                Home
            </span>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li> -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span style="color: #ffffff; font-weight: 500px;">
                Auth
            </span>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/Login">Login</a></li>
            <li><a class="dropdown-item" href="/Register">Register</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/Dashboard">Dashboard</a></li>
          </ul>
        </li>
        <li class="nav-item">
            <RouterLink to="/Dashboard" class="nav-link">
                <span  style="color: #ffffff; font-weight: 500px;">
                    Dashboard
                </span>
            </RouterLink>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span style="color: #ffffff; font-weight: 500px;">
                Actions
            </span>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Report</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Edit</a></li>
            <li><a class="dropdown-item" href="#">Delete</a></li>
          </ul>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li> -->
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
</template>
<script setup>
import { RouterLink } from 'vue-router'
import Login from '@/views/Auth/LoginView.vue';
</script>