import axios from 'axios'

export const http = axios.create({
    baseURL: 'http://localhost/books/public/api/v1/'
})