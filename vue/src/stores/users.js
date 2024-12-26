import { defineStore } from "pinia";

export const useDefineStoreUsers = defineStore("usersStore", {
  state: () => ({
    reqUsers: null,
    errors: {},
  }),
  actions: {
    async apiUserProfilePhoto() {
      try {
        const res = await fetch(`/api/users`, {
          method: "GET",
          headers: {
            Auth: `${localStorage.getItem("token")}`,
          },
        });
        const data = await res.json();
        if (data.errors) {
          this.errors = data.errors;
        } else {
          this.reqUsers = data.req;
        }
      } catch (error) {
        console.error("Failed to fetch user profile photos:", error);
      }
    },
    async apiCreateUserProfile() {
      try {
        // Logic for creating user profiles
      } catch (error) {
        console.error("Failed to create user profile:", error);
      }
    },
    async apiUpdateUserProfile() {
      try {
        // Logic for updating user profiles
      } catch (error) {
        console.error("Failed to update user profile:", error);
      }
    },
    async apiDeleteUserProfile() {
      try {
        // Logic for deleting user profiles
      } catch (error) {
        console.error("Failed to delete user profile:", error);
      }
    },
  },
});
