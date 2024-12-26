import { defineStore } from 'pinia';

export const useAuthStore = defineStore('authStore', {
    state: () => ({
        storeToken: null,
        storeUser: null,
        errors: {},
    }),
    actions: {

        async checkTOKEN () {
            try {
                const token = localStorage.getItem("token"); // Get token from localStorage

                if (token) {
                  console.log("Token found:", token);
                  this.storeToken = token; // Update store state
                  return token; // Return token
                } else {
                  console.log("No token found.");
                  this.storeToken = null
                }
            } catch (error) {
                console.error("stores auth function authCheckTOKEN Error ::", error);
            }
        },

        // Get User
        async getUsers() {
            try {
                const token = localStorage.getItem('token');
                
                if (!token) {
                    console.log();
                    return this.storeUser = null;
                } 

                const res = await fetch('/api/user', {
                    method: 'GET',
                    headers: {
                        authorization: `Bearer ${token}`,
                    },
                });

                const data = await res.json();
                if (data.error) {
                    console.error('Failed to fetch user data');
                }
                
                return this.storeUser = data.user; 

            } catch (error) {
                console.error('Error fetching user data:', error);
            }
        },


        // Register and Login Auth
        async authenticate(apiRoute, payload) {
            const res = await fetch(`/api/${apiRoute}`, {
                method: "POST",
                body: JSON.stringify(payload),
            });

            if (res.ok) {
                const data = await res.json();
                localStorage.setItem('token', data.token);
                this.storeUser = data.user;
                console.log(data);

                this.router.push({ name: "DashboardView" });
            } else {

                this.errors = data.errors;
                console.log(data.errors);
            }

        },

        /********************* Logout *************************/
        async logout() {
            try {
                const token = localStorage.getItem('token');
                if (!token) {
                    console.error('No token found');
                    return;
                }

                const res = await fetch('/api/logout', {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                    },
                });

                const data = await res.json();
                console.log(data);

                if (res.ok) {

                    this.storeUser = null; // ลบข้อมูลผู้ใช้จาก store
                    this.errors = {}; // รีเซ็ต errors

                    localStorage.removeItem('token');
                    this.router.push({ name: 'HomeView' });

                } else {
                    // หากมีข้อผิดพลาดจาก server
                    console.error('Logout failed:', data.message);
                }
            } catch (error) {
                console.error('Error logging out:', error);
            }
        }


    },
});
