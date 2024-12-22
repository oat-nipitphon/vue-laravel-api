import { defineStore } from "pinia";

export const useSupportStore = defineStore("supportStore", {
  state: () => ({
    dataStore: null,
    errors: null
  }),
  actions: {
    async uploadImg(formData) {
      try {
        const res = await fetch(`/api/upload_img`, {
          method: "POST",
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`,
          },
          body: formData, // Send the FormData directly without JSON.stringify
        });

        const data = await res.json(); // Await the response to parse the JSON

        if (data.errors) {
          console.log("Store support upload img error: ", data.errors);
          this.errors = data.errors;
        } else {
          this.dataStore = data.req;  // Store the response if successful
        }
      } catch (error) {
        console.error("Upload image failed: ", error);
        this.errors = error;  // Handle any network errors
      }
    }
  }
});
