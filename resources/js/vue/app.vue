<template>
    <div class="todoContainer">
        <div class="todoHeading">
            <h2>Todo list</h2>
            <create-todo-list-form @listCreated="addTodoList" :updateListName="updateListName" />
        </div>
        <div v-for="(list, index) in todoLists" :key="list.id" class="todoListContainer" :style="{ animationDelay: (index * 0.2) + 's' }">
            <div class="listHeader">
                <input type="text" v-model="list.name" class="listNameInput" />
                <button @click="updateListName(list)" class="updateButton">Update name</button>
            </div>
            <add-todo-item-form @itemAdded="getList" :selectedTodoListId="list.id" />
            <list-todo-items :items="items" :todoListId="list.id" @reloadList="getList" @deleteList="deleteTodoList" />
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
        listTodoItems,
    },
    data() {
        return {
            items: [],
            todoLists: [],
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
            this.todoLists.sort((a, b) => b.id - a.id);
        },
        handleAddTodoItem({ name, todoListId }) {
            console.log('id = ' + todoListId);
            if (name && todoListId) {
                axios
                    .post("api/item/store", {
                        item: {
                            name: name,
                            todo_list_id: todoListId,
                        },
                    })
                    .then((response) => {
                        if (response.status === 201) {
                            this.getList();
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },
        deleteTodoList() {
            this.getTodoLists();
        },
        updateListName({ id, name }) {
            axios
                .put(`api/todo_list/${id}`, {
                    name: name,
                })
                .then((response) => {
                    if (response.status === 200) {
                        this.getTodoLists();
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    created() {
        this.getList();
        this.getTodoLists();
    },
};

</script>

<style scoped>
.todoContainer {
    margin: auto;
    width: 60%;
}

@media (max-width: 768px) {
  .todoContainer {
    width: 100%;
  }
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

.todoListContainer {
    animation-delay: 0s;
    animation-duration: 1s;
    animation-fill-mode: forwards;
    animation-name: fadeInTodo;
    border-radius: 0.25rem;
    border: 1px solid #eaeaea;
    margin: 1rem 0 1rem 0;
    opacity: 0;
    padding: 0.25rem;
}

.listHeader {
    display: flex;
    align-items: center;
    border-bottom: 1px solid #eaeaea;
}

.listNameInput {
    border: none;
    flex-grow: 1;
    font-size: 1.2rem;
    padding: 0.5rem;
}

.updateButton {
    background-color: #6ec1e4;
    border-radius: 0.25rem;
    border: none;
    color: white;
    cursor: pointer;
    margin-left: 0.5rem;
    padding: 0.5rem;
}

@keyframes fadeInTodo {
    0% {
        opacity: 0;
    }

    100% {
        opacity: 1;
    }
}

</style>
