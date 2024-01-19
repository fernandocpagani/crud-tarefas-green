<template>
  <div id="main-container">

    <nav class="view-task-nav">

      <div v-if="finishdate >= nowTime()">
        <div class="date-view-green">
          <img src="../../public/dataverde.svg" alt="dataverde"> <Label>No
            prazo</Label>
        </div>
      </div>

      <div v-else>
        <div class="date-view-red">
          <img src="../../public/datavermelho.svg" alt="datavermelha">
          <Label>Vencido</Label>
        </div>
      </div>

      <div class="buttons-nav-right">
        <form>

          <div>
            <ul class="main-dropdown">
              <li class="dropdown-hover">

                <ul class="dropdown">

                  <li class="black-li" @click="copyTask(id)"><img src="../../public/copiarlink.svg" alt="copiar link">Copiar link da tarefa </li>

                  <li class="black-li" @click="duplicateTask(id)"><img src="../../public/duplicar.svg" alt="duplicar tarefa">Duplicar tarefa</li>

                  <li class="black-li" @click="printTask(id)"><img src="../../public/imprimir.svg" alt="imprimir">Imprimir tarefa</li>

                  <li class="red-li" @click="deleteTask(id)"><img src="../../public/lixeiravermelha.svg" alt="excluir">Excluir tarefa</li>

                </ul>

              </li>
            </ul>
          </div>

          <button class="x"> <img src="../../public/3pontos.svg" alt="3pontos"></button>

          <a href="/dashboard" class="x"><img src="../../public/x.svg" alt="x"></a>
          
        </form>
      </div>

    </nav>

    <div class="sub-container">

      <div class="left-content">

        <div class="task">

          <div>
            <button class="checkbutton" @click="checkTask(id)">
              <div v-if="status == 'pending'">
                <img src="../../public/checkvazio.svg" alt="check">
              </div>
              <div v-else>
                <img src="../../public/checkcheio.svg" alt="check">
              </div>
            </button>
          </div>

          <div class="task-field">
            <h2 class="modal__title">{{ title }}</h2>
            <p class="description">{{ description }}</p>
          </div>

        </div>

        <h3 class="h3-sub-task">Subtarefas</h3>

        <div class="sub-task-content" v-for="subtask in subtasks " :key="subtask.id">

          <div class="sub-task" v-if="subtask.task_id == id">

            <div>
              <button class="checkbutton" @click="checkSubtask(subtask.id)">
                <div v-if="subtask.sstatus == 'pending'">
                  <img src="../../public/checkvazio.svg" alt="check">
                </div>
                <div v-else>
                  <img src="../../public/checkcheio.svg" alt="check">
                </div>
              </button>
            </div>

            <div class="sub-task-item">

              <div class="subtask-text">
                <label class="title-sub-task">{{ subtask.stitle }} </label>
                <p class="description">{{ subtask.sdescription }}</p>
              </div>

              <div class="menu-tasks">
                <button><router-link :to="'/updatesubtask/' + subtask.id" class="title-task"><img src="../../public/lapis.svg" alt="lapis"></router-link></button>

                <button @click="deleteSubTask(id)"><img class="item-menu-task2" src="../../public/lixeiracinza.svg" alt="excluir"></button>
              </div>

            </div>

          </div>

        </div>
      </div>

      <div class="right-content">

        <h4 class="title-right">Criado em</h4>
        <h5 class="info-black"><img src="../../public/datapreto.svg" alt="calendario-preto">{{ moment(created_at).format('DD/MM/YYYY') }} às {{ moment(created_at).format('HH:mm') }} </h5>

        <h4 class="title-right">Data de vencimento</h4>
        <div v-if="finishdate >= moment().format('YYYY-MM-DD')">
          <h5 class="info-green"><img src="../../public/dataverde.svg" alt="calendario-verde">{{ moment(finishdate).format('DD/MM/YYYY') }} </h5>
        </div>

        <div v-else>
          <h5 class="info-red"><img src="../../public/datavermelho.svg" alt="calendario-vermelho">{{ moment(finishdate).format('DD/MM/YYYY') }} </h5>
        </div>

        <h4 class="title-right">Modificado em</h4>
        <h5 class="info-black"><img src="../../public/datapreto.svg" alt="calendario-preto">{{ moment(updated_at).format('DD/MM/YYYY') }} às {{ moment(updated_at).format('HH:mm') }} </h5>

        <h4 class="title-right">ID da tarefa</h4>
        <h5 class="info-black">{{ id }}</h5>

      </div>

    </div>

  </div>
</template>

