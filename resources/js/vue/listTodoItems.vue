<template>
  <div>
    <div v-for="(item, index) in filteredItems" :key="index">
      <list-item :item="item" class="todoItem" v-on:itemchanged="$emit('reloadList')" />
    </div>
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
</style>
