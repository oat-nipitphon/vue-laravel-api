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
                    console.log("store user success", data.user);
                    return data.user;
                }
            } catch (error) {

            }
        },

        async apiUpdateUser (formUpdate) {
            try {

                // const data = formUpdate.json();
                return formUpdate;

            } catch (error) {
                console.error(error);
            }
        },

    }
});