<template>
    <div>
        <div v-for="(item, index) in filteredItems" :key="index">
            <list-item :item="item" class="todoItem" v-on:itemchanged="$emit('reloadList')" />
        </div>
        <button @click="deleteTodoList()" class="deleteList">Delete List</button>
    </div>
</template>

<script>
import listItem from "./listItem.vue";
export default {
    props: ['items', 'todoListId'],
    components: {
        listItem
    },
    computed: {
        filteredItems() {
            if (this.todoListId) {
                return this.items.filter(item => item.todo_list_id === this.todoListId);
            } else {
                return this.items;
            }
        }
    },
    methods: {
        deleteTodoList() {
            if (confirm("Delete this list and its items?")) {
                axios
                    .delete(`api/todo_list/${this.todoListId}`)
                    .then((response) => {
                        if (response.status === 200) {
                            this.$el.classList.add("fadeOutTodoList");
                            setTimeout(() => {
                                this.$emit("deleteList");
                            }, 500);
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        }
    }
};

</script>

<style scoped>
.todoItem {
    background-color: #eaeaea;
    border-bottom: 1px solid #122e7d;
    border-radius: 0.25rem;
    padding: 0.5rem;
}

.deleteList {
    background-color: #dc3545;
    border-radius: 0.25rem;
    border: none;
    color: #fff;
    cursor: pointer;
    margin-top: 1rem;
    padding: 0.5rem 1rem;
}

.fadeOutTodoList {
    animation-duration: 0.5s;
    animation-fill-mode: forwards;
    animation-name: fadeOut;
}

@keyframes fadeOut {
    0% {
        opacity: 1;
    }

    100% {
        opacity: 0;
    }
}

</style>
