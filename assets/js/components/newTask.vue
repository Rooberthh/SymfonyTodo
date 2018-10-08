<template>
    <div>
        <modal name="new-task" height="auto" width="400px">
            <form @submit.prevent="addTask" method="POST" class="p-4">
                <div class="flex mb-4">
                    <div class="form-group">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control" v-model="title">
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control" v-model="description"></textarea>
                    </div>
                </div>

                <div class="d-flex">
                    <a href="#" class="btn btn-danger mr-4 flex-grow-1" @click="$modal.hide('new-task')">Cancel</a>
                    <button type="submit" class="btn btn-primary flex-grow-1">Create Task</button>
                </div>
            </form>
        </modal>
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
                axios.post('/tasks', {
                    title: this.title,
                    description: this.description
                }).catch(error => {
                    console.log(error.response.data);
                }).then(({data}) => {
                    this.title = '';
                    this.description = '';
                    console.log(data);
                    this.$emit('created', data);

                    this.$modal.hide('new-task');
                })
            }
        }
    }
</script>

<style scoped>

</style>