<script>
import moment from 'moment'
import axios from 'axios'

export default {
  name: "Entrance",

  data() {
    return {
      tasks: [],
      subtask: null,
      subtasks: [],
      stitle: null,
      id: null,
      title: null,
      description: null,
      date: null,
      status: null,
      sstatus: null,
    }
  },

  async mounted() {

    const result = await axios.get(`http://127.0.0.1:8000/api/task/` + this.$route.params.id)
    this.title = result.data.title
    this.description = result.data.description
    this.finishdate = result.data.finishdate
    this.status = result.data.status
    this.id = result.data.id
    this.created_at = result.data.created_at
    this.updated_at = result.data.updated_at
    this.status = result.data.status
    this.moment = moment;

    {
      axios
        .get('http://localhost:8000/api/subtask')
        .then((response) => {
          this.subtasks = response.data

        })
    }
    {
      setTimeout(() => {
        window.print()
      }, 1000);
    }
  },

  methods: {

    nowTime() {
      return moment().format('DD/MM/YYYY')
    },

    async duplicateTask(id) {
      const user = JSON.parse(localStorage.getItem("user-info"))
      const data = {
        title: this.title,
        description: this.description,
        finishdate: this.finishdate,
        status: this.status,
        users_id: user.user.id,
      }

      const result = axios.post('http://localhost:8000/api/task/register', data)
        .then(function (response) {
          const taskid = response.data.id

          const resultsub = axios.get(`http://localhost:8000/api/subtask/taskid/${id}`)
            .then(function (responsesub) {
              console.log(responsesub.data[1]);

              for (let i = 0; i < responsesub.data.length; i++) {
                const datasub = {
                  stitle: responsesub.data[i].stitle,
                  sdescription: responsesub.data[i].sdescription,
                  task_id: taskid,
                }

                const resultsubsend = axios.post('http://localhost:8000/api/subtask/register', datasub)
                  .then(function (response) {
                    console.log(response);
                  })

              }
            })
        })
        .catch(function (error) {
          console.error(error);
        });
    },

    async checkTask(id) {
      const result = await axios.get(`http://localhost:8000/api/task/${id}`)
      if (result.data.status == "pending") {
        const result = await axios.put(`http://localhost:8000/api/task/${id}/updatetaskstatus`,
          {
            status: "completed"
          })
      } else {
        const result = await axios.put(`http://localhost:8000/api/task/${id}/updatetaskstatus`,
          {
            status: "pending"
          })
      }
    
      if (result.status == 200) {
        window.location = window.location;
        // window.location.reload();
      }
    },

    async checkSubtask(id) {
      const result = await axios.get(`http://localhost:8000/api/subtask/${id}`)
      if (result.data.sstatus == "pending") {
        const result = await axios.put(`http://localhost:8000/api/subtask/${id}/updatesubtaskstatus`,
          {
            sstatus: "completed"

          })
      } else {
        const result = await axios.put(`http://localhost:8000/api/subtask/${id}/updatesubtaskstatus`,
          {
            sstatus: "pending"
          })
      }
      if (result.status == 200) {
        window.location = window.location;
        // window.location.reload();
      }
    },

    async printTask(id) {
      setTimeout(() => {
        window.print()
      }, 1000);
    },

    async copyTask(id) {
      await navigator.clipboard.writeText(`http://localhost:8080/modalviewtask/${id}`);
    },

    async deleteTask(id) {
      axios.delete(`http://localhost:8000/api/task/${id}/delete`)
        .then(() => {
          this.$router.push({ name: 'dashboard' });
        })
    },

    async deleteSubTask(id) {
      axios.delete(`http://localhost:8000/api/subtask/${id}/delete`)
        .then(() => {
          window.location = window.location;
          // window.location.reload();
        })
    },
  }

}

</script>    


<style scoped>

#main-container {
  width: 819px;
  height: 613px;
  background-color: #fff;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

nav {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  padding: 20px 30px;
  border-bottom: solid 1px #d9d9d9;
  align-items: center;
}

.date-view-green {
  padding: 4px 8px;
  width: 110px;
  background-color: #e5f4f3;
  font-size: 14px;
  font-weight: 500;
  line-height: 17px;
  text-align: left;
  color: #009488
}

.date-view-green img {
  width: 13px;
  height: 14.44px;
  margin-right: 10px;
}

.date-view-red {
  padding: 4px 8px;
  width: 110px;
  background-color: #d314081a;
  font-size: 14px;
  font-weight: 500;
  line-height: 17px;
  text-align: left;
  color: #d31408;
}

