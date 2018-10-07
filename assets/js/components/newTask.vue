<template>
    <div>
        <form @submit.prevent="addTask" method="POST">
            <div class="form-group">
                <input type="text" class="form-control" name="title" id="title" placeholder="Title" v-model="title">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="description" id="description" placeholder="Description" v-model="description">
            </div>
            <button type="submit" class="btn btn-primary">Add Task</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "newTask",
        data() {
            return {
                title: '',
                description: ''
            }
        },
        methods: {
            addTask(){
                console.log('add task run');
                axios.post('/tasks', {
                    title: this.title,
                    description: this.description
                }).catch(error => {
                    console.log(error.response.data);
                }).then(({data}) => {
                    this.title = '';
                    this.description = '';

                    this.$emit('created', data)
                })
            }
        }
    }
</script>

<style scoped>

</style>