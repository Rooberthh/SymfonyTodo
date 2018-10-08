<template>
    <div>
        <h1>Task lists component</h1>
        <div v-if="!dataSet.length">
            You do not have any tasks setup
        </div>
        <div v-else class="list-group" v-for="(task, index) in dataSet">
            <task :task="task" :key="task.id" @deleted="remove(index)"></task>
        </div>
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
                console.log('deleted');
            },

            add(index){
                this.dataSet.push(index);
                this.$emit('added');
                console.log('added');
            }
        },
    }
</script>

<style scoped>

</style>