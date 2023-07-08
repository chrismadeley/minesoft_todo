<template>
  <div class="addTodoItem">
    <input type="text" v-model="item.name" placeholder="Item Name" />
    <div>
      <select v-model="selectedTodoListId" class="todoListSelect">
        <option value="" disabled>Select Todo List</option>
        <option v-for="todoList in todoLists" :value="todoList.id" :key="todoList.id">
          {{ todoList.name }}
        </option>
      </select>
      <button @click="createTodoList()" :disabled="todoListName === ''">Create List</button>
    </div>
    <button
      @click="addTodoItem()"
      :class="[item.name && selectedTodoListId ? 'active' : 'inactive', 'addButton']"
      :disabled="selectedTodoListId === null"
    >
      Add
    </button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      item: {
        name: ''
      },
      todoListName: '',
      selectedTodoListId: null
    };
  },
  props: ['todoLists'],
  methods: {
    addTodoItem() {
      if (this.item.name === '' || this.selectedTodoListId === null) {
        return;
      }

      axios
        .post('api/item/store', {
          item: {
            name: this.item.name,
            todo_list_id: this.selectedTodoListId
          }
        })
        .then((response) => {
          if (response.status === 201) {
            this.item.name = '';
            this.selectedTodoListId = null;
            this.$emit('reloadList');
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    createTodoList() {
      if (this.todoListName === '') {
        return;
      }

      axios
        .post('api/todo_list/store', {
          name: this.todoListName
        })
        .then((response) => {
          if (response.status === 201) {
            this.todoListName = '';
            this.selectedTodoListId = response.data.id;
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

.addTodoItem {
	align-items: center;
	display: flex;
	justify-content: center;
	padding: 1rem;
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

.addButton {
	padding-left: 1.25rem;
	padding-right: 1.25rem;
}

</style>