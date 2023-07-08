<template>
  <div class="todoContainer">
    <div class="todoHeading">
      <h2>Todo list</h2>
      <create-todo-list-form @listCreated="addTodoList" />
    </div>
    <div v-for="list in todoLists" :key="list.id">
      <h3>{{ list.name }}</h3>
      <add-todo-item-form
        v-on:reloadList="getList"
        :todoListId="list.id"
        :todoLists="todoLists"
      />
      <list-todo-items
        :items="items"
        v-on:reloadList="getList"
        :todoListId="list.id"
      />
    </div>
  </div>
</template>

<script>
import addTodoItemForm from "./addTodoItemForm.vue";
import createTodoListForm from "./createTodoListForm.vue";
import listTodoItems from "./listTodoItems.vue";
export default {
  components: {
    addTodoItemForm,
    createTodoListForm,
    listTodoItems
  },
  data() {
    return {
      items: [],
      todoLists: []
    };
  },
  methods: {
    getList() {
      axios
        .get("api/items")
        .then((response) => {
          this.items = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getTodoLists() {
      axios
        .get("api/todo_list")
        .then((response) => {
          this.todoLists = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    addTodoList(todoList) {
      this.todoLists.push(todoList);
    }
  },
  created() {
    this.getList();
    this.getTodoLists();
  }
};
</script>

<style scoped>
	
.todoContainer {
    margin: auto;
    width: 50%;
}

.todoHeading {
    background: #122e7d;
    border-radius: 0.25rem;
    color: white;
    padding: 0.25rem;
}

h2 {
    font-size: 1.7rem;
    text-align: center;
}

</style>
