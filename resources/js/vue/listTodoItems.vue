<template>
    <div>
        <div v-for="(item, index) in items" :key="index">
            <list-item :item="item" class="todoItem" v-on:itemchanged="$emit('reloadList')" />
        </div>
    </div>
</template>
<script>
import listItem from "./listItem.vue"
export default {
    props: ['items'],
    components: {
        listItem
    }
}

</script>

<style scoped>
.todoItem {
    background-color: #eaeaea;
    border-bottom: 1px solid #122e7d;
    border-radius: 0.25rem;
    padding: 0.5rem;
}
</style>
