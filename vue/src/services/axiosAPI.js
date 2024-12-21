import axios from 'axios';

const axiosAPI = axios.create({
    baseURL: 'http://127.0.0.1:8000',
    withCredentials: true,
    headers: {
      "Content-Type": "application/json",
    },
});



export default axiosAPI;
