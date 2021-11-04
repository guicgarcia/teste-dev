import { http } from './config'

export default {
    list:() => {
        return http.get('livros')
    },
    view:(book) => {
        return http.get('livros/' + book.id, book)
    },
    store:(book) => {
        console.log(book);
        return http.post('livros', book)
    },
    update:(book) => {
        return http.put('livros/' + book.id, book)
    },
    delete:(book) => {
        return http.delete('livros/' + book.id, book)
    },
    listCategories:() => {
        return http.get('livros/categories')
    },
    filterName:(book) => {
        console.log(book);
        return http.post('livros/filter', book)
    },
    filterCategory:(book) => {
        console.log(book);
        return http.post('livros/filter', book)
    },
    filterType:(book) => {
        return http.post('livros/filter', book)
    }
}