.date-view-red img {
  width: 13px;
  height: 14.44px;
  margin-right: 10px;
}

.buttons-nav-right {
  align-items: center;
}

.main-dropdown {
  list-style: none;
}

.dropdown-hover {
  position: absolute;
  display: none;
  margin-top: 25px;
  right: 0px;
}

.dropdown {
  list-style: none;
  padding: 30px;
  width: 246px;
  height: 232px;
  position: relative;
  background-color: #fff;
}

form:hover .dropdown-hover {
  display: block;
}

.black-li {
  justify-items: center;
  text-decoration: none;
  margin-bottom: 30px;
  font-size: 14px;
  font-weight: 400;
  line-height: 17px;
  text-align: left;
  cursor: pointer;
}

.black-li img {
  margin-right: 20px;
  width: 17px;
  height: 17px;
}

.red-li {
  text-decoration: none;
  color: #d31408;
  margin-bottom: 30px;
  font-size: 14px;
  font-weight: 400;
  line-height: 17px;
  text-align: left;
  cursor: pointer;
}

.red-li img {
  margin-right: 20px;
  width: 17px;
  height: 17px;
}

.x {
  margin-left: 35px;
  background-color: transparent;
  border: none;
  cursor: pointer;
}

.sub-container {
  display: flex;
  flex-direction: row;
}

.left-content {
  width: 573px;
}

.task {
  width: 513px;
  box-sizing: border-box;
  padding: 30px 30px 0px 30px;
  display: flex;
  flex-direction: row;
  transition: .5;
}

.checkbutton {
  border: none;
  background-color: transparent;
}

.task-field {
  width: 447px;
}

.modal__title {
  font-size: 18px;
  font-weight: 400;
  margin-left: 20px;
  line-height: normal;
  color: #000;
  max-width: 470px;
}

.description {
  margin-left: 20px;
  margin-bottom: 0;
  font-size: 14px;
  font-weight: 400;
  line-height: 17px;
  color: #81858e;
  max-width: 470px;
}

.h3-sub-task {
  font-size: 14px;
  font-weight: 600;
  line-height: 17px;
  letter-spacing: 0em;
  border-bottom: solid 1px #e5e5e5;
  color: #000;
  margin-left: 70px;
  margin-top: 38px;
  width: 470px;
  padding-bottom: 15px;
}

.sub-task-content {
  box-sizing: border-box;
  border-top: none;
  margin: 10px 0px;
}

.sub-task {
  display: flex;
  flex-direction: row;
  box-sizing: border-box;
  padding: 10px 0;
  margin-left: 70px;
  width: 470px;
}

.sub-task-item {
  display: flex;
  flex-direction: row;
}

.title-sub-task {
  width: 356px;
  margin-left: 20px;
}

.menu-tasks {
  display: flex;
  align-items: center;
  display: none;
  margin: auto 0;
}

.item-menu-task2 {
  padding: 0 11px 0 28px;
  border: none;
  background-color: transparent;
  cursor: pointer;
}

.menu-tasks button {
  border: none;
  background-color: transparent;
  cursor: pointer;
}

.sub-task-item:hover .menu-tasks {
  display: block;
}

.right-content {
  box-sizing: border-box;
  background-color: #f7f7f7;
  padding: 30px;
  width: 246px;
  min-height: 543px;
}

.title-right {
  font-size: 14px;
  font-weight: 400;
  line-height: 17px;
  text-align: left;
  margin-bottom: 10px;
  color: #81858e;
}

.info-black {
  font-size: 14px;
  font-weight: 600;
  line-height: 17px;
  text-align: left;
  margin-bottom: 40px;
  color: #000;
}

.info-green {
  font-size: 14px;
  font-weight: 600;
  line-height: 17px;
  text-align: left;
  margin-bottom: 40px;
  color: #009488;
}

.info-red {
  font-size: 14px;
  font-weight: 600;
  line-height: 17px;
  text-align: left;
  margin-bottom: 40px;
  color: #d31408;
}

.info-black img, .info-green img, .info-red img {
  margin-right: 10px;
}

@media(max-width: 490px) {

  #main-container {
    top: 0;
    transform: translate(-50%, 0);
    width: 489px;
  }

  .title-sub-task {
    width: 305px;
  }

  .right-content {
    width: 489px;
    height: 360px;
  }

  .left-content {
    width: 489px;
  }

  .sub-task, .h3-sub-task {
    width: 419px;
  }

  .task {
    width: 429px;
  }

  .right-content h4, .right-content h5 {
    text-align: center;
  }

  .sub-container {
    flex-direction: column;
  }

}

</style>