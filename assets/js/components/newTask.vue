<template>
    <div>
        <modal name="new-task" height="auto" adaptive>
            <button type="button" class="close float-right p-2" aria-label="Close" @click="$modal.hide('new-task')">
                <span aria-hidden="true">&times;</span>
            </button>
            <form @submit.prevent="addTask" method="POST" class="p-4">
                <div class="flex mb-4">
                    <div class="form-group">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control" v-model="title">
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" cols="8" rows="8" class="form-control" v-model="description"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="deadline" class="form-label">Deadline</label>
                        <input type="text" id="deadline" class="form-control" placeholder="Deadline in hours from now" v-model="deadline">
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
                description: '',
                deadline: ''
            }
        },
        methods: {
            addTask(){
                axios.post('/tasks', {
                    title: this.title,
                    description: this.description,
                    deadline: this.deadline
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