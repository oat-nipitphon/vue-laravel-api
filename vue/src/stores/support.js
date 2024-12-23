import axios from "axios";
import { defineStore } from "pinia";

export const useSupportStore = defineStore("supportStore", {
  state: () => ({
    dataStore: null,
    errors: null
  }),

  // ******************* Start Actions *******************//
  actions: {
    
    async uploadUserPhoto(formData) {

      const payload = new FormData();
      payload.append('file_photo', formData.filePhoto);

      const response = await fetch(`/api/upload_file_photo`, {
        method: "POST",
        body: payload
      });

      const data = response.json();
      console.log("Store log data return res : ", data);

    if (response.ok) {
      console.log("Store log data return success:", data);
      this.dataStore = data; // Save the response data if needed
      if (response.status === 200) {
        console.log("status === 200 ", response.status);
      }
    } else {
      console.error("Store log data error response != 200:", data);
      this.errors = data.errors; // Save errors if needed
    }

    }

  }
  // ******************* End Actions *******************//

});
