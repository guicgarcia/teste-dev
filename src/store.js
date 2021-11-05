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
    }
  },
  actions: {
      list() {
          return http.get('livros')
      },
  },
})

export default store