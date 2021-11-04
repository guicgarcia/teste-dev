<template>
  <div id="app">
    <div class="container">
      <h1>Crud de Livros</h1>
      
      <form action="" method="post">
        <div class="mb-3">
          <input
            type="text"
            class="form-control"
            placeholder="Nome do Livro"
          />
        </div>

        <div class="mb-3">
          <input
            type="text"
            class="form-control"
            placeholder="Nome do Autor"
          />
        </div>

        <div class="mb-3">
          <input
            type="number"
            class="form-control"
            placeholder="Categoria"
          />
        </div>

        <div class="mb-3">
          <input
            type="text"
            class="form-control"
            placeholder="Código"
          />
        </div>

        <div class="mb-3">
          <input
            type="text"
            class="form-control"
            placeholder="Tipo"
          />
        </div>

        <div class="mb-3">
          <input
            type="number"
            class="form-control"
            placeholder="Tamanho"
          />
        </div>
      </form>
      
    </div>
  </div>
</template>

<script>
export default {
  name: 'StoreBook',
}
</script>


<style scoped>

</style>
