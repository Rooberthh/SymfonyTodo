<template>
  <div class="list-group-item">
    <h5> {{ title }}</h5>
    <p> {{ description }}</p>
  </div>
</template>

<script>
    export default {
        name: "task",
        props: ['task'],
        data() {
            return {
                editing: false,
                title: this.task.title,
                description: this.task.description
            }
        }
    }
</script>

<style scoped>

</style>