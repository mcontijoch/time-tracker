<template>
  <div id="app">
    <img alt="Vue logo" src="./assets/logo.png" height="200">
    <h1>Time Tracker App</h1>
    <div id="form">
      <h2>Create a Task</h2>
      <div class="form">
        <input type="text" class="form-input" v-model="taskName" placeholder="Run, rest, eat..." required>
        <button v-if="!hasStarted" class="start-button" @click="startTask">Start</button>
        <button v-if="hasStarted" class="stop-button" @click="stopTask">Stop</button>
      </div>
    </div>
    <div id="task" v-if="task !== null">
    <h2>New task:</h2>
      <div>
        <p>Name: {{ task.name }}</p>
        <p>Started at: {{ task.startedAt }}</p>
      </div>
    </div>
    <div id="tasks" v-if="tasks.length !== 0">
      <h2>Your tasks:</h2>
        <div>
          <div v-for="(task, index) in tasks" :key="task.id">
              <p>{{index}}</p>
              <p>{{task.name}}</p>
              <p>{{task.startedAt}}</p>
              <p>{{task.id}}</p>
          </div>
        </div>
    </div>
  </div>
</template>

<script>
import { DateTime } from 'luxon';

//import axios from 'axios';
export default {
  name: 'App',
  data() {
      return {
        taskName: null,
        hasStarted: false,
        task: null,
        tasks: []
      }
  },
  methods: {
    startTask() {
      this.hasStarted = true
      this.task = {
        id: 1,
        name: this.taskName,
        startTime: DateTime.now().ts
      }
      this.tasks.push(this.task)
    },
    stopTask() {
      this.hasStarted = false

    }
  }
}
</script>

<style scoped>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

#form {
  display: flex;
  flex-direction: column;
  align-items: center;
  height: 100vh;
}

.form {
  width: 300px;
  text-align: center;
  padding: 20px;
}

.form-input {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 3px solid #0091b3;
  border-radius: 5px;
  font-size: 16px;
}

.start-button {
  display: inline-block;
  padding: 10px 20px;
  font-size: 16px;
  font-weight: bold;
  text-align: center;
  text-decoration: none;
  cursor: pointer;
  border-radius: 30px;
  border: none;
  background-color: #0091b3;
  color: white;
}

.start-button:hover {
  background-color: #b3f0ff;
  color: #0091b3;
}

.stop-button {
  display: inline-block;
  padding: 10px 20px;
  font-size: 16px;
  font-weight: bold;
  text-align: center;
  text-decoration: none;
  cursor: pointer;
  border-radius: 30px;
  border: none;
  background-color: #b03b09;
  color: white;
}

.stop-button:hover {
  background-color: #fac8a7;
  color: #b03b09;
}
</style>
