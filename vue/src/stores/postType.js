import { defineStore } from "pinia";

export const usePostTypeStore = defineStore("postTypeStore", {
    state: () => {
        return {
            storeType: null,
            errors: {},
        };
    },
    actions: {

        async getPostType() {
            try {
                const res = await fetch(`/api/post_types`, {
                    method: "GET",
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`,
                    },
                });
                const data = await res.json();  // Await the response to get the data
                if (data.errors) {
                    console.log("Error Store Post Type :: ", data.errors);
                } else {
                    return data.post_types;  // Return the post types list
                }
            } catch (error) {
                console.error("store post type error : ", error);
            }
        }


    },
});