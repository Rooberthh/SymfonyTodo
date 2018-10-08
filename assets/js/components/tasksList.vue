<template>
    <div>
        <h1>Task lists component</h1>
        <div v-if="!dataSet.length">
            You do not have any tasks setup
        </div>
        <div v-else class="list-group" v-for="(task, index) in dataSet">
            <task :task="task" :key="task.id" @deleted="remove(index)"></task>
        </div>

        <a href="#" class="btn btn-primary mt-4" @click="$modal.show('new-task')">Add Task</a>

        <new-task @created="add"></new-task>
    </div>
</template>

<script>
    import task from './task'
    import newTask from './newTask'

    export default {
        name: "tasksList",
        components: {
            task,
            newTask
        },
        data() {
            return {
                dataSet: {},
                items: []
            }
        },
        created(){
            this.fetch();
        },
        methods: {
            fetch(){
                axios.get('api/tasks')
                    .then(response => {
                        this.dataSet = response.data;
                    });
            },

            remove(index){
                this.dataSet.splice(index, 1);
                this.$emit('removed');
            },

            add(index){
                this.dataSet.push(index);
                this.$emit('added');
            }
        },
    }
</script>

<style scoped>

</style>