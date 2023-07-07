<template>
    <div class="todoContainer">
        <div class="todoHeading">
            <h2>Todo list</h2>
            <add-todo-item-form v-on:reloadList="getList()" />
        </div>
        <list-todo-items :items="items" v-on:reloadList="getList()" />
    </div>
</template>
<script>
import addTodoItemForm from "./addTodoItemForm.vue";
import listTodoItems from "./listTodoItems.vue";
export default {
    components: {
        addTodoItemForm,
        listTodoItems
    },
    data: function() {
        return {
            items: []
        }
    },
    methods: {
        getList() {
            axios.get('api/items')
                .then(response => {
                    this.items = response.data
                })
                .catch(error => {
                    console.log(error);
                })
        }
    },
    created() {
        this.getList();
    }

}

</script>
<style scoped>
.todoContainer {
    font-family: 'Roboto Slab', serif;
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
