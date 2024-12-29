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
        
                // Append form data to the payload
                for (const key in formUpdate) {
                    if (formUpdate[key] !== undefined && formUpdate[key] !== null) {
                        payload.append(key, formUpdate[key]);
                    }
                }
        
                // Handle file input
                const fileInput = document.querySelector('input[type="file"]');
                if (fileInput && fileInput.files[0]) {
                    payload.append('photo', fileInput.files[0]);
                }
        
                // Make the API request
                const res = await fetch('/api/update-user', {
                    method: 'PUT',
                    body: payload,
                    headers: {
                        Authorization: `Bearer ${authStore.getToken()}`, // Call getToken if it's a function
                        // 'X-CSRF-TOKEN': csrfToken, // Uncomment if your API requires a CSRF token
                    },
                });
        
                // Parse the response
                const result = await res.json();
        
                if (!res.ok) {
                    throw new Error(result.message || 'Failed to update user.');
                }
        
                // Success feedback
                console.log('User updated successfully:', result);
                alert('User updated successfully!'); // Replace with a toast notification if available
            } catch (error) {
                console.error('Error updating user:', error);
                alert('Error updating user. Please try again.');
            }
        },
        
        

    }
});