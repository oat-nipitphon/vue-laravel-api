import { defineStore } from "pinia";

export const useDefineStoreUser = defineStore('usersStore', {
    state: () => {
        return {
            reqUsers: null,
            errors: {}
        }
    },
    actions: {
        async apiUserProfilePhoto() {
            const res = await fetch(`/api/userProfilePhoto`, {
                method: "GET",
                headers: {
                    Auth: `${localStorage.getItem('token')}`
                }
            });
            const data = await res.json();
            if(data.errors){
                this.errors = data.errors
            }else {
                this.reqUsers = data.req;
            }
        },
        async apiGetUser (user) {
            try {
                const res = await fetch(`/api/users/${user}`, {
                    method: "GET",
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`
                    },
                });
                const data = await res.json();
                if(data.error){
                    console.error("store user error", data.error);
                } else {
                    // console.log("store user success", data.user);
                    return data.user;
                }
            } catch (error) {
                console.error(error);
            }
        },

        async apiUpdateUser(formUpdate) {
            try {
                const payload = new FormData();
                for (const key in formUpdate) {
                    payload.append(key, formUpdate[key]);
                }
                
                // Assuming file upload
                const fileInput = document.querySelector('input[type="file"]');
                if (fileInput && fileInput.files[0]) {
                    payload.append('photo', fileInput.files[0]);
                }
        
                const res = await fetch('/api/update-user', {
                    method: 'POST',
                    body: payload,
                    headers: {
                        Authorization: `Bearer ${authStore.getToken}`, // If token is required
                    },
                });
        
                const result = await res.json();
        
                if (!res.ok) {
                    throw new Error(result.message || 'Failed to update user.');
                }
        
                console.log('User updated successfully:', result);
                alert('User updated successfully!');
            } catch (error) {
                console.error('Error updating user:', error);
                alert('Error updating user. Please try again.');
            }
        },
        

    }
});