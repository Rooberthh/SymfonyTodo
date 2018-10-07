<template>
    <div>
        <h1>Task lists component</h1>
        <div class="list-group" v-for="(task) in dataSet">
            <task :task="task" :key="task.id"></task>
        </div>
    </div>
</template>

<script>
    import task from './task'

    export default {
        name: "tasksList",
        components: {
            task
        },
        data() {
            return {
                dataSet: {},
            }
        },
        created(){
            this.fetch();
        },
        methods: {
            fetch(){
                axios.get('api/tasks')
                    .then(response => {
                        console.log(response);
                        this.dataSet = response.data;
                    });
                console.log('tasks fetched');
            }
        }
    }
</script>

<style scoped>

</style>