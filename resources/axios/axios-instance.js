import axios from "axios"
import router from "../js/router/router";

const instance = axios.create({
    withCredentials: true,
    // baseURL: process.env.VUE_APP_URL_API,
    baseURL: import.meta.env.VUE_APP_URL_API, //INFO В Vite нужно так. В .env добавить
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Content-Type': 'application/json'
    }
})

instance.interceptors.response.use({}, error => {
    // console.log(error.response)
    if(error.response.status ===401 || error.response.status ===419) {
        const token = localStorage.getItem('x-token')
        if (token) {
            localStorage.removeItem('x-token')
        }
        // window.location.replace('/login')
        router.push({name: 'login'})
    }
  return Promise.reject(error);
})

export default instance
