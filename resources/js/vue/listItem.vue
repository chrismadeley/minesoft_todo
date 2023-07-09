<template>
    <div class="item">
        <input type="checkbox" @change="updateCheckbox()" v-model="item.completed" :checked="item.completed" />
        <span :class="[item.completed ? 'completed' : '', 'itemText']">{{ item.name }}</span>
        <button @click="removeItem()" class="delete" title="Delete Todo">X</button>
    </div>
</template>
<script>

export default {
    props: ['item'],
    methods: {
        updateCheckbox() {
            axios.put('api/item/' + this.item.id, {
                    item: this.item
                })
                .then(response => {
                    if (response.status == 200) {
                        this.$emit('itemchanged');
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        },
        removeItem() {
            axios.delete('api/item/' + this.item.id)
                .then(response => {
                    if (response.status == 200) {
                        this.$emit('itemchanged')
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        }
    }
}

</script>

<style scoped>
.completed {
    color: #999999;
    text-decoration: line-through;
}

.itemText {
    margin-left: 1rem;
    width: 100%;
}

.item {
    align-items: center;
    display: flex;
    justify-content: center;
}

.delete {
    background-color: #dc3545;
    border-radius: 0.25rem;
    border: none;
    color: white;
    cursor: pointer;
    font-family: 'GellixBlack', Arial, sans-serif;
    outline: none;
}

</style>
