<template>
    <p>Message is: {{ message }}</p>
  </template>
  
  <script setup>
  import { defineProps } from "vue";
  
  defineProps({
    message: {
      type: String,
      required: true
    }
  });
  </script>
  