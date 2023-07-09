<template>
    <div class="addTodoItem">
        <input type="text" v-model="item.name" placeholder="Add a todo item" />
        <button @click="addTodoItem()" :class="[item.name ? 'active' : 'inactive', 'addButton']">
            Add
        </button>
    </div>
</template>

<script>
export default {
    props: ['selectedTodoListId'],
    data() {
        return {
            item: {
                name: ''
            }
        };
    },
    methods: {
        addTodoItem() {
            if (this.item.name === '' || !this.selectedTodoListId) {
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
                        this.$emit("itemAdded");
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

input,
button {
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
