import { defineStore } from "pinia";

export const useUserProfilesStore = defineStore([
    "usersStore", {
        state: () => {
            return {
                usersto: null,
                errors: {}
            };
        },
        actions: {
            async getUsers() {
                const res = await fetch("/api/get_users", {
                    method: 'get',
                    headers: {
                        Authorization: `${localStorage.getItem('token')}`,
                        "Content-Type": "multipart/form-data"
                    }
                });
                const data = res.json();
                
                if(data.ok) {
                    console.log("profiles store success :: ", data.response);
                } else {
                    console.log("profile store error :: ", data.errors);
                }
            }
        },
    },
    "profilesStore", {
        state: () => {
            return {
                profilesto: null,
                errors: {}
            };
        },
        actions: {
            
            async getProfiles() {
                const res = await fetch("/api/get_profiles", {
                    method: 'get',
                    headers: {
                        Authorization: `${localStorage.getItem('token')}`,
                        "Content-Type": "multipart/form-data"
                    }
                });
                const data = res.json();
                
                if(data.ok) {
                    console.log("profiles store success :: ", data.response);
                } else {
                    console.log("profile store error :: ", data.errors);
                }
            }

        },
    },
]);