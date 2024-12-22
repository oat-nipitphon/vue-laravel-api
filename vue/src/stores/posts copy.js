import { defineStore } from "pinia";
import Swal from "sweetalert2";
import axios from "axios";
export const usePostsStore = defineStore("postsStore", {
  state: () => {
    return {
      stotePost: null,
      errors: {},
    };
  },
  actions: {

    /********************* Get All Posts *************************/
    async getAllPosts() {
      try {
        const res = await fetch(`/api/posts`, {
          method: "GET",
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`,
          },
        });
        const data = await res.json();
        if (res.ok) {
          console.log(data.posts);
          return data.posts;
        } else {
          console.log( this.errors = {} );
        }
      } catch (error) {
        console.error("Failed to fetch posts:", error);
      }
    },

    /********************* Get Post *************************/
    async getPost(post) {

      const res = await fetch(`/api/posts/${post}`, {
        method: "GET",
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`
        },
      });
      const data = await res.json();
      if(res.ok) {
        console.log(data);
        return data;
      } else {
        console.log( this.errors = {} );
      }
    },


    /********************* Create a Post *************************/
    async createPost(formData) {
      try {
    
        const res = await fetch(`/api/posts`, {
          method: "POST", 
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`,
          },
          body: JSON.stringify(formData),
        });
    
        const data = await res.json();
    
        if (res.status === 201) {
          Swal.fire({
            title: "Post created successfully!",
            width: 600,
            padding: "3em",
            background: "#fff url(/images/trees.png)",
            backdrop: `rgba(0,0,123,0.4) url("/images/nyan-cat.gif") left top no-repeat`,
          }).then(() => {
            this.router.push({ name: 'ReportPostView' });
          });
        } else {
          console.error("Failed:", data); 
          this.errors = data.errors || {};
        }
      } catch (error) {
        console.error("Error in createPost function:", error);
      }
    },
    

    /********************* Edit a Post *************************/
    async updatePost(formData) {

      const res = await fetch(`/api/posts/${formData.post_id}`, {
        method: "PUT",
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`
        },
        body: JSON.stringify(formData),
      });
      const data = await res.json();

      if (data.errors) {
        this.errors = data.errors;
      } else {
        this.router.push({ name: 'ReportPostView' });
      }
    },

    async deletePost(post) {

      const res = await fetch(`/api/posts/${post}`, {
        method: "DELETE",
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`
        },
      });

      const data = await res.json();
      if (res.ok) {
        this.router.push({ name: "ReportPostView" });
      } else {
        this.errors = {};
      }

    },


  },
});