import Vue from 'vue'
import Vuex from 'vuex'
import { http } from './services/config'

Vue.use(Vuex)

const store = new Vuex.Store({
    state() {
    return {
      name: '',
      author: '',
      category_id: '',
      code: '',
      type: '',
      size: '',
      category: {
          id: '',
          name: '',
      }
    }
  },
  mutations: {
    // ADD_BOOK(payload) {
    //     return http.post('livros', payload)
    // },
  },
  actions: {
      list() {
          return http.get('livros')
      },
      add(context, payload) {
          //context.commit('ADD_BOOK', payload)
          return http.post('livros', payload)
      }
  },
})

export default store