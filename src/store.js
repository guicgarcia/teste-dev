import Vue from 'vue'
import Vuex from 'vuex'
import { http } from './services/config'

Vue.use(Vuex)

const store = new Vuex.Store({
    state() {
        return {
            book: {
                id: "",
                name: "",
                author: "",
                category_id: "",
                code: "",
                type: "",
                size: "",
                category: {
                    id: "",
                    name: "",
                },
            },
            books: [],
            errors: [],
            categories: [],
        }
    },
    mutations: {
        UPDATE_BOOK(state, payload) {
            console.log(state, payload);
            this.state.book = payload;
            this.state.book.category_id = payload.category.id;
        }
    },
    actions: {
        bookName(context, payload) {
            console.log(context, payload);
            this.state.book.name = payload;
        },
        bookAuthor(context, payload) {
            console.log(context, payload);
            this.state.book.author = payload;
        },
        bookCategoy(context, payload) {
            console.log(context, payload);
            this.state.book.category.id = payload;
            this.state.book.category_id = payload;
        },
        bookCode(context, payload) {
            console.log(context, payload);
            this.state.book.code = payload;
        },
        bookType(context, payload) {
            console.log(context, payload);
            this.state.book.type = payload;
        },
        bookSize(context, payload) {
            console.log(context, payload);
            this.state.book.size = payload;
        },
        list() {
            return http.get('livros')
        },
        saveBook(context, payload) {
            console.log(context, payload);
            return http.post('livros', this.state.book)
        },
        update(context, payload) {
            console.log(context);
            console.log(payload);
            return http.put('livros/' + payload.id, payload)
        }
    },
})

export default store