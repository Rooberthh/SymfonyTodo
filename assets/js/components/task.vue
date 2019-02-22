<template>
  <div v-if="!editing">
    <div class="list-group-item my-2" :class="hasPassed ? 'border border-danger' : ''">
      <div class="d-flex">
        <h5 class="flex-grow-1" v-text="title"></h5>
        <span class="badge badge-pill badge-dark" v-text="this.deadline"></span>
      </div>
      <p v-text="description"></p>
      <div class="d-flex">
        <div class="flex-grow-1">
          <button class="btn btn-info" @click="editing = true">Edit</button>
        </div>
        <div>
          <button type="button" class="btn btn-link" @click="destroy()">Delete Task</button>
        </div>
      </div>
    </div>
  </div>
  <div v-else>
    <div class="list-group-item">
      <form action="" @submit.prevent="update">
        <div class="form-group">
          <input class="form-control" type="text" name="title" id="title" placeholder="Title" v-model="title">
        </div>
        <div class="form-group">
          <input class="form-control" type="text" name="description" id="description" placeholder="Description" v-model="description">
        </div>
        <div class="form-group">
          <input class="form-control" type="text" name="deadline" id="deadline" placeholder="Deadline in hours" v-model="offset">
        </div>
        <div class="d-flex">
          <div class="flex-grow-1">
            <button type="button" class="btn btn-danger" @click="editing = false">Cancel</button>
            <button type="submit" class="btn btn-outline-info" >Update</button>
          </div>
          <div>
            <button type="button" class="btn btn-link" @click="destroy()">Delete Task</button>
          </div>
        </div>
      </form>
    </div>
  </div>

</template>

<script>
    import moment from 'moment';

    export default {
        name: "task",
        props: ['task'],
        data() {
            return {
                id: this.task.id,
                editing: false,
                title: this.task.title,
                description: this.task.description,
                offset: null,
                deadline: this.calcDeadline(this.task.deadline),
            }
        },
        methods: {
            destroy(){
              axios.delete('/tasks/' + this.id).then(response => {
                  console.log(response.data);
              });

              this.$emit('deleted', this.id);
            },
            update(){
                axios.patch('/tasks/' + this.id, {
                  title: this.title,
                  description: this.description,
                  deadline: this.offset
                }).catch(error => {
                  console.log(error.response.data);
                }).then(response => {
                    let data = response.data;
                    this.deadline = this.calcDeadline(data.deadline);
                });

                this.editing = false;
            },
            calcDeadline(deadline){
                if(deadline !== "Null"){
                    return moment(deadline).fromNow();
                }
            }
        },
        computed: {
            hasPassed(){
                let deadline = this.task.deadline.slice(0, -6);
                let curDate = new Date;
                curDate = curDate.toISOString().slice(0,-5);

                return (deadline < curDate)
            }
        }
    }
</script>

<style scoped>

</style>