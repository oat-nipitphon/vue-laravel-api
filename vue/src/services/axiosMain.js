import axios from 'axios';

const axiosMain = axios.create({
    baseURL: 'http://localhost:3000',
    withCredentials: true,
});



export default axiosMain;
