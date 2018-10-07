<template>
  <div v-if="!editing">
    <div class="list-group-item">
      <h5 v-text="title"></h5>
      <p v-text="description"></p>
      <button class="btn btn-info" @click="editing = true">Edit</button>
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
        <button type="button" class="btn btn-danger" @click="editing = false">Cancel</button>
        <button type="submit" class="btn btn-info" >Update</button>
        <button type="button" class="btn btn-link" @click="destroy()">Delete Task</button>
      </form>
    </div>
  </div>

</template>

<script>
    export default {
        name: "task",
        props: ['task'],
        data() {
            return {
                id: this.task.id,
                editing: false,
                title: this.task.title,
                description: this.task.description
            }
        },
        methods: {
            destroy(){
              console.log('destroy called');

              axios.delete('/tasks/' + this.id).then(response => {
                  console.log(response.data);
              })

            },
            update(){
              console.log('Update Called!');
              axios.patch('/tasks/' + this.id, {
                  title: this.title,
                  description: this.description
              }).catch(error => {
                  console.log(error.response.data);
              });

              this.editing = false;
            }
        }
    }
</script>

<style scoped>

</style>