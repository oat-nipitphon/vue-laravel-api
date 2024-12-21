import { defineStore } from 'pinia';

export const useAuthStore = defineStore('authStore', {
    state: () => ({
        storeUser: null,
        errors: {},
    }),
    actions: {

        // Get User
        async getUsers() {
            try {
                const token = localStorage.getItem('token');
                if (token) {
                    const res = await fetch('/api/user', {
                        method: 'GET',
                        headers: {
                            authorization: `Bearer ${token}`,
                        },
                    });

                    if (res.ok) {

                        this.storeUser = await res.json();

                    } else {
                        console.error('Failed to fetch user data');
                    }



                } else {
                    console.log("Get Users false < !Token > ");
                }
            } catch (error) {
                console.error('Error fetching user data:', error);
            }
        },


        // Register and Login Auth
        async authenticate(apiRoute, formData) {
            const res = await fetch(`/api/${apiRoute}`, {
                method: "POST",
                body: JSON.stringify(formData),
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

        // async authenticate(apiRoute, formData) {
        //   try {
        //     const res = await fetch(`/api/${apiRoute}`, {
        //       method: 'POST',
        //       headers: {
        //         'Content-Type': 'application/json',
        //       },
        //       body: JSON.stringify(formData),
        //     });

        //     if (res.ok) {

        //       const data = await res.json(); 
        //       localStorage.setItem('token', data.token);
        //       this.router.push({ name: 'DashboardView' });

        //     } else {
        //       const data = await res.json();
        //       this.errors = data.errors || {};
        //     }
        //   } catch (error) {
        //     console.error('Authentication error:', error);
        //   }
        // },


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
