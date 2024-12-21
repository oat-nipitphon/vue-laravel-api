import { defineStore } from "pinia";
import { useRoute } from "vue-router";

const apiUser = "../services/axiosAPI.js"
const route = useRoute();

export const useAuthStore = defineStore("authStore", {
    state: () => {
        return {
            userData: null,
            users: null,
            errors: {},
        };
    },
    actions: {

        // Get User
        async getUsers() {

            if (localStorage.getItem("token")) {

                this.userData = await fetch(`/api/user`, {
                    method: "GET",
                    headers: {
                        authorization: `Bearer ${localStorage.getItem("token")}`,
                    },
                });

                return this.userData;

            }
        },


        // Register and Login Auth
        // async authenticate(apiRoute, formData) {
        //     const res = await fetch(`/api/${apiRoute}`, {
        //         method: "POST",
        //         body: JSON.stringify(formData),
        //     });
        //     const data = await res.json();
        //     // if (data.errors) {
        //     //     this.errors = data.errors;
        //     //     console.log(data.errors);
        //     // } else {
        //     //     console.log(data);
        //     //     localStorage.setItem('token', data.token);
        //     //     this.user = data.user;
        //     //     // this.route.push({ name: "HomeView" });
        //     // }

        // },

        async authenticate(apiRoute, formData) {
            try {
              const res = await fetch(`/api/${apiRoute}`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(formData),
              });

              const data = res.data;  
              localStorage.setItem("token", data.token);
              this.route.push({ name: "DashboardView" });

            } catch (error) {
              if (error.response && error.response.data.errors) {
                this.errors = error.response.data.errors;
              }
            }
          },


        // Logout Auth user
        async logout() {

            try {

                const res = await fetch(`/api/logout`, {
                    method: "POST",
                    headers: {
                        authorization: `Bearer ${localStorage.getItem("token")}`
                    },
                });
                const data = await res.json();
    
                if (res.ok) {
                    this.user = null
                    this.errors = {}
                    localStorage.removeItem('token')
                    this.route.push({ name: "HomeView" });
                }

            } catch (error) {
                console.error(error);
            }

        },


    },
});