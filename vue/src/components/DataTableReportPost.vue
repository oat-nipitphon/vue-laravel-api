<script setup lang="ts">
import axiosAPI from "../services/axiosAPI";
import { ref, onMounted } from 'vue';
import { usePostsStore } from "../stores/posts";
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net-bs5';

DataTable.use(DataTablesCore);

const postsStore = usePostsStore();
const postsData = ref<any[]>([]);

onMounted(async () => {
  await postsStore.getAllPosts();
  postsData.value = postsStore.posts.data;
});

const columns = [
  { data: 'id', title: 'ID' },
  { data: 'title', title: 'Title' },
  { data: 'body', title: 'Body' },
  { data: 'created_at', title: 'Created' },
  { data: 'updated_at', title: 'Updated' },
  {
    title: 'Actions',
    data: null,
    render: (data, type, row) => {
      return `<button type="button" class="btn btn-primary btn-sm edit-btn" data-id="${row.id}">Edit</button>`;
    },
  },
];

// onMounted(() => {
//   const container = document.querySelector('.table'); // Adjust this selector to match your table
//   container?.addEventListener('click', (event) => {
//     const target = event.target as HTMLElement;
//     if (target.classList.contains('edit-btn')) {
//       const id = target.getAttribute('data-id');
//       if (id) {
//         editPost(id); // Call the edit function with the ID
//       }
//     }
//   });
// });

</script>

<template>
  <div class="row" style="margin:auto;">
    <div class="container">
      <h3>Repost Post</h3>
      <DataTable
        :columns="columns"
        :data="postsData"
        class="table table-hover table-striped"
        width="100%"
      >
        <thead>
          <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Body</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </DataTable>
    </div>
  </div>
</template>

<style scoped>
@import 'bootstrap';
@import 'datatables.net-bs5';
</style>
