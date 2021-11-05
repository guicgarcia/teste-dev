<template>
  <div id="app">
    <div class="container">
      <ul>
        <li v-for="(erro, index) of errors" :key="index">
          <b class="text-danger">{{ erro }}</b>
        </li>
      </ul>

      <h1>Crud Livros</h1>

      <form @submit.prevent="save()">
        <div class="mb-3">
          <input
            type="text"
            class="form-control"
            placeholder="Nome do Livro"
            v-model="book.name"
          />
        </div>

        <div class="mb-3">
          <input
            type="text"
            class="form-control"
            placeholder="Nome do Autor"
            v-model="book.author"
          />
        </div>

        <div class="mb-3">
          <select v-model="book.category.id" name="category_id" class="form-control">
            <option value="">Selecione uma Categoria</option>
            <option
              v-for="categorie of categories"
              :key="categorie.id"
              name="select"
              v-bind:value="categorie.id"
            >
              {{ categorie.name }}
            </option>
          </select>
        </div>

        <div class="mb-3">
          <input
            type="text"
            class="form-control"
            placeholder="Código"
            v-model="book.code"
          />
        </div>

        <div class="mb-3">
          <select v-model="book.type" class="form-control">
            <option value="">Selecione um Tipo de Arquivo</option>
            <option value="Arquivo digital">Arquivo digital</option>
            <option value="Arquivo físico">Arquivo físico</option>
          </select>
        </div>

        <div class="mb-3">
          <input
            type="number"
            class="form-control"
            placeholder="Tamanho"
            v-model="book.size"
          />
        </div>

        <div class="mb-3">
          <input class="btn btn-primary" type="submit" value="Salvar" />
        </div>
      </form>

      <div v-if="flag">
        <b>Livro:</b> {{ this.book.name }} <br />
        <b>Autor:</b> {{ this.book.author }} <br />
        <b>Categoria:</b> {{ this.category }} <br />
        <b>Código:</b> {{ this.book.code }} <br />
        <b>Tipo:</b> {{ this.book.type }} <br />
        <b>Tamanho:</b> {{ this.book.size }} <br />
      </div>

      <br />

      <form @keyup.prevent="filterName()">
        <div class="mb-3">
          <input
            type="text"
            class="form-control"
            placeholder="Pesquisar por nome do Livro"
            v-model="book.name"
          />
        </div>
      </form>

      <form @change.prevent="filterCategory()">
        <div class="mb-3">
          <select v-model="book.category_id" class="form-control">
            <option value="">Pesquise por uma Categoria</option>
            <option
              v-for="categorie of categories"
              :key="categorie.id"
              name="select"
              v-bind:value="categorie.id"
            >
              {{ categorie.name }}
            </option>
          </select>
        </div>
      </form>

      <form @change.prevent="filterType()">
        <div class="mb-3">
          <select v-model="book.type" class="form-control" placeholder="teste">
            <option value="">Pesquisar por Tipo de Arquivo</option>
            <option value="Arquivo digital">Arquivo digital</option>
            <option value="Arquivo físico">Arquivo físico</option>
          </select>
        </div>
      </form>

      <br />

      <form @submit.prevent="list()">
        <div class="mb-3">
          <input class="btn btn-info" type="submit" value="Listar" />
        </div>
      </form>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Autor</th>
            <th scope="col">Categoria</th>
            <th scope="col">Tipo</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="book of books" :key="book.id">
            <th scope="row">{{ book.id }}</th>
            <td>{{ book.name }}</td>
            <td>{{ book.author }}</td>
            <td>{{ book.category.name }}</td>
            <td>{{ book.type }}</td>
            <td>
              <button
                @click="view(book)"
                type="button"
                class="btn btn-primary mx-2"
              >
                Ver
              </button>
              <button
                @click="update(book)"
                type="button"
                class="btn btn-warning"
              >
                Editar
              </button>
              <button
                @click="remove(book)"
                type="button"
                class="btn btn-danger mx-2"
              >
                Deletar
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import Book from "./services/books";

export default {
  name: "App",
  data() {
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
          id: '',
          name: '',
        },
      },
      category: "",
      books: [],
      errors: [],
      categories: [],
      flag: "",
    };
  },
  components: {},
  mounted() {
    this.list();
    this.listCategories();

    //console.log(this.$store.actions.list);
  },
  methods: {
    list() {
      // Book.list().then((response) => {
      //   console.log(response.data.data);
      //   this.books = response.data.data;
      // });

      this.$store.dispatch('list').then((response) => {
        this.books = response.data.data;
      });
    },
    view(book) {
      Book.view(book).then((response) => {
        console.log(response.data.data);

        this.flag = true;
        this.book.name = response.data.data.name;
        this.book.author = response.data.data.author;
        this.category = response.data.data.category.name;
        this.book.code = response.data.data.code;
        this.book.type = response.data.data.type;
        this.book.size = response.data.data.size;
      });
    },
    save() {
      if (!this.book.id) {
        this.book.category_id = this.book.category.id;
        Book.store(this.book)
          .then(() => {
            // this.book.category = {};
            // this.book = {};
            alert('Cadastrado com sucesso"');
            this.list();
            this.errors = [];
          })
          .catch((error) => {
            console.log(error.response.data.errors.name[0]);
            this.errors = error.response.data.errors;
          });
      } else {
        this.book.category_id = this.book.category.id;
        Book.update(this.book)
          .then((response) => {
            console.log(response);
            //this.book = {};
            alert('Atualizado com sucesso"');
            this.list();
            this.errors = [];
          })
          .catch((error) => {
            console.log(error.response.data);
            this.errors = error.response.data.errors;
          });
      }
    },
    update(book) {
      console.log(book);
      this.book = book;
    },
    remove(book) {
      Book.delete(book)
        .then((response) => {
          console.log(response);
          this.list();
          this.errors = [];
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
    listCategories() {
      Book.listCategories().then((response) => {
        this.categories = response.data;
      });
    },
    filterName() {
      Book.filterName(this.book).then((response) => {
        console.log(response.data.data);
        this.books = response.data.data;
      });
    },
    filterCategory() {
      Book.filterCategory(this.book).then((response) => {
        console.log(response.data);
        this.books = response.data.data;
        this.book.category_id = "";
      });
    },
    filterType() {
      Book.filterType(this.book).then((response) => {
        console.log(response.data);
        this.books = response.data.data;
        this.book.type = "";
      });
    },
  },
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
