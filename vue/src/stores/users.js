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
        }
    }
});