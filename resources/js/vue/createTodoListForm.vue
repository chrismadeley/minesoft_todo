<template>
  <div class="createTodoList">
    <input type="text" v-model="todoListName" placeholder="Todo List Name" />
    <button @click="createTodoList()" :disabled="todoListName === ''">Create List</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      todoListName: ""
    };
  },
  methods: {
    createTodoList() {
      if (this.todoListName === "") {
        return;
      }

      axios
        .post("api/todo_list/store", {
          name: this.todoListName
        })
        .then((response) => {
          if (response.status === 201) {
            this.todoListName = "";
            this.$emit("listCreated", response.data); 
          }
        })
        .catch((error) => {
          console.log(error);
        });
    }
  }
};
</script>



<style scoped>
  
.createTodoList {
  align-items: center;
  display: flex;
  justify-content: center;
  padding: 0.5rem;
}

input, button {
  border-radius: 0.25rem;
  border: 0;
  margin-right: 0.5rem;
  outline: none;
  padding: 0.25rem;
}

input {
  width: 50%;
}
.active {
  background-color: #6ec1e4;
  color: white;
  cursor: pointer;
}

.inactive {
  color: #999999;
  cursor: not-allowed;
}

.createButton {
  padding-left: 1.25rem;
  padding-right: 1.25rem;
}

</style>